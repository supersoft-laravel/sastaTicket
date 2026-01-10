@extends('frontend.layouts.master')

@section('title', 'Home')

@section('css')
    <style>
        .airport-suggestions {
            list-style: none;
            padding: 0;
            margin: 5px 0 0;
            position: absolute;
            width: 100%;
            background: #fff;
            /* border: 1px solid #ddd; */
            max-height: 230px;
            overflow-y: auto;
            z-index: 9999;
        }

        .airport-suggestions li {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #f1f1f1;
            font-size: 14px;
        }

        .airport-suggestions li:hover {
            background-color: #f5f5f5;
        }
    </style>
@endsection

@section('content')
    <!-- Banner Area -->
    <section id="home_one_banner" style="background-image: url({{ asset('frontAssets/img/bus/bg-5.jpg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_one_text">
                        <h1 style="font-family: 'alegreya-sans">Explore the world together</h1>
                        <h3>Find awesome flights, hotel, tour, car and packages</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Area -->
    <section id="theme_search_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="theme_search_form_area">
                        <div class="theme_search_form_tabbtn">
                            <ul class="nav nav-tabs" role="tablist" style="justify-content: center">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="flights-tab" data-bs-toggle="tab"
                                        data-bs-target="#flights" type="button" role="tab" aria-controls="flights"
                                        aria-selected="true"><i class="fas fa-plane-departure"></i>Flights
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#"> <button class="nav-link" id="hotels-tab" type="button"
                                            role="tab" aria-controls="hotels" aria-selected="false"><i
                                                class="fas fa-hotel"></i>Hotels
                                        </button></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#"><button class="nav-link" id="tours-tab" type="button" role="tab"
                                            aria-controls="tours" aria-selected="false"><i class="fas fa-globe"></i>Tours
                                        </button></a>
                                </li>




                                <li class="nav-item" role="presentation">
                                    <a href="#"><button class="nav-link" id="visa-tab" type="button" role="tab"
                                            aria-controls="visa" aria-selected="false"><i class="fas fa-passport"></i> Visa
                                        </button></a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="#"><button class="nav-link" id="bus-tab" type="button" role="tab"
                                            aria-controls="bus" aria-selected="false"><i class="fas fa-bus"></i> Private
                                            Transport
                                        </button></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#"><button class="nav-link " id="cruise-tab" type="button"
                                            role="tab" aria-controls="cruise" aria-selected="false"><i
                                                class="fas fa-ship"></i> Cruise
                                        </button></a>
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
                                                        Way
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="roundtrip-tab" data-bs-toggle="tab"
                                                        data-bs-target="#roundtrip" type="button" role="tab"
                                                        aria-controls="roundtrip" aria-selected="false">Roundtrip
                                                    </button>
                                                </li>
                                                {{-- <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="multi_city-tab" data-bs-toggle="tab"
                                                        data-bs-target="#multi_city" type="button" role="tab"
                                                        aria-controls="multi_city" aria-selected="false">Multi
                                                        city
                                                    </button>
                                                </li> --}}
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
                                                    <form class="flight-form oneway-form"
                                                        action="{{ route('frontend.flights') }}">
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
                                                                        <div class="dropdown-menu dropdown_passenger_info dropdown_passenger_infoOne"
                                                                            aria-labelledby="dropdownMenuButton1">
                                                                            <div class="traveller-calulate-persons">
                                                                                <div class="passengers">
                                                                                    <h6>Passengers</h6>
                                                                                    <div class="passengers-types">
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
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
                                                                    <span>Business</span>
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
                                                    <form class="flight-form roundtrip-form"
                                                        action="{{ route('frontend.flights') }}">
                                                        <input type="hidden" name="trip_type" id="tripType"
                                                            value="roundtrip">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed position-relative">
                                                                    <p>From</p>
                                                                    <input type="text" id="fromAirportRound"
                                                                        placeholder="From" autocomplete="off">
                                                                    <input type="text" hidden id="fromAirportCodeRound"
                                                                        name="from_iata">
                                                                    <span id="fromAirportSpanRound">Airport</span>
                                                                    <ul id="fromSuggestionsRound"
                                                                        class="airport-suggestions">
                                                                    </ul>
                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-departure"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed position-relative">
                                                                    <p>To</p>
                                                                    <input type="text" id="toAirportRound"
                                                                        placeholder="To" autocomplete="off">
                                                                    <input type="text" hidden id="toAirportCodeRound"
                                                                        name="to_iata">
                                                                    <span id="toAirportSpanRound">Airport</span>
                                                                    <ul id="toSuggestionsRound"
                                                                        class="airport-suggestions">
                                                                    </ul>
                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-arrival"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4  col-md-6 col-sm-12 col-12">
                                                                <div class="form_search_date">
                                                                    <div class="flight_Search_boxed date_flex_area">
                                                                        <div class="departure_date">
                                                                            <p>Journey date</p>
                                                                            <input type="date" name="departure_date"
                                                                                id="roundDeparture">
                                                                            <span>Thursday</span>
                                                                        </div>

                                                                        <div class="departure_date">
                                                                            <p>Return date</p>
                                                                            <input type="date" name="return_date"
                                                                                id="roundReturn">
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
                                                                            id="dropdownMenuButton14"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            0 Passenger
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown_passenger_info dropdown_passenger_infoRound"
                                                                            aria-labelledby="dropdownMenuButton14">
                                                                            <div class="traveller-calulate-persons">
                                                                                <div class="passengers">
                                                                                    <h6>Passengers</h6>
                                                                                    <div class="passengers-types">
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
                                                                                                    class="count pcountRound">0</span>
                                                                                                <div class="type-label">
                                                                                                    <p>Adult</p>
                                                                                                    <span>12+
                                                                                                        yrs</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="button-set">
                                                                                                <button type="button"
                                                                                                    class="btn-addRound">
                                                                                                    <i
                                                                                                        class="fas fa-plus"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn-subtractRound">
                                                                                                    <i
                                                                                                        class="fas fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
                                                                                                    class="count ccountRound">0</span>
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
                                                                                                    class="btn-add-cRound">
                                                                                                    <i
                                                                                                        class="fas fa-plus"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn-subtract-cRound">
                                                                                                    <i
                                                                                                        class="fas fa-minus"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="passengers-type">
                                                                                            <div class="text"><span
                                                                                                    class="count incountRound">0</span>
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
                                                                                                    class="btn-add-inRound">
                                                                                                    <i
                                                                                                        class="fas fa-plus"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn-subtract-inRound">
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

                                                        <input type="hidden" name="adults" id="adultCountRound"
                                                            value="0">
                                                        <input type="hidden" name="children" id="childCountRound"
                                                            value="0">
                                                        <input type="hidden" name="infants" id="infantCountRound"
                                                            value="0">
                                                        <input type="hidden" name="cabin_class" id="cabinClassRound"
                                                            value="Business">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="multi_city" role="tabpanel"
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
                                                                                    id="dropdownMenuButton15"
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
                                                                                                        <span class="count pcountRound">0</span>
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
                                                                                                            class="btn-addRound">
                                                                                                            <i
                                                                                                                class="fas fa-plus"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-subtractRound">
                                                                                                            <i
                                                                                                                class="fas fa-minus"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="passengers-type">
                                                                                                    <div class="text">
                                                                                                        <span
                                                                                                            class="count ccountRound">0</span>
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
                                                                                                            class="btn-add-cRound">
                                                                                                            <i
                                                                                                                class="fas fa-plus"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-subtract-cRound">
                                                                                                            <i
                                                                                                                class="fas fa-minus"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="passengers-type">
                                                                                                    <div class="text">
                                                                                                        <span
                                                                                                            class="count incountRound">0</span>
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
                                                                                                            class="btn-add-inRound">
                                                                                                            <i class="fas fa-plus"></i>
                                                                                                        </button>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn-subtract-inRound">
                                                                                                            <i class="fas fa-minus"></i>
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
                                                                                    id="dropdownMenuButton14"
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
                                                                                                            class="count pcount">2</span>
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
                                                                        flight
                                                                    </button>
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
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top destinations -->
    <section id="top_destinations" class="section_padding_top">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Top destinations</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="destinations_content_box img_animation">
                        <img src="{{ asset('frontAssets/img/home/pic1.png') }}" alt="img">
                        <div class="destinations_content_inner">
                            <h2>Up to</h2>
                            <div class="destinations_big_offer">
                                <h1>50</h1>
                                <h6><span>%</span> <span>Off</span></h6>
                            </div>
                            <h2>Holiday packages</h2>
                            <!--<a href="#" class="btn btn_theme btn_md">Book now</a>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="destinations_content_box img_animation">
                                <a href="#">
                                    <img src="{{ asset('frontAssets/img/home/china.png') }}" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="#">China</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="#">
                                    <img src="{{ asset('frontAssets/img/home/darleejing.png') }}" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="#">Darjeeling</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="#">
                                    <img src="{{ asset('frontAssets/img/home/malaysia.png') }}" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="#">Malaysia</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="destinations_content_box img_animation">
                                <a href="#">
                                    <img src="{{ asset('frontAssets/img/home/gangtok.png') }}" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="#">Gangtok</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="#">
                                    <img src="{{ asset('frontAssets/img/home/thailand.png') }}" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="#">Thailand</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="#">
                                    <img src="{{ asset('frontAssets/img/home/australia.png') }}" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="#">Australia</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="destinations_content_box img_animation">
                                <a href="#">
                                    <img src="{{ asset('frontAssets/img/home/london.png') }}" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="#">London</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="#">
                                    <img src="{{ asset('frontAssets/img/home/usa.png') }}" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="#">USA</a></h3>
                                </div>
                            </div>
                            <!--<div class="destinations_content_box">-->
                            <!--    <a href="#" class="btn btn_theme btn_md w-100">View all</a>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonials Area -->
    <section id="testimonials_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>What our client say about us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="all_review_box">
                        <div class="all_review_date_area">
                            <div class="all_review_date">
                                <h5>13 Feb, 2023</h5>
                            </div>
                            <div class="all_review_star">
                                <h5>Excellent</h5>
                                <div class="review_star_all">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="all_review_text">
                            <!--                        <img src="assets/img/review/review2.png" alt="img">-->

                            <h4>Syed Talha Hussain</h4>
                            <p>"Great experience I had with Afrah Travel and Tour, fully supportive and committed. Service I
                                was told before travelling, I Experienced same. Keep it up... 👍"</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="all_review_box">
                        <div class="all_review_date_area">
                            <div class="all_review_date">
                                <h5>31 Jan, 2023</h5>
                            </div>
                            <div class="all_review_star">
                                <h5>Excellent</h5>
                                <div class="review_star_all">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="all_review_text">
                            <!--                        <img src="assets/img/review/review3.png" alt="img">-->
                            <h4>Nadir Khan</h4>
                            <p>"This travel agency is very fine. The management is very curious about people's need and
                                working. I travelled through this agency and its really amazing. I would like to recommend
                                to my friends n relatives 👍"</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="all_review_box">
                        <div class="all_review_date_area">
                            <div class="all_review_date">
                                <h5>09 Jan, 2023</h5>
                            </div>
                            <div class="all_review_star">
                                <h5>Excellent</h5>
                                <div class="review_star_all">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="all_review_text">
                            <!--                        <img src="assets/img/review/review4.png" alt="img">-->
                            <h4>Ahmad Ullah JJungg</h4>
                            <p>"They are very professional in their work, will always recommend them if you want to travel
                                or have to apply for visa. Keep up the good work.
                                "</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="all_review_box">
                        <div class="all_review_date_area">
                            <div class="all_review_date">
                                <h5>06 Jan, 2023</h5>
                            </div>
                            <div class="all_review_star">
                                <h5>Excellent</h5>
                                <div class="review_star_all">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="all_review_text">
                            <!--                        <img src="assets/img/review/review5.png" alt="img">-->
                            <h4>Syed Ali</h4>
                            <p>"Excellent service overall by representatives."</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="all_review_box">
                        <div class="all_review_date_area">
                            <div class="all_review_date">
                                <h5>22 Jan, 2023</h5>
                            </div>
                            <div class="all_review_star">
                                <h5>Excellent</h5>
                                <div class="review_star_all">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="all_review_text">
                            <!--                        <img src="assets/img/review/review2.png" alt="img">-->
                            <h4>M&F Online Store</h4>
                            <p>"Very supportive and professional management, Recommended."</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="all_review_box">
                        <div class="all_review_date_area">
                            <div class="all_review_date">
                                <h5>31 Jan, 2021</h5>
                            </div>
                            <div class="all_review_star">
                                <h5>Excellent</h5>
                                <div class="review_star_all">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="all_review_text">
                            <!--                        <img src="assets/img/review/review3.png" alt="img">-->
                            <h4>Afsheen Qureshi</h4>
                            <p>"I travel through this service and had a good experience"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our partners Area -->
    <section id="our_clients" class="section_padding">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Our International Travel Partners</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="partner_slider_area owl-theme owl-carousel">


                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo1-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo2-3-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo3-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo4-3-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo5-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo6-2-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Our Domestic Travel Partners</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="partner_slider_area owl-theme owl-carousel">
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo1-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo2-3-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo3-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo4-3-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo5-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img
                                    src="https://realmarttravel.com/wp-content/uploads/2024/11/logo6-2-300x300-1-150x150.jpg"
                                    alt="logo"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="http://wa.me/923102299115" class="float" target="_blank">
            <i class="fa fa-whatsapp my-float"></i>
        </a>
    </section>
