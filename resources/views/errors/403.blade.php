@extends('frontend.layouts.master')

@section('title', 'Error 403')

@section('css')
    <style>
        .left_side_search_heading h5 {
            border: none;
        }

        #common_banner {
            position: relative;
            background-image: url(../../frontAssets/img/flights/banner.png);
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
    <section id="error_main" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="error_content text-center">
                        <img src="{{ asset('frontAssets/img/bg.png') }}" alt="img">
                        <h2>Error 403 : {{ __('Access Denied ⚠️') }}</h2>
                        <p class="mb-6 mx-2">{{ __('You do not have permission to access this resource.') }}</p>
                        <a href="{{ route('frontend.home') }}" class="btn btn_theme btn_md">{{ __('Back to home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
