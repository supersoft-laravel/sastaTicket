@extends('frontend.layouts.master')

@section('title', 'Flight Booking')

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

    @php
        $itinerary = $flight['itineraries'][0];
        $segments = $itinerary['segments'];
        $firstSegment = $segments[0];
        $lastSegment = end($segments);
        $stops = count($segments) - 1;
        $duration = \App\Helpers\Helper::formatDurations($itinerary['duration']);

        $base = $flight['price']['grandTotal'];
        $discount = 0.0;
        $tax = 0.0;
        $total = $base - $discount + $tax;
    @endphp
    <!-- Tour Booking Submission Areas -->
    <section id="tour_booking_submission" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <form action="{{ route('frontend.flight.booking.submission') }}" id="tour_bookking_form_item"
                        method="POST">
                        @csrf
                        <div class="tou_booking_form_Wrapper">
                            <div class="booking_tour_form">
                                <h3 class="heading_theme">Passenger information</h3>
                                <div class="tour_booking_form_box">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control bg_input"
                                                    placeholder="Full Name*" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control bg_input"
                                                    placeholder="Email address*" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="text" name="phone" class="form-control bg_input"
                                                    placeholder="Mobile number*" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="date" name="dob" class="form-control bg_input" required
                                                    id="dob">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <select name="gender" class="form-control form-select bg_input" required>
                                                    <option value="" disabled selected>Gender*</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" name="address" class="form-control bg_input"
                                                    placeholder="Street address">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="passport_no" class="form-control bg_input"
                                                    placeholder="Passport No.">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="visa_no" class="form-control bg_input"
                                                    placeholder="Visa No.">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="booking_tour_form">
                                <h3 class="heading_theme">Payment method</h3>
                                <div class="tour_booking_form_box">
                                    <div class="booking_payment_boxed">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" checked name="payment_method"
                                                id="flexRadioDefault4" value="cod">
                                            <label class="form-check-label" for="flexRadioDefault4">
                                                Cash on delivery
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- HIDDEN FLIGHT DETAILS -->
                            <input type="hidden" name="flight_price" value="{{ $flight['price']['grandTotal'] }}">
                            <input type="hidden" name="flight_airline" value="{{ $firstSegment['carrierCode'] }}">
                            <input type="hidden" name="flight_class"
                                value="{{ $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['cabin'] }}">
                            <input type="hidden" name="flight_from" value="{{ $firstSegment['departure']['iataCode'] }}">
                            <input type="hidden" name="flight_to" value="{{ $lastSegment['arrival']['iataCode'] }}">
                            <input type="hidden" name="flight_departure_datetime"
                                value="{{ $firstSegment['departure']['at'] }}">
                            <input type="hidden" name="flight_arrival_datetime"
                                value="{{ $lastSegment['arrival']['at'] }}">
                            <input type="hidden" name="flight_stops" value="{{ $stops }}">
                            <input type="hidden" name="flight_duration" value="{{ $itinerary['duration'] }}">
                            <input type="hidden" name="flight_segments" value="@json($segments)">

                            <!-- Travel Date -->
                            <input type="hidden" name="departure_date" value="{{ $search['departure_date'] ?? '' }}">

                            <!-- Passengers -->
                            <input type="hidden" name="adults" value="{{ $search['adults'] ?? 1 }}">
                            <input type="hidden" name="children" value="{{ $search['children'] ?? 0 }}">
                            <input type="hidden" name="infants" value="{{ $search['infants'] ?? 0 }}">

                            <!-- Total Amount -->
                            <input type="hidden" name="total_amount" value="{{ $total }}">

                            <!-- Tax Amount -->
                            <input type="hidden" name="tax" value="{{ $tax }}">

                            <!-- Coupon / Discount -->
                            <input type="hidden" name="discount_amount" value="{{ $discount }}">

                            <div class="booking_tour_form_submit">
                                <div class="form-check write_spical_check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultf1">
                                    <label class="form-check-label" for="flexCheckDefaultf1">
                                        I read and accept all <a href="#">Terms and conditios</a>

                                    </label>
                                </div>
                                <button type="submit" class="btn btn_theme btn_md mt-4">Book now</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="tour_details_right_sidebar_wrapper">

                        <!-- FLIGHT INFO -->
                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>Flights</h3>
                                </div>

                                <div class="flight_sidebar_right">
                                    <div class="flight_search_left_sidebar">
                                        <div class="flight_search_destination_sidebar">
                                            <p>From</p>
                                            <h3>{{ $firstSegment['departure']['iataCode'] }}</h3>
                                            <h6>{{ $firstSegment['departure']['terminal'] ?? '' }} -
                                                {{ $firstSegment['departure']['iataCode'] }}</h6>
                                        </div>
                                    </div>
                                    <div class="flight_search_middel_sidebar">
                                        <div class="flight_right_arrow_sidebar">
                                            <img src="{{ asset('frontAssets/img/icon/right_arrow.png') }}"
                                                alt="icon">
                                            <h6>{{ $stops == 0 ? 'Non-stop' : $stops . ' Stop(s)' }}</h6>
                                            <p>{{ $duration }}</p>
                                        </div>
                                        <div class="flight_search_destination_sidebar">
                                            <p>To</p>
                                            <h3>{{ $lastSegment['arrival']['iataCode'] }}</h3>
                                            <h6>{{ $lastSegment['arrival']['terminal'] ?? '' }} -
                                                {{ $lastSegment['arrival']['iataCode'] }}</h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- OPTIONAL: Flight rules -->
                                <div class="tour_package_details_bar_list">
                                    <h5>Flight segments</h5>
                                    <ul>
                                        @foreach ($segments as $seg)
                                            <li>
                                                {{ $seg['carrierCode'] }} {{ $seg['number'] }} -
                                                {{ $seg['departure']['iataCode'] }} → {{ $seg['arrival']['iataCode'] }}
                                                ({{ \App\Helpers\Helper::formatDurations($seg['duration']) }})
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="tour_package_details_bar_price">
                                    <h5>Price</h5>
                                    <div class="tour_package_bar_price">
                                        <h3>
                                            {{ \App\Helpers\Helper::formatCurrency($flight['price']['grandTotal']) }}
                                            <sub>/ Adult x {{ $search['adults'] ?? 1 }}</sub>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TRAVEL DATE -->
                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>Travel date</h3>
                                </div>
                                <div class="edit_date_form">
                                    <div class="form-group">
                                        <label for="dates">Edit Date</label>
                                        <input type="date" value="{{ $search['departure_date'] ?? '' }}"
                                            class="form-control" id="dates">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PASSENGERS -->
                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>Passengers</h3>
                                </div>
                                <div class="tour_package_details_bar_list">
                                    <div class="select_person_item">
                                        <div class="select_person_left">
                                            <h6>Adult</h6>
                                            <p>12y+</p>
                                        </div>
                                        <div class="select_person_right">
                                            <h6>{{ $search['adults'] ?? 1 }}</h6>
                                        </div>
                                    </div>
                                    <div class="select_person_item">
                                        <div class="select_person_left">
                                            <h6>Children</h6>
                                            <p>2 - 12 years</p>
                                        </div>
                                        <div class="select_person_right">
                                            <h6>{{ $search['children'] ?? 0 }}</h6>
                                        </div>
                                    </div>
                                    <div class="select_person_item">
                                        <div class="select_person_left">
                                            <h6>Infant</h6>
                                            <p>Below 2 years</p>
                                        </div>
                                        <div class="select_person_right">
                                            <h6>{{ $search['infants'] ?? 0 }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- COUPON -->
                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>Coupon code</h3>
                                </div>
                                <div class="coupon_code_area_booking">
                                    <form action="#!">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input"
                                                placeholder="Enter coupon code">
                                        </div>
                                        <div class="coupon_code_submit">
                                            <button class="btn btn_theme btn_md">Apply voucher</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- BOOKING AMOUNT -->
                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>Booking amount</h3>
                                </div>
                                <div class="tour_booking_amount_area">
                                    <ul>
                                        <li>Adult Price x {{ $search['adults'] ?? 1 }}
                                            <span>{{ \App\Helpers\Helper::formatCurrency($base) }}</span>
                                        </li>
                                        <li>Discount
                                            <span>-{{ $discount ? \App\Helpers\Helper::formatCurrency($discount) : '0' }}</span>
                                        </li>
                                        <li>Tax <span>{{ \App\Helpers\Helper::formatCurrency($tax) }}</span></li>
                                    </ul>
                                    <div class="tour_bokking_subtotal_area">
                                        <h6>Subtotal
                                            <span>{{ \App\Helpers\Helper::formatCurrency($base - $discount + $tax) }}</span>
                                        </h6>
                                    </div>
                                    <div class="total_subtotal_booking"
                                        style="border-top: 1px solid #dadada; margin-top: 15px;">
                                        <h6>Total Amount <span>{{ \App\Helpers\Helper::formatCurrency($total) }}</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    const dobInput = document.getElementById('dob');

    const today = new Date();
    const maxDate = new Date();
    maxDate.setFullYear(today.getFullYear() - 10); // today - 10 years

    const formatDate = (date) => date.toISOString().split('T')[0];

    dobInput.max = formatDate(maxDate); // 10 saal se kam wali dates disabled
</script>
@endsection