@endsection

@section('script')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // =====================================================
        // PASSENGER COUNTER + CABIN (SCOPED PER FORM)
        // =====================================================
        function setupPassengerCounter(formSelector) {

            const form = document.querySelector(formSelector);
            if (!form) return;

            let adult = 0, child = 0, infant = 0;

            const adultSpan  = form.querySelector('.pcount, .pcountRound');
            const childSpan  = form.querySelector('.ccount, .ccountRound');
            const infantSpan = form.querySelector('.incount, .incountRound');
            const finalBtn   = form.querySelector('.final-count, .final-countRound');

            const adultInput  = form.querySelector('input[id^="adultCount"]');
            const childInput  = form.querySelector('input[id^="childCount"]');
            const infantInput = form.querySelector('input[id^="infantCount"]');
            const cabinInput  = form.querySelector('input[id^="cabinClass"]');

            if (!adultSpan || !finalBtn) return;

            function updatePassengers() {
                adultSpan.textContent  = adult;
                if (childSpan)  childSpan.textContent  = child;
                if (infantSpan) infantSpan.textContent = infant;

                if (adultInput)  adultInput.value  = adult;
                if (childInput)  childInput.value  = child;
                if (infantInput) infantInput.value = infant;

                const total = adult + child + infant;
                finalBtn.textContent = total === 1 ? '1 Passenger' : `${total} Passengers`;
            }

            // ----------------- Passenger Buttons -----------------
            form.querySelector('.btn-add, .btn-addRound')?.addEventListener('click', () => {
                adult++;
                updatePassengers();
            });

            form.querySelector('.btn-subtract, .btn-subtractRound')?.addEventListener('click', () => {
                if (adult > 0) adult--;
                updatePassengers();
            });

            form.querySelector('.btn-add-c, .btn-add-cRound')?.addEventListener('click', () => {
                child++;
                updatePassengers();
            });

            form.querySelector('.btn-subtract-c, .btn-subtract-cRound')?.addEventListener('click', () => {
                if (child > 0) child--;
                updatePassengers();
            });

            form.querySelector('.btn-add-in, .btn-add-inRound')?.addEventListener('click', () => {
                infant++;
                updatePassengers();
            });

            form.querySelector('.btn-subtract-in, .btn-subtract-inRound')?.addEventListener('click', () => {
                if (infant > 0) infant--;
                updatePassengers();
            });

            // ----------------- Cabin Selection -----------------
            const cabinButtons = form.querySelectorAll('.label-select-btn');
            const visibleCabinSpan = form.querySelector('.dropdown_passenger_area span:last-child');

            cabinButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    cabinButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const cabin = this.innerText.trim();
                    if (cabinInput) cabinInput.value = cabin;
                    if (visibleCabinSpan) visibleCabinSpan.textContent = cabin;
                });
            });

            // Default cabin from active button
            const defaultCabinBtn = form.querySelector('.label-select-btn.active');
            if (defaultCabinBtn) {
                const cabin = defaultCabinBtn.innerText.trim();
                if (cabinInput) cabinInput.value = cabin;
                if (visibleCabinSpan) visibleCabinSpan.textContent = cabin;
            }

            updatePassengers();
        }

        // Initialize both forms
        setupPassengerCounter('.oneway-form');
        setupPassengerCounter('.roundtrip-form');

        // =====================================================
        // TRIP TYPE SWITCHING
        // =====================================================
        const tripInputs = document.querySelectorAll('input[name="trip_type"]');

        document.getElementById('oneway-tab')?.addEventListener('click', () => {
            tripInputs.forEach(input => input.value = 'oneway');
        });

        document.getElementById('roundtrip-tab')?.addEventListener('click', () => {
            tripInputs.forEach(input => input.value = 'roundtrip');
        });

        document.getElementById('multi_city-tab')?.addEventListener('click', () => {
            tripInputs.forEach(input => input.value = 'multicity');
        });

        // =====================================================
        // DATE DAY NAME UPDATE + DEFAULT TODAY
        // =====================================================
        document.querySelectorAll('.departure_date input[type="date"]').forEach(dateInput => {

            const daySpan = dateInput.parentElement.querySelector('span');
            const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

            function updateDayName() {
                const date = new Date(dateInput.value);
                if (!isNaN(date.getTime()) && daySpan) {
                    daySpan.textContent = days[date.getDay()];
                }
            }

            if (!dateInput.value) {
                const today = new Date();
                const yyyy = today.getFullYear();
                const mm = String(today.getMonth() + 1).padStart(2, '0');
                const dd = String(today.getDate()).padStart(2, '0');
                dateInput.value = `${yyyy}-${mm}-${dd}`;
            }

            updateDayName();
            dateInput.addEventListener('change', updateDayName);
        });

        // =====================================================
        // ROUNDTRIP DATE VALIDATION
        // =====================================================
        const roundDeparture = document.getElementById('roundDeparture');
        const roundReturn = document.getElementById('roundReturn');

        function formatDate(date) {
            const yyyy = date.getFullYear();
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const dd = String(date.getDate()).padStart(2, '0');
            return `${yyyy}-${mm}-${dd}`;
        }

        if (roundDeparture && roundReturn) {

            const today = new Date();
            const todayFormatted = formatDate(today);

            if (!roundDeparture.value) {
                roundDeparture.value = todayFormatted;
            }

            const tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);
            roundReturn.value = formatDate(tomorrow);

            roundDeparture.min = todayFormatted;
            roundReturn.min = roundDeparture.value;

            roundDeparture.addEventListener('change', function () {
                roundReturn.min = this.value;

                if (roundReturn.value <= this.value) {
                    const nextDay = new Date(this.value);
                    nextDay.setDate(nextDay.getDate() + 1);
                    roundReturn.value = formatDate(nextDay);
                }
            });
        }

        // =====================================================
        // AIRPORT AUTOCOMPLETE
        // =====================================================
        async function searchAirports(query, suggestionBox, inputField, spanField, codeField) {
            if (query.length < 2) {
                suggestionBox.innerHTML = '';
                return;
            }

            try {
                const res = await fetch('/airports');
                const data = await res.json();

                const airports = data
                    .filter(a =>
                        a.name?.toLowerCase().includes(query.toLowerCase()) ||
                        a.city?.toLowerCase().includes(query.toLowerCase()) ||
                        a.iata?.toLowerCase().includes(query.toLowerCase())
                    )
                    .slice(0, 5);

                suggestionBox.innerHTML = '';

                airports.forEach(airport => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <strong>${airport.iata || ''}</strong> -
                        ${airport.name}, ${airport.city}, ${airport.country}
                    `;

                    li.onclick = () => {
                        inputField.value = airport.city || '';
                        spanField.textContent = `${airport.iata || ''} - ${airport.name || 'Airport'}`;
                        if (codeField) codeField.value = airport.iata || '';
                        suggestionBox.innerHTML = '';
                    };

                    suggestionBox.appendChild(li);
                });
            } catch (err) {
                console.error("Error fetching airports:", err);
            }
        }

        function setupAutocomplete(inputId, codeId, suggestionId, spanId) {
            const input = document.getElementById(inputId);
            const codeInput = document.getElementById(codeId);
            const suggestions = document.getElementById(suggestionId);
            const span = document.getElementById(spanId);

            if (!input || !suggestions || !span) return;

            input.addEventListener('focus', () => {
                input.value = '';
                if (codeInput) codeInput.value = '';
                suggestions.innerHTML = '';
                span.textContent = 'Airport';
            });

            input.addEventListener('input', () => {
                searchAirports(input.value.trim(), suggestions, input, span, codeInput);
            });

            document.addEventListener('click', e => {
                if (!input.parentElement.contains(e.target)) {
                    suggestions.innerHTML = '';
                }
            });
        }

        setupAutocomplete('fromAirport', 'fromAirportCode', 'fromSuggestions', 'fromAirportSpan');
        setupAutocomplete('toAirport', 'toAirportCode', 'toSuggestions', 'toAirportSpan');
        setupAutocomplete('fromAirportRound', 'fromAirportCodeRound', 'fromSuggestionsRound', 'fromAirportSpanRound');
        setupAutocomplete('toAirportRound', 'toAirportCodeRound', 'toSuggestionsRound', 'toAirportSpanRound');

    });
</script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ========== PASSENGER COUNTER & CABIN CLASS FOR EACH TAB ==========

            function setupPassengerCounter(tabSuffix = '') {
                let adult = 0,
                    child = 0,
                    infant = 0;

                const adultSpan = document.querySelector(`.pcount${tabSuffix}`);
                const childSpan = document.querySelector(`.ccount${tabSuffix}`);
                const infantSpan = document.querySelector(`.incount${tabSuffix}`);
                const finalBtn = document.querySelector(`.final-count${tabSuffix}`);

                const adultInput = document.getElementById(`adultCount${tabSuffix}`);
                const childInput = document.getElementById(`childCount${tabSuffix}`);
                const infantInput = document.getElementById(`infantCount${tabSuffix}`);
                const cabinInput = document.getElementById(`cabinClass${tabSuffix}`);

                if (!adultSpan || !finalBtn) return; // Safety check

                function updatePassengers() {
                    adultSpan.textContent = adult;
                    childSpan.textContent = child;
                    infantSpan.textContent = infant;

                    adultInput.value = adult;
                    childInput.value = child;
                    infantInput.value = infant;

                    const total = adult + child + infant;
                    finalBtn.textContent = total === 1 ? '1 Passenger' : total + ' Passengers';
                }

                // Adult buttons
                document.querySelector(`.btn-add${tabSuffix}`)?.addEventListener('click', () => {
                    adult++;
                    updatePassengers();
                });
                document.querySelector(`.btn-subtract${tabSuffix}`)?.addEventListener('click', () => {
                    if (adult > 0) adult--;
                    updatePassengers();
                });

                // Child buttons
                document.querySelector(`.btn-add-c${tabSuffix}`)?.addEventListener('click', () => {
                    child++;
                    updatePassengers();
                });
                document.querySelector(`.btn-subtract-c${tabSuffix}`)?.addEventListener('click', () => {
                    if (child > 0) child--;
                    updatePassengers();
                });

                // Infant buttons
                document.querySelector(`.btn-add-in${tabSuffix}`)?.addEventListener('click', () => {
                    infant++;
                    updatePassengers();
                });
                document.querySelector(`.btn-subtract-in${tabSuffix}`)?.addEventListener('click', () => {
                    if (infant > 0) infant--;
                    updatePassengers();
                });

                // Cabin class selection
                const cabinWrapperClass = tabSuffix === 'Round'
                    ? '.dropdown_passenger_infoRound'
                    : '.dropdown_passenger_infoOne';

                document.querySelectorAll(`${cabinWrapperClass} .label-select-btn`).forEach(btn => {
                    btn.addEventListener('click', function () {

                        document.querySelectorAll(`${cabinWrapperClass} .label-select-btn`)
                            .forEach(b => b.classList.remove('active'));

                        this.classList.add('active');

                        const cabin = this.querySelector('.muiButton-label')?.textContent.trim()
                            || this.innerText.trim();

                        cabinInput.value = cabin;

                        // Update visible label under dropdown
                        const visibleSpan = this.closest('.dropdown_passenger_area')
                            .querySelector('span:last-child');

                        if (visibleSpan) visibleSpan.textContent = cabin;
                    });
                });


                // Initial update
                updatePassengers();
            }

            // Setup for Oneway tab (no suffix)
            setupPassengerCounter('');

            // Setup for Roundtrip tab (with "Round" suffix)
            setupPassengerCounter('Round');

            // ========== TRIP TYPE SWITCHING ==========
            const tripInputs = document.querySelectorAll('input[name="trip_type"]');
            document.getElementById('oneway-tab')?.addEventListener('click', () => {
                tripInputs.forEach(input => input.value = 'oneway');
            });
            document.getElementById('roundtrip-tab')?.addEventListener('click', () => {
                tripInputs.forEach(input => input.value = 'roundtrip');
            });
            document.getElementById('multi_city-tab')?.addEventListener('click', () => {
                tripInputs.forEach(input => input.value = 'multicity');
            });

            // ========== DATE DAY NAME UPDATE (for both tabs) ==========
            document.querySelectorAll('.departure_date input[type="date"]').forEach(dateInput => {
                const daySpan = dateInput.parentElement.querySelector('span');

                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

                function updateDayName() {
                    const date = new Date(dateInput.value);
                    if (!isNaN(date.getTime())) {
                        daySpan.textContent = days[date.getDay()];
                    }
                }

                // Set today by default if empty
                if (!dateInput.value) {
                    const today = new Date();
                    const yyyy = today.getFullYear();
                    const mm = String(today.getMonth() + 1).padStart(2, '0');
                    const dd = String(today.getDate()).padStart(2, '0');
                    dateInput.value = `${yyyy}-${mm}-${dd}`;
                }

                updateDayName();
                dateInput.addEventListener('change', updateDayName);
            });

            // ========== ROUNDTRIP DATE LOGIC ==========
            const roundDeparture = document.getElementById('roundDeparture');
            const roundReturn = document.getElementById('roundReturn');

            function formatDate(date) {
                const yyyy = date.getFullYear();
                const mm = String(date.getMonth() + 1).padStart(2, '0');
                const dd = String(date.getDate()).padStart(2, '0');
                return `${yyyy}-${mm}-${dd}`;
            }

            if (roundDeparture && roundReturn) {

                const today = new Date();
                const todayFormatted = formatDate(today);

                // ✅ Journey default today
                if (!roundDeparture.value) {
                    roundDeparture.value = todayFormatted;
                }

                // ✅ Return default = tomorrow
                const tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);
                roundReturn.value = formatDate(tomorrow);

                // ✅ Minimum selectable dates
                roundDeparture.min = todayFormatted;
                roundReturn.min = roundDeparture.value;

                // ✅ When journey changes → update return min
                roundDeparture.addEventListener('change', function () {
                    roundReturn.min = this.value;

                    if (roundReturn.value <= this.value) {
                        const nextDay = new Date(this.value);
                        nextDay.setDate(nextDay.getDate() + 1);
                        roundReturn.value = formatDate(nextDay);
                    }
                });
            }

            // ========== AIRPORT AUTOCOMPLETE (already working correctly) ==========
            async function searchAirports(query, suggestionBox, inputField, spanField, codeField) {
                if (query.length < 2) {
                    suggestionBox.innerHTML = '';
                    return;
                }

                try {
                    const res = await fetch('/airports');
                    const data = await res.json();

                    const airports = data
                        .filter(a =>
                            a.name?.toLowerCase().includes(query.toLowerCase()) ||
                            a.city?.toLowerCase().includes(query.toLowerCase()) ||
                            a.iata?.toLowerCase().includes(query.toLowerCase())
                        )
                        .slice(0, 5);

                    suggestionBox.innerHTML = '';

                    airports.forEach(airport => {
                        const li = document.createElement('li');
                        li.innerHTML = `
                        <strong>${airport.iata || ''}</strong> -
                        ${airport.name}, ${airport.city}, ${airport.country}
                    `;

                        li.onclick = () => {
                            inputField.value = airport.city || '';
                            spanField.textContent =
                                `${airport.iata || ''} - ${airport.name || 'Airport'}`;
                            if (codeField) codeField.value = airport.iata || '';
                            suggestionBox.innerHTML = '';
                        };

                        suggestionBox.appendChild(li);
                    });
                } catch (err) {
                    console.error("Error fetching airports:", err);
                }
            }

            function setupAutocomplete(inputId, codeId, suggestionId, spanId) {
                const input = document.getElementById(inputId);
                const codeInput = document.getElementById(codeId);
                const suggestions = document.getElementById(suggestionId);
                const span = document.getElementById(spanId);

                if (!input || !suggestions || !span) return;

                input.addEventListener('focus', () => {
                    input.value = '';
                    if (codeInput) codeInput.value = '';
                    suggestions.innerHTML = '';
                    span.textContent = 'Airport';
                });

                input.addEventListener('input', () => {
                    searchAirports(input.value.trim(), suggestions, input, span, codeInput);
                });

                // Hide suggestions when clicking outside
                document.addEventListener('click', e => {
                    if (!input.parentElement.contains(e.target)) {
                        suggestions.innerHTML = '';
                    }
                });
            }

            // Setup autocomplete for all four fields
            setupAutocomplete('fromAirport', 'fromAirportCode', 'fromSuggestions', 'fromAirportSpan');
            setupAutocomplete('toAirport', 'toAirportCode', 'toSuggestions', 'toAirportSpan');
            setupAutocomplete('fromAirportRound', 'fromAirportCodeRound', 'fromSuggestionsRound',
                'fromAirportSpanRound');
            setupAutocomplete('toAirportRound', 'toAirportCodeRound', 'toSuggestionsRound', 'toAirportSpanRound');

        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let adult = 0,
                child = 0,
                infant = 0;

            const adultSpan = document.querySelector('.pcount');
            const childSpan = document.querySelector('.ccount');
            const infantSpan = document.querySelector('.incount');
            const finalBtn = document.querySelector('.final-count');

            const adultInput = document.getElementById('adultCount');
            const childInput = document.getElementById('childCount');
            const infantInput = document.getElementById('infantCount');

            function updatePassengers() {
                adultSpan.textContent = adult;
                childSpan.textContent = child;
                infantSpan.textContent = infant;

                adultInput.value = adult;
                childInput.value = child;
                infantInput.value = infant;

                const total = adult + child + infant;
                finalBtn.textContent = total + ' Passenger';
            }

            // Adult
            document.querySelector('.btn-add').onclick = () => {
                adult++;
                updatePassengers();
            };
            document.querySelector('.btn-subtract').onclick = () => {
                if (adult > 0) adult--;
                updatePassengers();
            };

            // Children
            document.querySelector('.btn-add-c').onclick = () => {
                child++;
                updatePassengers();
            };
            document.querySelector('.btn-subtract-c').onclick = () => {
                if (child > 0) child--;
                updatePassengers();
            };

            // Infant
            document.querySelector('.btn-add-in').onclick = () => {
                infant++;
                updatePassengers();
            };
            document.querySelector('.btn-subtract-in').onclick = () => {
                if (infant > 0) infant--;
                updatePassengers();
            };

            // Cabin class
            document.querySelectorAll('.label-select-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    document.querySelectorAll('.label-select-btn')
                        .forEach(b => b.classList.remove('active'));

                    this.classList.add('active');

                    const cabin = this.innerText.trim();
                    document.getElementById('cabinClass').value = cabin;
                });
            });

            const tripInput = document.getElementById('tripType');

            // Default (One Way)
            tripInput.value = 'oneway';

            document.getElementById('oneway-tab').addEventListener('click', () => {
                tripInput.value = 'oneway';
            });

            document.getElementById('roundtrip-tab').addEventListener('click', () => {
                tripInput.value = 'roundtrip';
            });

            document.getElementById('multi_city-tab').addEventListener('click', () => {
                tripInput.value = 'multicity';
            });


            const dateInput = document.querySelector('.departure_date input[type="date"]');
            const daySpan = document.querySelector('.departure_date span');

            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            function updateDayName(dateValue) {
                const date = new Date(dateValue);
                if (!isNaN(date)) {
                    daySpan.textContent = days[date.getDay()];
                }
            }

            // ✅ Set today's date by default
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const todayFormatted = `${yyyy}-${mm}-${dd}`;

            dateInput.value = todayFormatted;
            updateDayName(todayFormatted);

            // ✅ Update day name on date change
            dateInput.addEventListener('change', function() {
                updateDayName(this.value);
            });

        });


        async function searchAirports(query, suggestionBox, inputField, spanField, codeField) {

            if (query.length < 2) {
                suggestionBox.innerHTML = '';
                return;
            }

            const res = await fetch('/airports');
            const data = await res.json();

            const airports = data
                .filter(a =>
                    a.name.toLowerCase().includes(query.toLowerCase()) ||
                    a.city?.toLowerCase().includes(query.toLowerCase()) ||
                    a.iata?.toLowerCase().includes(query.toLowerCase())
                )
                .slice(0, 5);

            suggestionBox.innerHTML = '';

            airports.forEach(airport => {
                const li = document.createElement('li');
                li.innerHTML = `
            <strong>${airport.iata || ''}</strong> -
            ${airport.name}, ${airport.city}, ${airport.country}
        `;

                li.onclick = () => {
                    // ✅ input me city
                    inputField.value = airport.city || '';

                    // ✅ span me airport name
                    spanField.textContent = (airport.iata || '') + ' - ' + airport.name || 'Airport';

                    // ✅ code me iata code
                    if (codeField) {
                        codeField.value = airport.iata || '';
                    }

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

            input.addEventListener('focus', () => {
                input.value = '';
                codeInput.value = '';
                suggestions.innerHTML = '';
            });

            input.addEventListener('input', () => {
                searchAirports(input.value, suggestions, input, span, codeInput);
            });

            document.addEventListener('click', e => {
                if (!input.contains(e.target)) {
                    suggestions.innerHTML = '';
                }
            });
        }

        // ✅ FROM
        setupAutocomplete('fromAirport', 'fromAirportCode', 'fromSuggestions', 'fromAirportSpan');

        // ✅ TO
        setupAutocomplete('toAirport', 'toAirportCode', 'toSuggestions', 'toAirportSpan');

        // ✅ FROM Round
        setupAutocomplete('fromAirportRound', 'fromAirportCodeRound', 'fromSuggestionsRound', 'fromAirportSpanRound');

        // ✅ TO Round
        setupAutocomplete('toAirportRound', 'toAirportCodeRound', 'toSuggestionsRound', 'toAirportSpanRound');
    </script> --}}

@endsection
