@extends('dashboard.layouts.master')

@section('title', 'Profile')

@section('css')
    <style>
        .bg-light-3 {
            background-color: #bbd9ff !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }
    </style>
@endsection

@section('content')

    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

                <div class="col-auto">
                    <button
                        class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active"
                        data-tab-target=".-tab-item-1">Personal Information</button>
                </div>

                {{-- <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button "
                        data-tab-target=".-tab-item-2">Location Information</button>
                </div> --}}

                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button "
                        data-tab-target=".-tab-item-3">Change Password</button>
                </div>

            </div>

            <div class="tabs__content pt-30 js-tabs-content">
                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row y-gap-30 items-center">
                            <div class="col-12">
                                <div class="d-flex ratio ratio-1:1 w-200">
                                    <img id="profilePreview"
                                        src="{{ $profile->profile_image ? asset($profile->profile_image) : 'assets/img/avatars/add-2.png' }}"
                                        alt="image" class="img-ratio rounded-4">
                                    <input type="file" name="profile_image" id="profileImageInput"
                                        accept="image/png,image/jpeg" hidden>
                                </div>
                            </div>

                            <div class="col-12">
                                <h4 class="text-16 fw-500">Your avatar</h4>
                                <div class="text-14 mt-5">PNG or JPG no bigger than 800px wide and tall.</div>

                                <div class="d-inline-block mt-15">
                                    <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white"
                                        onclick="document.getElementById('profileImageInput').click()">
                                        Browse
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="border-top-light mt-30 mb-30"></div>

                        <div class="col-xl-9">
                            <div class="row x-gap-20 y-gap-20">

                                <div class="col-md-6">

                                    <div class="form-input ">
                                        <label class="lh-1 text-16 text-light-1">Full Name</label>
                                        <input type="text" name="full_name" value="{{ $user->name }}" required>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-input ">
                                        <label class="lh-1 text-16 text-light-1">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" readonly required>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-input ">
                                        <label class="lh-1 text-16 text-light-1">Phone Number</label>
                                        <input type="text" name="phone_number" value="{{ $profile->phone_number }}"
                                            required>
                                    </div>

                                </div>

                                <div class="col-6">

                                    <div class="form-input ">
                                        <label class="lh-1 text-16 text-light-1">Birthday</label>
                                        <input type="date" name="dob" value="{{ $profile->dob }}" required>
                                    </div>

                                </div>

                                <div class="col-12">

                                    <div class="form-input ">
                                        <label class="lh-1 text-16 text-light-1">About Yourself</label>
                                        <textarea name="bio" required rows="5">{{ $profile->bio }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="d-inline-block pt-30">

                            <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                Save Changes
                            </button>

                        </div>
                    </form>
                </div>

                {{-- <div class="tabs__pane -tab-item-2">
                    <div class="col-xl-9">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-12">

                                <div class="form-input ">
                                    <label class="lh-1 text-16 text-light-1">Address Line 1</label>
                                    <input type="text" required>
                                </div>

                            </div>

                            <div class="col-12">

                                <div class="form-input ">
                                    <label class="lh-1 text-16 text-light-1">Address Line 2</label>
                                    <input type="text" required>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-input ">
                                    <label class="lh-1 text-16 text-light-1">City</label>
                                    <input type="text" required>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-input ">
                                    <label class="lh-1 text-16 text-light-1">State</label>
                                    <input type="text" required>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-input ">
                                    <label class="lh-1 text-16 text-light-1">Select Country</label>
                                    <input type="text" required>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-input ">
                                    <label class="lh-1 text-16 text-light-1">ZIP Code</label>
                                    <input type="text" required>
                                </div>

                            </div>

                            <div class="col-12">
                                <div class="d-inline-block">

                                    <a href="#" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                        Save Changes
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="tabs__pane -tab-item-3">
                    <div class="col-xl-9">
                        <form action="{{ route('update.password', Auth::user()->id) }}" method="POST">
                            @csrf
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-12">

                                    <div class="form-input ">
                                        <label class="lh-1 text-16 text-light-1">Current Password</label>
                                        <input type="text" name="currentPassword" required>
                                    </div>

                                </div>

                                <div class="col-12">

                                    <div class="form-input ">
                                        <label class="lh-1 text-16 text-light-1">New Password</label>
                                        <input type="text" name="newPassword" required>
                                    </div>

                                </div>

                                <div class="col-12">

                                    <div class="form-input ">
                                        <label class="lh-1 text-16 text-light-1">New Password Again</label>
                                        <input type="text" name="confirmNewPassword" required>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="row x-gap-10 y-gap-10">
                                        <div class="col-auto">

                                            <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                Save Changes
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.getElementById('profileImageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('profilePreview').src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection
