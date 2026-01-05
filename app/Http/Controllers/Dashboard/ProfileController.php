<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Designation;
use App\Models\Gender;
use App\Models\Language;
use App\Models\MaritalStatus;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $profile = Profile::with('user','gender','maritalStatus','language','designation','country')->where('user_id', $user->id)->first();
            $countries = Country::where('is_active', 'active')->get();
            $genders = Gender::where('is_active', 'active')->get();
            $maritalStatuses = MaritalStatus::where('is_active', 'active')->get();
            $languages = Language::where('is_active', 'active')->get();
            $designations = Designation::where('is_active', 'active')->get();
            return view('dashboard.profile.index',compact('profile', 'user', 'countries','genders','maritalStatuses','languages','designations'));
        } catch (\Throwable $th) {
            Log::error('Profile Index Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max_size',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string',
            'dob' => 'nullable|date',
            'bio' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with('error', 'Validation Error!');
        }

        try {
            DB::beginTransaction();
            $currentUser = Auth::user();
            $profile = Profile::where('id', $id)->first();

            if (!$profile) {
                $profile = new Profile();
                $profile->user_id = $currentUser->id;
            }

            $profile->first_name = $request->full_name;
            $profile->phone_number = $request->phone_number;
            $profile->dob = $request->dob ? date('Y-m-d', strtotime($request->dob)) : null;
            $profile->bio = $request->bio;

            if ($request->hasFile('profile_image')) {
                if (isset($profile->profile_image) && File::exists(public_path($profile->profile_image))) {
                    File::delete(public_path($profile->profile_image));
                }

                $profileImage = $request->file('profile_image');
                $profileImage_ext = $profileImage->getClientOriginalExtension();
                $profileImage_name = time() . '_profileImage.' . $profileImage_ext;

                $profileImage_path = 'uploads/profile-images';
                $profileImage->move(public_path($profileImage_path), $profileImage_name);
                $profile->profile_image = $profileImage_path . "/" . $profileImage_name;
            }

            $user = User::where('id', $currentUser->id)->first();
            $user->name = $request->full_name;
            $user->save();

            $profile->save();

            DB::commit();
            return redirect()->back()->with('success', 'Profile Updated Successfully');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            Log::error('Profile Updated Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function accountDeactivation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'accountActivation' => 'required|in:on',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with('error', 'Validation Error!');
        }
        try {
            $user = User::where('id', $id)->first();
            $user->is_active = 'inactive';
            $user->save();
            return redirect()->back()->with('success', 'Account Deactivated Successfully');
        } catch (\Throwable $th) {
            Log::error('Account Deactivation Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
            throw $th;
        }
    }

    public function passwordUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|different:currentPassword|min:8',
            'confirmNewPassword' => 'required|same:newPassword',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with('error', 'Validation Error!');
        }
        try {
            $user = User::where('id', $id)->first();
            if (!password_verify($request->currentPassword, $user->password)) {
                return redirect()->back()->with('error', 'Current Password is incorrect');
            }
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return redirect()->back()->with('success', 'Password Updated Successfully');
        } catch (\Throwable $th) {
            Log::error('Password Update Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
            throw $th;
        }
    }
}
