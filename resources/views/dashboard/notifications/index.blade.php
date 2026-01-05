@extends('dashboard.layouts.master')

@section('title', 'Notifications')

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

    <div class="py-30 px-30 rounded-4 bg-white custom_shadow">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__content js-tabs-content">


                <div class="accordion -simple row y-gap-20 js-accordion">

                    @if (isset($notifications) && count($notifications) > 0)
                        @foreach ($notifications as $notification)
                            <div class="col-12">
                                <div class="accordion__item px-20 py-20 border-light rounded-4">
                                    <div class="accordion__button d-flex items-center justify-between w-100">
                                        <div class="d-flex items-center">
                                            <div
                                                class="accordion__icon size-40 flex-center {{ $notification->read_at ? 'bg-light-2' : 'bg-light-3' }} rounded-full mr-20">
                                                <i class="icon-plus"></i>
                                                <i class="icon-minus"></i>
                                            </div>

                                            <div class="button text-dark-1 fw-semibold">
                                                {{ $notification->title ?? 'Notification' }}
                                            </div>
                                        </div>

                                        <!-- Action Icons -->
                                        <div class="d-flex items-center g-5" style="gap: 15px;">
                                            {{-- Mark as Read --}}
                                            @if (!$notification->read_at)
                                                <a href="{{ route('dashboard.notifications.read', $notification->id) }}"
                                                    class="text-success" title="Mark as read">
                                                    <i class="icon-check text-16"></i>
                                                </a>
                                            @endif

                                            {{-- Delete --}}
                                            <a href="{{ route('dashboard.notifications.delete', $notification->id) }}"
                                                class="text-danger" title="Delete">
                                                <i class="icon-trash text-16"></i>
                                            </a>
                                        </div>
                                    </div>


                                    <div class="accordion__content">
                                        <div class="pt-20 pl-60">
                                            <p class="button text-dark-1" style="justify-content: flex-start;">
                                                {{ $notification->message ?? 'No details available.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-40">
                            <div class="border-light rounded-4 p-30 bg-light-2">
                                <i class="icon-bell-off text-30 text-light-1 mb-10"></i>
                                <p class="text-15 text-light-1 mb-0">
                                    No notifications available at the moment.
                                </p>
                            </div>
                        </div>
                    @endif


                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection
