@extends('frontend.layouts.master')

@section('title', 'Flights')

@section('css')
    <style>
        .left_side_search_heading h5 {
            border: none;
        }

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
    <!-- Form Area -->
    <section id="theme_search_form_tour">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="theme_search_form_area">
                        <div class="theme_search_form_tabbtn">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="flights-tab" data-bs-toggle="tab"
                                        data-bs-target="#flights" type="button" role="tab" aria-controls="flights"
                                        aria-selected="true"><i class="fas fa-plane-departure"></i>Flights</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tours-tab" data-bs-toggle="tab" data-bs-target="#tours"
                                        type="button" role="tab" aria-controls="tours" aria-selected="false"><i
                                            class="fas fa-globe"></i>Tours</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="hotels-tab" data-bs-toggle="tab" data-bs-target="#hotels"
                                        type="button" role="tab" aria-controls="hotels" aria-selected="false"><i
                                            class="fas fa-hotel"></i>Hotels</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="visa-tab" data-bs-toggle="tab"
                                        data-bs-target="#visa-application" type="button" role="tab"
                                        aria-controls="visa" aria-selected="false"><i class="fas fa-passport"></i>
                                        Visa</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="apartments-tab" data-bs-toggle="tab"
                                        data-bs-target="#apartments" type="button" role="tab"
                                        aria-controls="apartments" aria-selected="false"><i class="fas fa-building"></i>
                                        Apartments</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bus-tab" data-bs-toggle="tab" data-bs-target="#bus"
                                        type="button" role="tab" aria-controls="bus" aria-selected="false"><i
                                            class="fas fa-bus"></i> Bus</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="cruise-tab" data-bs-toggle="tab" data-bs-target="#cruise"
                                        type="button" role="tab" aria-controls="cruise" aria-selected="false"><i
                                            class="fas fa-ship"></i> Cruise</button>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="flights" role="tabpanel"
                                aria-labelledby="flights-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="flight_categories_search">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="oneway-tab" data-bs-toggle="tab"
                                                        data-bs-target="#oneway_flight" type="button" role="tab"
                                                        aria-controls="oneway_flight" aria-selected="true">One
                                                        Way</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="roundtrip-tab" data-bs-toggle="tab"
                                                        data-bs-target="#roundtrip" type="button" role="tab"
                                                        aria-controls="roundtrip" aria-selected="false">Roundtrip</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="multi_city-tab" data-bs-toggle="tab"
                                                        data-bs-target="#multi_city" type="button" role="tab"
                                                        aria-controls="multi_city" aria-selected="false">Multi
                                                        city</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent1">
                                    <div class="tab-pane fade show active" id="oneway_flight" role="tabpanel"
                                        aria-labelledby="oneway-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="oneway_search_form">
                                                    <form action="{{ route('frontend.flights') }}">
                                                        <input type="hidden" name="trip_type" id="tripType"
                                                            value="oneway">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed position-relative">
                                                                    <p>From</p>
                                                                    <input type="text" id="fromAirport"
                                                                        placeholder="From" autocomplete="off">
                                                                    <input type="text" hidden id="fromAirportCode"
                                                                        name="from_iata">
                                                                    <span id="fromAirportSpan">Airport</span>
                                                                    <ul id="fromSuggestions" class="airport-suggestions">
                                                                    </ul>
                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-departure"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed position-relative">
                                                                    <p>To</p>
                                                                    <input type="text" id="toAirport" placeholder="To"
                                                                        autocomplete="off">
                                                                    <input type="text" hidden id="toAirportCode"
                                                                        name="to_iata">
                                                                    <span id="toAirportSpan">Airport</span>
                                                                    <ul id="toSuggestions" class="airport-suggestions">
                                                                    </ul>
                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-arrival"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                <div class="form_search_date">
                                                                    <div class="flight_Search_boxed date_flex_area">
                                                                        <div class="departure_date">
                                                                            <p>Journey date</p>
                                                                            <input type="date" name="departure_date"
                                                                                value="" style="width: 100%;">
                                                                            <span>Thursday</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed dropdown_passenger_area">
                                                                    <p>Passenger, Class </p>
                                                                    <div class="dropdown">
                                                                        <button class="dropdown-toggle final-count"
                                                                            data-toggle="dropdown" type="button"
                                                                            id="dropdownMenuButton12"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            0 Passenger
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown_passenger_info"
                                                                            aria-labelledby="dropdownMenuButton1">
                                                                            <div class="traveller-calulate-persons">
                                                                                <div class="passengers">
                                                                                    <h6>Passengers</h6>
                                                                                    <div class="passengers-types">
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
                                                                                                    id="adultCountText"
                                                                                                    class="count pcount">0</span>
                                                                                                <div class="type-label">
                                                                                                    <p>Adult</p>
                                                                                                    <span>12+
                                                                                                        yrs</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="button-set">
                                                                                                <button type="button"
                                                                                                    class="btn-add">
                                                                                                    <i
                                                                                                        class="fas fa-plus"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn-subtract">
                                                                                                    <i
                                                                                                        class="fas fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
                                                                                                    class="count ccount">0</span>
                                                                                                <div class="type-label">
                                                                                                    <p
                                                                                                        class="fz14 mb-xs-0">
                                                                                                        Children
                                                                                                    </p><span>2
                                                                                                        - Less than 12
                                                                                                        yrs</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="button-set">
                                                                                                <button type="button"
                                                                                                    class="btn-add-c">
                                                                                                    <i
                                                                                                        class="fas fa-plus"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn-subtract-c">
                                                                                                    <i
                                                                                                        class="fas fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
                                                                                                    class="count incount">0</span>
                                                                                                <div class="type-label">
                                                                                                    <p
                                                                                                        class="fz14 mb-xs-0">
                                                                                                        Infant
                                                                                                    </p><span>Less
                                                                                                        than 2
                                                                                                        yrs</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="button-set">
                                                                                                <button type="button"
                                                                                                    class="btn-add-in">
                                                                                                    <i
                                                                                                        class="fas fa-plus"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn-subtract-in">
                                                                                                    <i
                                                                                                        class="fas fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="cabin-selection">
                                                                                    <h6>Cabin Class</h6>
                                                                                    <div class="cabin-list">
                                                                                        <button type="button"
                                                                                            class="label-select-btn">
                                                                                            <span
                                                                                                class="muiButton-label">Economy
                                                                                            </span>
                                                                                        </button>
                                                                                        <button type="button"
                                                                                            class="label-select-btn active">
                                                                                            <span class="muiButton-label">
                                                                                                Business
                                                                                            </span>
                                                                                        </button>
                                                                                        <button type="button"
                                                                                            class="label-select-btn">
                                                                                            <span
                                                                                                class="MuiButton-label">First
                                                                                                Class </span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <span id="cabinText">Business</span>
                                                                </div>
                                                            </div>
                                                            <div class="top_form_search_button">
                                                                <button class="btn btn_theme btn_md">Search</button>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="adults" id="adultCount"
                                                            value="0">
                                                        <input type="hidden" name="children" id="childCount"
                                                            value="0">
                                                        <input type="hidden" name="infants" id="infantCount"
                                                            value="0">
                                                        <input type="hidden" name="cabin_class" id="cabinClass"
                                                            value="Business">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="roundtrip" role="tabpanel"
                                        aria-labelledby="roundtrip-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="oneway_search_form">
                                                    <form action="#!">
                                                        <div class="row">
                                                            <div class="col-lg-3  col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed">
                                                                    <p>From</p>
                                                                    <input type="text" value="New York">
                                                                    <span>JFK - John F. Kennedy International...</span>
                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-departure"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed">
                                                                    <p>To</p>
                                                                    <input type="text" value="London ">
                                                                    <span>LCY, London city airport </span>
                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-arrival"></i>
                                                                    </div>
                                                                    <div class="range_plan">
                                                                        <i class="fas fa-exchange-alt"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4  col-md-6 col-sm-12 col-12">
                                                                <div class="form_search_date">
                                                                    <div class="flight_Search_boxed date_flex_area">
                                                                        <div class="departure_date">
                                                                            <p>Journey date</p>
                                                                            <input type="date" value="2022-05-05">
                                                                            <span>Thursday</span>
                                                                        </div>
                                                                        <div class="departure_date">
                                                                            <p>Return date</p>
                                                                            <input type="date" value="2022-05-08">
                                                                            <span>Saturday</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed dropdown_passenger_area">
                                                                    <p>Passenger, Class </p>
                                                                    <div class="dropdown">
                                                                        <button class="dropdown-toggle final-count"
                                                                            data-toggle="dropdown" type="button"
                                                                            id="dropdownMenuButton1"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            0 Passenger
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown_passenger_info"
                                                                            aria-labelledby="dropdownMenuButton1">
                                                                            <div class="traveller-calulate-persons">
                                                                                <div class="passengers">
                                                                                    <h6>Passengers</h6>
                                                                                    <div class="passengers-types">
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
                                                                                                    class="count pcount adultCountText">2</span>
                                                                                                <div class="type-label">
                                                                                                    <p>Adult</p>
                                                                                                    <span>12+
                                                                                                        yrs</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="button-set">
                                                                                                <button type="button"
                                                                                                    class="btn-add">
                                                                                                    <i
                                                                                                        class="fas fa-plus"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn-subtract">
                                                                                                    <i
                                                                                                        class="fas fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
                                                                                                    class="count ccount">0</span>
                                                                                                <div class="type-label">
                                                                                                    <p
                                                                                                        class="fz14 mb-xs-0">
                                                                                                        Children
                                                                                                    </p><span>2
                                                                                                        - Less than 12
                                                                                                        yrs</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="button-set">
                                                                                                <button type="button"
                                                                                                    class="btn-add-c">
                                                                                                    <i
                                                                                                        class="fas fa-plus"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn-subtract-c">
                                                                                                    <i
                                                                                                        class="fas fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
                                                                                                    class="count incount">0</span>
                                                                                                <div class="type-label">
                                                                                                    <p
                                                                                                        class="fz14 mb-xs-0">
                                                                                                        Infant
                                                                                                    </p><span>Less
                                                                                                        than 2
                                                                                                        yrs</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="button-set">
                                                                                                <button type="button"
                                                                                                    class="btn-add-in">
                                                                                                    <i
                                                                                                        class="fas fa-plus"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn-subtract-in">
                                                                                                    <i
                                                                                                        class="fas fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="cabin-selection">
                                                                                    <h6>Cabin Class</h6>
                                                                                    <div class="cabin-list">
                                                                                        <button type="button"
                                                                                            class="label-select-btn">
                                                                                            <span
                                                                                                class="muiButton-label">Economy
                                                                                            </span>
                                                                                        </button>
                                                                                        <button type="button"
                                                                                            class="label-select-btn active">
                                                                                            <span class="muiButton-label">
                                                                                                Business
                                                                                            </span>
                                                                                        </button>
                                                                                        <button type="button"
                                                                                            class="label-select-btn">
                                                                                            <span
                                                                                                class="MuiButton-label">First
                                                                                                Class </span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <span>Business</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="top_form_search_button">
                                                            <button class="btn btn_theme btn_md">Search</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="multi_city" role="tabpanel"
                                        aria-labelledby="multi_city-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="oneway_search_form">
                                                    <form action="#!">
                                                        <div class="multi_city_form_wrapper">
                                                            <div class="multi_city_form">
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                        <div class="flight_Search_boxed">
                                                                            <p>From</p>
                                                                            <input type="text" value="New York">
                                                                            <span>DAC, Hazrat Shahajalal
                                                                                International...</span>
                                                                            <div class="plan_icon_posation">
                                                                                <i class="fas fa-plane-departure"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                        <div class="flight_Search_boxed">
                                                                            <p>To</p>
                                                                            <input type="text" value="London ">
                                                                            <span>LCY, London city airport </span>
                                                                            <div class="plan_icon_posation">
                                                                                <i class="fas fa-plane-arrival"></i>
                                                                            </div>
                                                                            <div class="range_plan">
                                                                                <i class="fas fa-exchange-alt"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                                        <div class="form_search_date">
                                                                            <div
                                                                                class="flight_Search_boxed date_flex_area">
                                                                                <div class="departure_date">
                                                                                    <p>Journey date</p>
                                                                                    <input type="date"
                                                                                        value="2022-05-05">
                                                                                    <span>Thursday</span>
                                                                                </div>
                                                                                <div class="departure_date">
                                                                                    <p>Return date</p>
                                                                                    <input type="date"
                                                                                        value="2022-05-10">
                                                                                    <span>Saturday</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                                        <div
                                                                            class="flight_Search_boxed dropdown_passenger_area">
                                                                            <p>Passenger, Class </p>
                                                                            <div class="dropdown">
                                                                                <button class="dropdown-toggle final-count"
                                                                                    data-toggle="dropdown" type="button"
                                                                                    id="dropdownMenuButton1"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    0 Passenger
                                                                                </button>
                                                                                <div class="dropdown-menu dropdown_passenger_info"
                                                                                    aria-labelledby="dropdownMenuButton1">
                                                                                    <div
                                                                                        class="traveller-calulate-persons">
                                                                                        <div class="passengers">
                                                                                            <h6>Passengers</h6>
                                                                                            <div class="passengers-types">
                                                                                                <div
                                                                                                    class="passengers-type">
                                                                                                    <div class="text">
                                                                                                        <span
                                                                                                            class="count pcount adultCountText">0</span>
                                                                                                        <div
                                                                                                            class="type-label">
                                                                                                            <p>Adult</p>
                                                                                                            <span>12+
                                                                                                                yrs</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="button-set">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-add">
                                                                                                            <i
                                                                                                                class="fas fa-plus"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-subtract">
                                                                                                            <i
                                                                                                                class="fas fa-minus"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="passengers-type">
                                                                                                    <div class="text">
                                                                                                        <span
                                                                                                            class="count ccount">0</span>
                                                                                                        <div
                                                                                                            class="type-label">
                                                                                                            <p
                                                                                                                class="fz14 mb-xs-0">
                                                                                                                Children
                                                                                                            </p><span>2
                                                                                                                - Less
                                                                                                                than 12
                                                                                                                yrs</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="button-set">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-add-c">
                                                                                                            <i
                                                                                                                class="fas fa-plus"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-subtract-c">
                                                                                                            <i
                                                                                                                class="fas fa-minus"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="passengers-type">
                                                                                                    <div class="text">
                                                                                                        <span
                                                                                                            class="count incount">0</span>
                                                                                                        <div
                                                                                                            class="type-label">
                                                                                                            <p
                                                                                                                class="fz14 mb-xs-0">
                                                                                                                Infant
                                                                                                            </p><span>Less
                                                                                                                than 2
                                                                                                                yrs</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="button-set">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-add-in">
                                                                                                            <i
                                                                                                                class="fas fa-plus"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-subtract-in">
                                                                                                            <i
                                                                                                                class="fas fa-minus"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="cabin-selection">
                                                                                            <h6>Cabin Class</h6>
                                                                                            <div class="cabin-list">
                                                                                                <button type="button"
                                                                                                    class="label-select-btn">
                                                                                                    <span
                                                                                                        class="muiButton-label">Economy
                                                                                                    </span>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="label-select-btn active">
                                                                                                    <span
                                                                                                        class="muiButton-label">
                                                                                                        Business
                                                                                                    </span>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="label-select-btn">
                                                                                                    <span
                                                                                                        class="MuiButton-label">First
                                                                                                        Class </span>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <span>Business</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="multi_city_form">
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                        <div class="flight_Search_boxed">
                                                                            <p>From</p>
                                                                            <input type="text" value="New York">
                                                                            <span>DAC, Hazrat Shahajalal
                                                                                International...</span>
                                                                            <div class="plan_icon_posation">
                                                                                <i class="fas fa-plane-departure"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                        <div class="flight_Search_boxed">
                                                                            <p>To</p>
                                                                            <input type="text" value="London ">
                                                                            <span>LCY, London city airport </span>
                                                                            <div class="plan_icon_posation">
                                                                                <i class="fas fa-plane-arrival"></i>
                                                                            </div>
                                                                            <div class="range_plan">
                                                                                <i class="fas fa-exchange-alt"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                                        <div class="form_search_date">
                                                                            <div
                                                                                class="flight_Search_boxed date_flex_area">
                                                                                <div class="departure_date">
                                                                                    <p>Journey date</p>
                                                                                    <input type="date"
                                                                                        value="2022-05-05">
                                                                                    <span>Thursday</span>
                                                                                </div>
                                                                                <div class="departure_date">
                                                                                    <p>Return date</p>
                                                                                    <input type="date"
                                                                                        value="2022-05-12">
                                                                                    <span>Saturday</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                                        <div
                                                                            class="flight_Search_boxed dropdown_passenger_area">
                                                                            <p>Passenger, Class </p>
                                                                            <div class="dropdown">
                                                                                <button class="dropdown-toggle final-count"
                                                                                    data-toggle="dropdown" type="button"
                                                                                    id="dropdownMenuButton1"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    0 Passenger
                                                                                </button>
                                                                                <div class="dropdown-menu dropdown_passenger_info"
                                                                                    aria-labelledby="dropdownMenuButton1">
                                                                                    <div
                                                                                        class="traveller-calulate-persons">
                                                                                        <div class="passengers">
                                                                                            <h6>Passengers</h6>
                                                                                            <div class="passengers-types">
                                                                                                <div
                                                                                                    class="passengers-type">
                                                                                                    <div class="text">
                                                                                                        <span
                                                                                                            class="count pcount adultCountText">0</span>
                                                                                                        <div
                                                                                                            class="type-label">
                                                                                                            <p>Adult</p>
                                                                                                            <span>12+
                                                                                                                yrs</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="button-set">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-add">
                                                                                                            <i
                                                                                                                class="fas fa-plus"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-subtract">
                                                                                                            <i
                                                                                                                class="fas fa-minus"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="passengers-type">
                                                                                                    <div class="text">
                                                                                                        <span
                                                                                                            class="count ccount">0</span>
                                                                                                        <div
                                                                                                            class="type-label">
                                                                                                            <p
                                                                                                                class="fz14 mb-xs-0">
                                                                                                                Children
                                                                                                            </p><span>2
                                                                                                                - Less
                                                                                                                than 12
                                                                                                                yrs</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="button-set">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-add-c">
                                                                                                            <i
                                                                                                                class="fas fa-plus"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-subtract-c">
                                                                                                            <i
                                                                                                                class="fas fa-minus"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="passengers-type">
                                                                                                    <div class="text">
                                                                                                        <span
                                                                                                            class="count incount">0</span>
                                                                                                        <div
                                                                                                            class="type-label">
                                                                                                            <p
                                                                                                                class="fz14 mb-xs-0">
                                                                                                                Infant
                                                                                                            </p><span>Less
                                                                                                                than 2
                                                                                                                yrs</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="button-set">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-add-in">
                                                                                                            <i
                                                                                                                class="fas fa-plus"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-subtract-in">
                                                                                                            <i
                                                                                                                class="fas fa-minus"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="cabin-selection">
                                                                                            <h6>Cabin Class</h6>
                                                                                            <div class="cabin-list">
                                                                                                <button type="button"
                                                                                                    class="label-select-btn">
                                                                                                    <span
                                                                                                        class="muiButton-label">Economy
                                                                                                    </span>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="label-select-btn active">
                                                                                                    <span
                                                                                                        class="muiButton-label">
                                                                                                        Business
                                                                                                    </span>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="label-select-btn">
                                                                                                    <span
                                                                                                        class="MuiButton-label">First
                                                                                                        Class </span>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <span>Business</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="add_multy_form">
                                                                    <button type="button" id="addMulticityRow">+ Add
                                                                        another
                                                                        flight</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="top_form_search_button">
                                                            <button class="btn btn_theme btn_md">Search</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Flight Search Areas -->
    <section id="explore_area" class="section_padding">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>{{ count($flights) }} tours found</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_side_search_area">

                        <!-- PRICE -->
                        <div class="left_side_search_boxed">
                            <div class="left_side_search_heading">
                                <h5>Filter by price</h5>
                            </div>
                            <input type="range" id="priceRange" class="w-100">
                            <p class="mt-2" id="priceLabel"></p>
                        </div>

                        <!-- STOPS -->
                        <div class="left_side_search_boxed">
                            <div class="left_side_search_heading">
                                <h5>Number of stops</h5>
                            </div>
                            <div id="stopsFilter"></div>
                        </div>

                        <!-- CLASS -->
                        <div class="left_side_search_boxed">
                            <div class="left_side_search_heading">
                                <h5>Flight class</h5>
                            </div>
                            <div id="classFilter"></div>
                        </div>

                        <!-- AIRLINES -->
                        <div class="left_side_search_boxed">
                            <div class="left_side_search_heading">
                                <h5>Airlines</h5>
                            </div>
                            <div id="airlineFilter"></div>
                        </div>

                        <!-- RESET -->
                        <div class="left_side_search_boxed text-center">
                            <button class="btn btn_theme btn_sm" id="resetFilters">
                                Reset Filters
                            </button>
                        </div>

                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="flight_search_result_wrapper">
                                @foreach ($flights as $index => $flight)
                                    @php
                                        $itinerary = $flight['itineraries'][0];
                                        $segments = $itinerary['segments'];

                                        $firstSegment = $segments[0];
                                        $lastSegment = end($segments);

                                        $stops = count($segments) - 1;
                                    @endphp

                                    <div class="flight-item flight_search_result_wrapper"
                                        data-price="{{ $flight['price']['grandTotal'] }}" data-stops="{{ $stops }}"
                                        data-airline="{{ $firstSegment['carrierCode'] }}"
                                        data-class="{{ $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['cabin'] }}">
                                        <div class="flight_search_item_wrappper">
                                            <div class="flight_search_items">

                                                <!-- LEFT -->
                                                <div class="flight_multis_area_wrapper">
                                                    <div class="flight_search_left">
                                                        <div class="flight_logo">
                                                            <img src="https://content.airhex.com/content/logos/airlines_{{ strtolower($firstSegment['carrierCode']) }}_100_100_s.png"
                                                                alt="airline">
                                                        </div>

                                                        <div class="flight_search_destination">
                                                            <p>From</p>
                                                            <h3>{{ $firstSegment['departure']['iataCode'] }}</h3>
                                                            <h6>{{ \App\Helpers\Helper::formatTime($firstSegment['departure']['at']) }}
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <!-- MIDDLE -->
                                                    <div class="flight_search_middel">
                                                        <div class="flight_right_arrow">
                                                            <img src="{{ asset('frontAssets/img/icon/right_arrow.png') }}"
                                                                alt="icon">
                                                            <h6>{{ $stops == 0 ? 'Non-stop' : $stops . ' Stop(s)' }}</h6>
                                                            <p>{{ \App\Helpers\Helper::formatDurations($itinerary['duration']) }}
                                                            </p>
                                                        </div>

                                                        <div class="flight_search_destination">
                                                            <p>To</p>
                                                            <h3>{{ $lastSegment['arrival']['iataCode'] }}</h3>
                                                            <h6>{{ \App\Helpers\Helper::formatTime($lastSegment['arrival']['at']) }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- RIGHT -->
                                                <div class="flight_search_right">
                                                    <h2>
                                                        {{ \App\Helpers\Helper::formatCurrency($flight['price']['grandTotal']) }}
                                                    </h2>

                                                    <form action="{{ route('frontend.flight.booking') }}" method="GET">
                                                        {{-- SEARCH QUERY --}}
                                                        <input type="hidden" name="trip_type" value="{{ request('trip_type') }}">
                                                        <input type="hidden" name="from_iata" value="{{ request('from_iata') }}">
                                                        <input type="hidden" name="to_iata" value="{{ request('to_iata') }}">
                                                        <input type="hidden" name="departure_date" value="{{ request('departure_date') }}">
                                                        <input type="hidden" name="adults" value="{{ request('adults') }}">
                                                        <input type="hidden" name="children" value="{{ request('children') }}">
                                                        <input type="hidden" name="infants" value="{{ request('infants') }}">
                                                        <input type="hidden" name="cabin_class" value="{{ request('cabin_class') }}">

                                                        {{-- SELECTED FLIGHT --}}
                                                        <input type="hidden" name="flight"
                                                            value="{{ base64_encode(json_encode($flight)) }}">
                                                        <button class="btn btn_theme btn_sm">
                                                            Book now
                                                        </button>
                                                    </form>

                                                    <h6 data-bs-toggle="collapse"
                                                        data-bs-target="#flight{{ $index }}">
                                                        Show more <i class="fas fa-chevron-down"></i>
                                                    </h6>
                                                </div>

                                            </div>

                                            <!-- EXPANDED DETAILS -->
                                            <div class="flight_policy_refund collapse" id="flight{{ $index }}">
                                                @foreach ($segments as $segment)
                                                    <div class="flight_show_down_wrapper">
                                                        <div class="flight-shoe_dow_item">

                                                            <div class="airline-details">
                                                                <div class="img">
                                                                    <img
                                                                        src="https://content.airhex.com/content/logos/airlines_{{ strtolower($segment['carrierCode']) }}_100_100_s.png">
                                                                </div>

                                                                <span class="airlineName fw-500">
                                                                    {{ $segment['carrierCode'] }} {{ $segment['number'] }}
                                                                </span>

                                                                <span class="flightNumber">
                                                                    Aircraft: {{ $segment['aircraft']['code'] ?? 'N/A' }}
                                                                </span>
                                                            </div>

                                                            <div class="flight_inner_show_component">
                                                                <div class="flight_det_wrapper">
                                                                    <div class="flight_det">
                                                                        <div class="code_time">
                                                                            <span
                                                                                class="code">{{ $segment['departure']['iataCode'] }}</span>
                                                                            <span
                                                                                class="time">{{ \App\Helpers\Helper::formatTime($segment['departure']['at']) }}</span>
                                                                        </div>
                                                                        <p class="date">
                                                                            {{ \App\Helpers\Helper::formatDate($segment['departure']['at']) }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="flight_duration">
                                                                    <div class="arrow_right"></div>
                                                                    <span>{{ \App\Helpers\Helper::formatDurations($segment['duration']) }}</span>
                                                                </div>

                                                                <div class="flight_det_wrapper">
                                                                    <div class="flight_det">
                                                                        <div class="code_time">
                                                                            <span
                                                                                class="code">{{ $segment['arrival']['iataCode'] }}</span>
                                                                            <span
                                                                                class="time">{{ \App\Helpers\Helper::formatTime($segment['arrival']['at']) }}</span>
                                                                        </div>
                                                                        <p class="date">
                                                                            {{ \App\Helpers\Helper::formatDate($segment['arrival']['at']) }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            {{-- <div class="load_more_flight">
                                <button class="btn btn_md"><i class="fas fa-spinner"></i> Load more..</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        const ALL_FLIGHTS = @json($flights);
        const filterData = {
            stops: {},
            airlines: {},
            classes: {},
            prices: []
        };

        // COLLECT DATA
        ALL_FLIGHTS.forEach(f => {
            const segments = f.itineraries[0].segments;
            const stops = segments.length - 1;
            const airline = segments[0].carrierCode;
            const cabin = f.travelerPricings[0].fareDetailsBySegment[0].cabin;
            const price = parseFloat(f.price.grandTotal);

            filterData.stops[stops] = (filterData.stops[stops] || 0) + 1;
            filterData.airlines[airline] = (filterData.airlines[airline] || 0) + 1;
            filterData.classes[cabin] = (filterData.classes[cabin] || 0) + 1;
            filterData.prices.push(price);
        });

        // RENDER SIDEBAR
        function renderSidebar() {

            // PRICE
            const maxPrice = Math.ceil(Math.max(...filterData.prices));
            const priceRange = document.getElementById('priceRange');
            priceRange.max = maxPrice;
            priceRange.value = maxPrice;
            document.getElementById('priceLabel').innerText = `Up to $${maxPrice}`;

            // STOPS
            let stopsHTML = '';
            Object.keys(filterData.stops).sort().forEach(s => {
                stopsHTML += `
        <div class="form-check">
            <input class="form-check-input stop-filter" type="checkbox" value="${s}">
            <label class="form-check-label">
                ${s == 0 ? 'Non-stop' : s + ' stop'} (${filterData.stops[s]})
            </label>
        </div>`;
            });
            document.getElementById('stopsFilter').innerHTML = stopsHTML;

            // CLASS
            let classHTML = '';
            Object.keys(filterData.classes).forEach(c => {
                classHTML += `
        <div class="form-check">
            <input class="form-check-input class-filter" type="checkbox" value="${c}">
            <label class="form-check-label">
                ${c} (${filterData.classes[c]})
            </label>
        </div>`;
            });
            document.getElementById('classFilter').innerHTML = classHTML;

            // AIRLINES
            let airlineHTML = '';
            Object.keys(filterData.airlines).forEach(a => {
                airlineHTML += `
        <div class="form-check">
            <input class="form-check-input airline-filter" type="checkbox" value="${a}">
            <label class="form-check-label">
                ${a} (${filterData.airlines[a]})
            </label>
        </div>`;
            });
            document.getElementById('airlineFilter').innerHTML = airlineHTML;
        }

        // APPLY FILTERS
        function applyFilters() {

            const maxPrice = parseFloat(document.getElementById('priceRange').value);

            const stops = [...document.querySelectorAll('.stop-filter:checked')].map(e => e.value);
            const airlines = [...document.querySelectorAll('.airline-filter:checked')].map(e => e.value);
            const classes = [...document.querySelectorAll('.class-filter:checked')].map(e => e.value);

            document.querySelectorAll('.flight-item').forEach(item => {

                const price = parseFloat(item.dataset.price);
                const stop = String(item.dataset.stops);
                const airline = item.dataset.airline;
                const cabin = item.dataset.class;

                let show = true;

                if (price > maxPrice) show = false;
                if (stops.length && !stops.includes(stop)) show = false;
                if (airlines.length && !airlines.includes(airline)) show = false;
                if (classes.length && !classes.includes(cabin)) show = false;

                item.style.display = show ? 'block' : 'none';
            });
        }


        // RESET
        document.getElementById('resetFilters').addEventListener('click', () => {
            document.querySelectorAll('input[type=checkbox]').forEach(cb => cb.checked = false);
            const priceRange = document.getElementById('priceRange');
            priceRange.value = priceRange.max;
            document.getElementById('priceLabel').innerText = `Up to $${priceRange.max}`;
            applyFilters();
        });

        // EVENTS
        document.addEventListener('change', applyFilters);
        document.getElementById('priceRange').addEventListener('input', function() {
            document.getElementById('priceLabel').innerText = `Up to $${this.value}`;
            applyFilters();
        });

        // INIT
        renderSidebar();
    </script>


    <script>
        /* =====================================================
                                AIRPORT AUTOCOMPLETE
                                ===================================================== */
        async function searchAirports(query, suggestionBox, inputField, spanField, codeField) {
            if (query.length < 2) {
                suggestionBox.innerHTML = '';
                return;
            }

            const res = await fetch('/airports');
            const data = await res.json();

            const airports = data.filter(a =>
                a.name?.toLowerCase().includes(query.toLowerCase()) ||
                a.city?.toLowerCase().includes(query.toLowerCase()) ||
                a.iata?.toLowerCase().includes(query.toLowerCase())
            ).slice(0, 5);

            suggestionBox.innerHTML = '';

            airports.forEach(airport => {
                const li = document.createElement('li');
                li.innerHTML = `<strong>${airport.iata}</strong> - ${airport.name}, ${airport.city}`;

                li.onclick = () => {
                    inputField.value = airport.city;
                    spanField.innerText = airport.iata + ' - ' + airport.name;
                    codeField.value = airport.iata;
                    suggestionBox.innerHTML = '';
                };

                suggestionBox.appendChild(li);
            });
        }

        function setupAutocomplete(inputId, codeId, suggestionId, spanId) {
            const input = document.getElementById(inputId);
            const codeInput = document.getElementById(codeId);
            const suggestions = document.getElementById(suggestionId);
            const span = document.getElementById(spanId);

            input.addEventListener('input', () => {
                searchAirports(input.value, suggestions, input, span, codeInput);
            });

            document.addEventListener('click', e => {
                if (!input.contains(e.target)) suggestions.innerHTML = '';
            });
        }

        /* =====================================================
           MAIN LOGIC
        ===================================================== */
        document.addEventListener('DOMContentLoaded', function() {

            const params = new URLSearchParams(window.location.search);
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            /* =====================
               AUTOCOMPLETE INIT
            ====================== */
            setupAutocomplete('fromAirport', 'fromAirportCode', 'fromSuggestions', 'fromAirportSpan');
            setupAutocomplete('toAirport', 'toAirportCode', 'toSuggestions', 'toAirportSpan');

            /* =====================
               TRIP TYPE
            ====================== */
            const tripInput = document.getElementById('tripType');
            const tripType = params.get('trip_type') || 'oneway';
            console.log('Trip Type:', tripType);
            tripInput.value = tripType;

            document.querySelectorAll('.nav-link').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(t => t.classList.remove('show', 'active'));
            document.getElementById('flights-tab').classList.add('active');
            document.getElementById('flights').classList.add('show', 'active');

            if (tripType === 'roundtrip') {
                document.getElementById('roundtrip-tab').classList.add('active');
                document.getElementById('roundtrip').classList.add('show', 'active');
            } else if (tripType === 'multicity') {
                document.getElementById('multi_city-tab').classList.add('active');
                document.getElementById('multi_city').classList.add('show', 'active');
            } else {
                console.log('Setting Oneway Active');
                document.getElementById('oneway-tab').classList.add('active');
                document.getElementById('oneway_flight').classList.add('show', 'active');
            }

            document.getElementById('oneway-tab').onclick = () => tripInput.value = 'oneway';
            document.getElementById('roundtrip-tab').onclick = () => tripInput.value = 'roundtrip';
            document.getElementById('multi_city-tab').onclick = () => tripInput.value = 'multicity';

            /* =====================
               PASSENGERS
            ====================== */
            let adult = parseInt(params.get('adults')) || 0;
            let child = parseInt(params.get('children')) || 0;
            let infant = parseInt(params.get('infants')) || 0;

            const adultSpan = document.getElementById('adultCountText');
            const childSpan = document.querySelector('.ccount');
            const infantSpan = document.querySelector('.incount');
            const finalBtn = document.querySelector('.final-count');

            const adultInput = document.getElementById('adultCount');
            const childInput = document.getElementById('childCount');
            const infantInput = document.getElementById('infantCount');

            function updatePassengers() {
                console.log('Updating Passengers:', adult, child, infant);
                adultSpan.innerText = adult;
                childSpan.innerText = child;
                infantSpan.innerText = infant;

                adultInput.value = adult;
                childInput.value = child;
                infantInput.value = infant;

                finalBtn.innerText = (adult + child + infant) + ' Passenger';
            }

            updatePassengers();

            document.querySelector('.btn-add').onclick = () => {
                adult++;
                updatePassengers();
            };
            document.querySelector('.btn-subtract').onclick = () => {
                if (adult > 0) adult--;
                updatePassengers();
            };
            document.querySelector('.btn-add-c').onclick = () => {
                child++;
                updatePassengers();
            };
            document.querySelector('.btn-subtract-c').onclick = () => {
                if (child > 0) child--;
                updatePassengers();
            };
            document.querySelector('.btn-add-in').onclick = () => {
                infant++;
                updatePassengers();
            };
            document.querySelector('.btn-subtract-in').onclick = () => {
                if (infant > 0) infant--;
                updatePassengers();
            };

            /* =====================
               CABIN CLASS
            ====================== */
            const cabin = params.get('cabin_class') || 'Business';
            document.getElementById('cabinClass').value = cabin;
            // document.querySelector('.dropdown_passenger_area').innerText = cabin;

            const cabinText = document.getElementById('cabinText');
            cabinText.innerText = cabin;

            document.querySelectorAll('.label-select-btn').forEach(btn => {
                btn.classList.toggle('active', btn.innerText.trim() === cabin);
                btn.onclick = function() {
                    document.querySelectorAll('.label-select-btn').forEach(b => b.classList.remove(
                        'active'));
                    this.classList.add('active');
                    document.getElementById('cabinClass').value = this.innerText.trim();
                    document.querySelector('.dropdown_passenger_area span').innerText = this.innerText
                        .trim();
                };
            });

            /* =====================
               DATE
            ====================== */
            const dateInput = document.querySelector('.departure_date input[type="date"]');
            const daySpan = document.querySelector('.departure_date span');

            const journeyDate = params.get('departure_date') || new Date().toISOString().split('T')[0];
            dateInput.value = journeyDate;
            daySpan.innerText = days[new Date(journeyDate).getDay()];

            dateInput.onchange = () => {
                daySpan.innerText = days[new Date(dateInput.value).getDay()];
            };

            /* =====================
               AIRPORTS FROM URL
            ====================== */
            /* ========= FROM AIRPORT ========= */
            if (params.get('from_iata')) {
                applyAirportByIATA(
                    params.get('from_iata'),
                    document.getElementById('fromAirport'),
                    document.getElementById('fromAirportSpan'),
                    document.getElementById('fromAirportCode')
                );
            }

            /* ========= TO AIRPORT ========= */
            if (params.get('to_iata')) {
                applyAirportByIATA(
                    params.get('to_iata'),
                    document.getElementById('toAirport'),
                    document.getElementById('toAirportSpan'),
                    document.getElementById('toAirportCode')
                );
            }

        });

        async function applyAirportByIATA(iata, inputField, spanField, codeField) {
            try {
                const res = await fetch('/airports');
                const airports = await res.json();

                const airport = airports.find(a => a.iata === iata);
                if (!airport) return;

                inputField.value = airport.city;
                spanField.innerText = `${airport.iata} - ${airport.name}, ${airport.city}`;
                codeField.value = airport.iata;

            } catch (e) {
                console.error('Airport load failed', e);
            }
        }
    </script>

@endsection
