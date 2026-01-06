<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FlightBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FlightBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view flight booking');
        try {
            $status = $request->get('status'); // pending | confirmed | cancelled

            $flightBookings = FlightBooking::when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            return view('dashboard.flights.bookings', compact('flightBookings', 'status'));
        } catch (\Throwable $th) {
            Log::error('Flight Booking Index Failed', ['error' => $th->getMessage()]);
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
        $this->authorize('view flight booking');
        try{
            $flightBooking = FlightBooking::findOrFail($id);
            return view('dashboard.flights.booking-show', compact('flightBooking'));

        }catch(\Throwable $th){
            Log::error('Flight Booking Show Failed', ['error' => $th->getMessage()]);
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
        $this->authorize('delete flight booking');
        try {
            $flightBooking = FlightBooking::findOrFail($id);
            $flightBooking->delete();
            return redirect()->back()->with('success', 'Flight Booking Deleted Successfully');
        } catch (\Throwable $th) {
            Log::error('Flight Booking Deletion Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
            throw $th;
        }
    }

    public function updateStatus(Request $request, FlightBooking $booking)
    {
        $this->authorize('update flight booking');
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        try {
            $booking->status = $request->status;
            $booking->save();

            return redirect()->back()->with('success', 'Flight Booking status updated successfully.');
        } catch (\Throwable $th) {
            Log::error('Flight Booking Status Update Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', 'Something went wrong! Please try again later');
        }
    }
}
