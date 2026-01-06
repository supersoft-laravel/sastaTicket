@extends('dashboard.layouts.master')

@section('title', 'Flight Bookings')

@section('css')
@endsection

@section('content')

    <div class="py-30 px-30 rounded-4 bg-white custom_shadow">

        {{-- Tabs --}}
        <div class="tabs -underline-2">
            <div class="tabs__controls row x-gap-40 y-gap-10">

                <div class="col-auto">
                    <a href="{{ route('dashboard.flight.bookings') }}"
                        class="tabs__button text-18 fw-500 pb-5 {{ empty($status) ? 'is-tab-el-active' : '' }}">
                        All Booking
                    </a>
                </div>

                <div class="col-auto">
                    <a href="{{ route('dashboard.flight.bookings', ['status' => 'pending']) }}"
                        class="tabs__button text-18 fw-500 pb-5 {{ $status === 'pending' ? 'is-tab-el-active' : '' }}">
                        Pending
                    </a>
                </div>

                <div class="col-auto">
                    <a href="{{ route('dashboard.flight.bookings', ['status' => 'confirmed']) }}"
                        class="tabs__button text-18 fw-500 pb-5 {{ $status === 'confirmed' ? 'is-tab-el-active' : '' }}">
                        Confirmed
                    </a>
                </div>

                <div class="col-auto">
                    <a href="{{ route('dashboard.flight.bookings', ['status' => 'cancelled']) }}"
                        class="tabs__button text-18 fw-500 pb-5 {{ $status === 'cancelled' ? 'is-tab-el-active' : '' }}">
                        Cancelled
                    </a>
                </div>

            </div>

            {{-- Table --}}
            <div class="pt-30 table_action_icon">
                <div class="overflow-scroll scroll-bar-1">

                    <table class="table-3 -border-bottom col-12">
                        <thead class="bg-light-2">
                            <tr>
                                <th>Booking ID</th>
                                <th>Booking Type</th>
                                <th>Booking Date</th>
                                <th>Journey Date</th>
                                <th>Traveller</th>
                                <th>Amount</th>
                                <th>Payment Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($flightBookings as $booking)
                                <tr>
                                    <td>#{{ $booking->booking_id ?? $booking->id }}</td>
                                    <td>Flight</td>
                                    <td>{{ $booking->created_at->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d M Y') }}</td>
                                    <td>
                                        {{ $booking->adults }} Adult
                                        @if ($booking->children)
                                            , {{ $booking->children }} Child
                                        @endif
                                        @if ($booking->infants)
                                            , {{ $booking->infants }} Infant
                                        @endif
                                    </td>
                                    <td>${{ number_format($booking->total_amount, 2) }}</td>
                                    <td>{{ ucfirst($booking->payment_method) }}</td>
                                    <td>
                                        <span
                                            class="rounded-100 py-4 px-10 text-14 fw-500 {{ \App\Helpers\Helper::statusClass($booking->status) }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @can('view flight booking')
                                            <a href="{{ route('dashboard.flight.bookings.show', $booking->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('delete flight booking')
                                            <form action="{{ route('dashboard.flight.bookings.destroy', $booking->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <a href="#" type="submit"
                                                    class="btn btn-icon btn-text-danger delete_confirmation"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('Delete Booking') }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-20">
                                        No bookings found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($flightBookings->lastPage() > 1)
            <div class="pt-30">
                <div class="row justify-between">

                    {{-- Previous --}}
                    <div class="col-auto">
                        <a href="{{ $flightBookings->previousPageUrl() ?? 'javascript:void(0)' }}"
                            class="button -blue-1 size-40 rounded-full border-light
               {{ $flightBookings->onFirstPage() ? 'disabled opacity-50' : '' }}">
                            <i class="icon-chevron-left text-12"></i>
                        </a>
                    </div>

                    {{-- Pages --}}
                    <div class="col-auto">
                        <div class="row x-gap-20 y-gap-20 items-center">

                            {{-- First Page --}}
                            @if ($flightBookings->currentPage() > 3)
                                <div class="col-auto">
                                    <a href="{{ $flightBookings->url(1) }}" class="size-40 flex-center rounded-full">1</a>
                                </div>

                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">...</div>
                                </div>
                            @endif

                            {{-- Page Numbers --}}
                            @for ($i = max(1, $flightBookings->currentPage() - 2); $i <= min($flightBookings->lastPage(), $flightBookings->currentPage() + 2); $i++)
                                <div class="col-auto">
                                    <a href="{{ $flightBookings->url($i) }}"
                                        class="size-40 flex-center rounded-full
                           {{ $flightBookings->currentPage() == $i ? 'bg_themes text-white' : '' }}">
                                        {{ $i }}
                                    </a>
                                </div>
                            @endfor

                            {{-- Last Page --}}
                            @if ($flightBookings->currentPage() < $flightBookings->lastPage() - 2)
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">...</div>
                                </div>

                                <div class="col-auto">
                                    <a href="{{ $flightBookings->url($flightBookings->lastPage()) }}"
                                        class="size-40 flex-center rounded-full">
                                        {{ $flightBookings->lastPage() }}
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                    {{-- Next --}}
                    <div class="col-auto">
                        <a href="{{ $flightBookings->nextPageUrl() ?? 'javascript:void(0)' }}"
                            class="button -blue-1 size-40 rounded-full border-light
               {{ !$flightBookings->hasMorePages() ? 'disabled opacity-50' : '' }}">
                            <i class="icon-chevron-right text-12"></i>
                        </a>
                    </div>

                </div>
            </div>
        @endif


    </div>

@endsection

@section('script')
@endsection
