<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view contact');
        try {

            $contacts = Contact::latest()
                ->paginate(10)
                ->withQueryString();

            return view('dashboard.contacts.index', compact('contacts'));
        } catch (\Throwable $th) {
            Log::error('Contact Index Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', 'Something went wrong!');
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
        $this->authorize('view contact');
        try {
            $contact = Contact::findOrFail($id);
            return view('dashboard.contacts.show', compact('contact'));
        } catch (\Throwable $th) {
            Log::error('Contact Show Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete contact');
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();

            return redirect()->route('dashboard.contacts.index')->with('success', 'Contact deleted successfully!');
        } catch (\Throwable $th) {
            Log::error('Contact Delete Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
