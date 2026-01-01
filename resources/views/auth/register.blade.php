@extends('frontend.layouts.master')

@section('title', 'Register')

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
    <!--  Common Author Area -->
    <section id="common_author_area" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="common_author_boxed">
                        <div class="common_author_heading">
                            <h3>Register account</h3>
                            <h2>Register your account</h2>
                        </div>
                        <div class="common_author_form">
                            <form action="{{route('register.attempt')}}" method="POST" id="main_author_form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name*" required/>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder="your email address*" required/>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Mobile number*" required/>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password*" required />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" class="form-control @error('confirm-password') is-invalid @enderror" placeholder="Confirm Password*" required />
                                    @error('confirm-password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <input style="margin: 10px;" type="checkbox" id="terms" name="terms">
                                    <label style="display: inline;" class="form-check-label" for="terms">
                                        I read and accept all <a href="javascript:void(0);" style="display: inline; padding: 0px;">Terms and conditios</a>
                                    </label>
                                </div>
                                <div class="common_form_submit">
                                    <button type="submit" class="btn btn_theme btn_md">Register</button>
                                </div>
                                <div class="have_acount_area other_author_option">
                                    <div class="line_or">
                                        <span>or</span>
                                    </div>
                                    <ul>
                                        <li><a href="#!"><img src="{{ asset('frontAssets/img/icon/google.png') }}" alt="icon"></a></li>
                                        <li><a href="#!"><img src="{{ asset('frontAssets/img/icon/facebook.png') }}" alt="icon"></a>
                                        </li>
                                        <li><a href="#!"><img src="{{ asset('frontAssets/img/icon/twitter.png') }}" alt="icon"></a>
                                        </li>
                                    </ul>
                                    <p>Already have an account? <a href="{{ route('login') }}">Log in now</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
