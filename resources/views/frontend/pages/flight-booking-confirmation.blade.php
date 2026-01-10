@extends('frontend.layouts.master')

@section('title', 'Flight Booking Confirmation')

@section('css')
    <style>
        #common_banner {
            position: relative;
            background-image: url(../frontAssets/img/flights/banner.png);
            padding: 200px 0 130px 0;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        #common_banner::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            /* blackish overlay */
            z-index: 1;
        }

        /* content ko upar lao */
        #common_banner>* {
            position: relative;
            z-index: 2;
        }

        #theme_search_form_tour {
            z-index: 100;
        }
    </style>
@endsection

@section('content')
    <section id="tour_booking_submission" class="section_padding">
        <div class="container">
            <div class="row">

                <!-- LEFT -->
                <div class="col-lg-8">
                    <div class="tou_booking_form_Wrapper">

                        <!-- SUCCESS -->
                        <div class="tour_booking_form_box mb-4">
                            <div class="booking_success_arae">
                                <div class="booking_success_img">
                                    <img src="{{ asset('frontAssets/img/icon/right.png') }}" alt="img">
                                </div>
                                <div class="booking_success_text">
                                    <h3>{{ $booking->name }}, your order was submitted successfully!</h3>
                                    <h6>Your booking details has been sent to our team. We'll contact you shortly.</h6>
                                </div>
                            </div>
                        </div>

                        <!-- USER INFO -->
                        <div class="booking_tour_form">
                            <h3 class="heading_theme">Your information</h3>
                            <div class="tour_booking_form_box">
                                <div class="your_info_arae">
                                    <ul>
                                        <li><span class="name_first">Name:</span> <span
                                                class="last_name">{{ $booking->name }}</span></li>
                                        <li><span class="name_first">Email:</span> <span
                                                class="last_name">{{ $booking->email }}</span></li>
                                        <li><span class="name_first">Phone:</span> <span
                                                class="last_name">{{ $booking->phone }}</span></li>
                                        <li><span class="name_first">Gender:</span> <span
                                                class="last_name">{{ ucfirst($booking->gender) }}</span></li>
                                        <li><span class="name_first">Date of Birth:</span> <span
                                                class="last_name">{{ \Carbon\Carbon::parse($booking->dob)->format('d M Y') }}</span>
                                        </li>
                                        <li><span class="name_first">Address:</span> <span
                                                class="last_name">{{ $booking->address }}</span></li>
                                        <li><span class="name_first">Passport No:</span> <span
                                                class="last_name">{{ $booking->passport_no }}</span></li>
                                        <li><span class="name_first">Visa No:</span> <span
                                                class="last_name">{{ $booking->visa_no }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-lg-4">
                    <div class="tour_details_right_sidebar_wrapper">

                        <!-- BOOKING DETAILS -->
                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>Booking details</h3>
                                </div>

                                <div class="tour_booking_amount_area">
                                    <ul>
                                        <li>Booking ID: <span>{{ $booking->booking_id }}</span></li>
                                        <li>Booking date: <span>{{ $booking->created_at->format('d M Y') }}</span></li>
                                        <li>Payment method: <span>{{ strtoupper($booking->payment_method) }}</span></li>
                                        <li>Booking status: <span
                                                class="text-success">{{ ucfirst($booking->status) }}</span></li>
                                    </ul>

                                    <ul>
                                        <li>
                                            Adult Price x {{ $booking->adults }}
                                            <span>{{ \App\Helpers\Helper::formatCurrency($booking->flight_price) }}</span>
                                        </li>

                                        @if ($booking->discount_amount > 0)
                                            <li class="remove_coupon_tour">
                                                Discount
                                                <span>-{{ \App\Helpers\Helper::formatCurrency($booking->discount_amount) }}</span>
                                            </li>
                                        @endif

                                        <li>
                                            Tax
                                            <span>{{ \App\Helpers\Helper::formatCurrency($booking->tax) }}</span>
                                        </li>
                                    </ul>

                                    <div class="tour_bokking_subtotal_area">
                                        <h6>
                                            Subtotal
                                            <span>
                                                {{ \App\Helpers\Helper::formatCurrency($booking->flight_price - $booking->discount_amount + $booking->tax) }}
                                            </span>
                                        </h6>
                                    </div>

                                    <div class="total_subtotal_booking">
                                        <h6>
                                            Total Amount
                                            <span>{{ \App\Helpers\Helper::formatCurrency($booking->total_amount) }}</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FLIGHT SUMMARY -->
                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>Flight summary</h3>
                                </div>

                                <ul>
                                    <li>Route: <span>{{ $booking->flight_from }} → {{ $booking->flight_to }}</span></li>
                                    <li>Airline: <span>{{ $booking->flight_airline }}</span></li>
                                    <li>Class: <span>{{ $booking->flight_class }}</span></li>
                                    <li>Departure:
                                        <span>{{ \Carbon\Carbon::parse($booking->flight_departure_datetime)->format('d M Y, H:i') }}</span>
                                    </li>
                                    <li>Arrival:
                                        <span>{{ \Carbon\Carbon::parse($booking->flight_arrival_datetime)->format('d M Y, H:i') }}</span>
                                    </li>
                                    <li>Stops:
                                        <span>{{ $booking->flight_stops == 0 ? 'Non-stop' : $booking->flight_stops . ' Stop(s)' }}</span>
                                    </li>
                                </ul>

                                @if ($booking->return_date)
                                    <hr>
                                    <h4 class="mt-3 mb-3">Return Flight</h4>
                                    <ul>
                                        <li>Route: <span>{{ $booking->return_from }} → {{ $booking->return_to }}</span></li>
                                        <li>Departure:
                                            <span>{{ \Carbon\Carbon::parse($booking->return_departure_datetime)->format('d M Y, H:i') }}</span>
                                        </li>
                                        <li>Arrival:
                                            <span>{{ \Carbon\Carbon::parse($booking->return_arrival_datetime)->format('d M Y, H:i') }}</span>
                                        </li>
                                        <li>Stops:
                                            <span>{{ $booking->return_stops == 0 ? 'Non-stop' : $booking->return_stops . ' Stop(s)' }}</span>
                                        </li>
                                    </ul>

                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
