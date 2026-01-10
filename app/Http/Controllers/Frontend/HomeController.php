<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\FlightBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        try {
            return view('frontend.pages.home');
        } catch (\Throwable $th) {
            Log::error('Frontend Home Index Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
            throw $th;
        }
    }

    // public function flights(Request $request)
    // {
    //     try {
    //         $tripType = $request->input('trip_type');
    //         $from = $request->input('from_iata');
    //         $to = $request->input('to_iata');
    //         $departureDate = $request->input('departure_date');
    //         $adults = $request->input('adults');
    //         $children = $request->input('children');
    //         $infants = $request->input('infants');
    //         $cabinClass = $request->input('cabin_class');
    //         return view('frontend.pages.flights');
    //     } catch (\Throwable $th) {
    //         Log::error('Frontend Flights Page Failed', ['error' => $th->getMessage()]);
    //         return redirect()->back()->with('error', "Something went wrong! Please try again later");
    //         throw $th;
    //     }
    // }

    private function amadeusToken()
    {
        $response = Http::asForm()->post(
            'https://test.api.amadeus.com/v1/security/oauth2/token',
            [
                'grant_type' => 'client_credentials',
                'client_id' => env('AMADEUS_API_KEY'),
                'client_secret' => env('AMADEUS_API_SECRET'),
            ]
        );

        if (!$response->successful()) {
            Log::error('Amadeus Token Error', $response->json());
            throw new \Exception('Amadeus token failed');
        }

        return $response->json('access_token');
    }


    // public function flights(Request $request)
    // {
    //     try {
    //         $token = $this->amadeusToken();

    //         $from = strtoupper(trim($request->from_iata));
    //         $to = strtoupper(trim($request->to_iata));

    //         $adults = max(1, (int) $request->adults);
    //         $children = (int) ($request->children ?? 0);
    //         $infants = min((int) ($request->infants ?? 0), $adults);

    //         $travelClass = $request->cabin_class
    //             ? strtoupper(str_replace(' ', '_', $request->cabin_class))
    //             : 'ECONOMY';

    //         if ($request->cabin_class == 'First Class') {
    //             $travelClass = 'FIRST';
    //         }

    //         $response = Http::withToken($token)->get(
    //             'https://test.api.amadeus.com/v2/shopping/flight-offers',
    //             [
    //                 'originLocationCode' => $from,
    //                 'destinationLocationCode' => $to,
    //                 'departureDate' => date('Y-m-d', strtotime($request->departure_date)),
    //                 'adults' => $adults,
    //                 'children' => $children,
    //                 'infants' => $infants,
    //                 'travelClass' => $travelClass,
    //                 'currencyCode' => 'PKR',
    //                 'max' => 30
    //             ]
    //         );

    //         if (!$response->successful()) {
    //             Log::error('Amadeus Flights Error', $response->json());
    //             dd($response->json());
    //         }

    //         $flights = $response->json('data');

    //         // dd($flights);

    //         return view('frontend.pages.flights', compact('flights'));
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         return back()->with('error', 'Flights not found');
    //     }
    // }

    public function flights(Request $request)
    {
        try {
            $token = $this->amadeusToken();

            $tripType = $request->trip_type ?? 'oneway';

            $from = strtoupper(trim($request->from_iata));
            $to   = strtoupper(trim($request->to_iata));

            $adults   = max(1, (int) $request->adults);
            $children = (int) ($request->children ?? 0);
            $infants  = min((int) ($request->infants ?? 0), $adults);

            $travelClass = $request->cabin_class
                ? strtoupper(str_replace(' ', '_', $request->cabin_class))
                : 'ECONOMY';

            if ($request->cabin_class == 'First Class') {
                $travelClass = 'FIRST';
            }

            /* ============================
            BASE PARAMS
            ============================ */
            $params = [
                'originLocationCode'      => $from,
                'destinationLocationCode' => $to,
                'departureDate'           => date('Y-m-d', strtotime($request->departure_date)),
                'adults'                  => $adults,
                'children'                => $children,
                'infants'                 => $infants,
                'travelClass'             => $travelClass,
                'currencyCode'            => 'PKR',
                'max'                     => 30,
            ];

            /* ============================
            ROUNDTRIP CONDITION
            ============================ */
            if ($tripType === 'roundtrip' && $request->filled('return_date')) {
                $params['returnDate'] = date('Y-m-d', strtotime($request->return_date));
            }

            /* ============================
            API CALL
            ============================ */
            $response = Http::withToken($token)->get(
                'https://test.api.amadeus.com/v2/shopping/flight-offers',
                $params
            );

            if (!$response->successful()) {
                Log::error('Amadeus Flights Error', $response->json());
                return back()->with('error', 'Amadeus API error');
            }

            $flights = $response->json('data');

            // dd($flights);

            return view('frontend.pages.flights', compact('flights', 'tripType'));

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Flights not found');
        }
    }


    public function flightBooking(Request $request)
    {
        try {
            $search = $request->only([
                'trip_type',
                'from_iata',
                'to_iata',
                'departure_date',
                'return_date',
                'adults',
                'children',
                'infants',
                'cabin_class'
            ]);

            $flight = json_decode(base64_decode($request->flight), true);

            return view('frontend.pages.flight-booking', compact('search', 'flight'));
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return back()->with('error', 'Flight booking failed');
        }
    }

    public function flightBookingSubmission(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // Passenger info
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'address' => 'nullable|string|max:500',
            'passport_no' => 'nullable|string|max:50',
            'visa_no' => 'nullable|string|max:50',

            // Flight info
            'trip_type' => 'required|in:oneway,roundtrip',
            'flight_price' => 'required|numeric',
            'flight_airline' => 'required|string|max:10',
            'flight_class' => 'required|string|max:50',
            'flight_from' => 'required|string|max:10',
            'flight_to' => 'required|string|max:10',
            'flight_departure_datetime' => 'required|date',
            'flight_arrival_datetime' => 'required|date',
            'flight_return_datetime' => 'nullable|date',
            'flight_stops' => 'required|integer|min:0',
            'flight_duration' => 'required|string|max:20',
            'flight_segments' => 'nullable|string',

            // Travel info
            'departure_date' => 'required|date',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
            'infants' => 'required|integer|min:0',

            // Payment & pricing
            'payment_method' => 'required|string|in:cod,card,online',
            'total_amount' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',

            //Return Flight info
            'return_from' => 'nullable|string|max:10',
            'return_to' => 'nullable|string|max:10',
            'return_departure_datetime' => 'nullable|date',
            'return_arrival_datetime' => 'nullable|date',
            'return_stops' => 'nullable|integer|min:0',
            'return_duration' => 'nullable|string|max:20',
            'return_segments' => 'nullable|string',
            'return_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            Log::error('Flight Booking Submission Validation Error', [
                'errors' => $validator->errors()->toArray()
            ]);
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with('error', 'Validation Error!');
        }

        try {
            DB::beginTransaction();
            $booking = new FlightBooking();
            $booking->booking_type = $request->trip_type;
            $booking->name = $request->name;
            $booking->email = $request->email;
            $booking->phone = $request->phone;
            $booking->dob = $request->dob;
            $booking->gender = $request->gender;
            $booking->address = $request->address;
            $booking->passport_no = $request->passport_no;
            $booking->visa_no = $request->visa_no;
            $booking->flight_price = $request->flight_price;
            $booking->flight_airline = $request->flight_airline;
            $booking->flight_class = $request->flight_class;
            $booking->flight_from = $request->flight_from;
            $booking->flight_to = $request->flight_to;
            $booking->flight_departure_datetime = $request->flight_departure_datetime;
            $booking->flight_arrival_datetime = $request->flight_arrival_datetime;
            $booking->flight_stops = $request->flight_stops;
            $booking->flight_duration = $request->flight_duration;
            $booking->flight_segments = $request->flight_segments;
            $booking->departure_date = $request->departure_date;
            $booking->adults = $request->adults;
            $booking->children = $request->children;
            $booking->infants = $request->infants;
            $booking->payment_method = $request->payment_method;
            $booking->total_amount = $request->total_amount;
            $booking->tax = $request->tax;
            $booking->discount_amount = $request->discount_amount;
            $booking->return_from = $request->return_from;
            $booking->return_to = $request->return_to;
            $booking->return_departure_datetime = $request->return_departure_datetime;
            $booking->return_arrival_datetime = $request->return_arrival_datetime;
            $booking->return_stops = $request->return_stops;
            $booking->return_duration = $request->return_duration;
            $booking->return_segments = $request->return_segments;
            $booking->return_date = $request->return_date;
            $booking->save();

            $airline = strtoupper($request->flight_airline);

            $lastBooking = FlightBooking::where('flight_airline', $airline)
                ->whereNotNull('booking_id')
                ->latest('id')
                ->first();

            if ($lastBooking && preg_match('/(\d+)$/', $lastBooking->booking_id, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            } else {
                $nextNumber = 1;
            }

            $booking->booking_id = 'FBK-' . $airline . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            $booking->save();

            DB::commit();
            return redirect()->route('frontend.flight.booking.confirmation', $booking->booking_id)->with('success', 'Booking Successful!');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            Log::error('Profile Updated Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }

    public function flightBookingConfirmation($bookingId)
    {
        try {
            $booking = FlightBooking::where('booking_id', $bookingId)->firstOrFail();
            return view('frontend.pages.flight-booking-confirmation', compact('booking'));
        } catch (\Throwable $th) {
            Log::error('Frontend Flight Booking Confirmation Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
            throw $th;
        }
    }

    public function contact()
    {
        try {
            return view('frontend.pages.contact');
        } catch (\Throwable $th) {
            Log::error('Frontend Contact Page Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
            throw $th;
        }
    }

    public function contactStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all())->with('error', 'Validation Error!');
        }

        try {
            DB::beginTransaction();
            $contact = new Contact();
            $contact->name = $request->first_name . ' ' . $request->last_name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->save();
            DB::commit();
            return redirect()->back()->with('success', 'Your message submitted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            Log::error('contact store Failed', ['error' => $th->getMessage()]);
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }
}
