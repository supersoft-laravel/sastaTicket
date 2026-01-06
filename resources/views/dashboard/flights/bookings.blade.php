@extends('dashboard.layouts.master')

@section('title', 'Flight Bookings')

@section('css')
    <style>
        /* Overlay */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        /* Show */
        .modal-overlay.show {
            display: flex;
        }

        /* Modal Box */
        .modal-box {
            width: 420px;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .25);
            animation: modalScale .25s ease;
        }

        /* Header */
        .modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 26px;
            cursor: pointer;
            color: #64748b;
        }

        /* Body */
        .modal-body {
            padding: 22px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 6px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
            transition: .2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, .15);
        }

        /* Footer */
        .modal-footer {
            padding: 16px 22px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Buttons */
        .btn-cancel {
            background: #f1f5f9;
            border: none;
            padding: 9px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-save {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-save:hover {
            background: #1e40af;
        }

        /* Animation */
        @keyframes modalScale {
            from {
                transform: scale(.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

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
                                    <td class="d-flex justify-content-between">
                                        @can('update flight booking')
                                            <button type="button" class="btn btn-sm btn-primary editBookingBtn"
                                                data-id="{{ $booking->id }}" data-status="{{ $booking->status }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endcan
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


    <div id="bookingStatusModal" class="modal-overlay">
        <div class="modal-box">

            <div class="modal-header">
                <h3>Update Booking Status</h3>
                <button class="modal-close">&times;</button>
            </div>

            <form method="POST" id="bookingStatusForm">
                @csrf
                @method('PUT')

                <input type="hidden" name="booking_id" id="booking_id">

                <div class="modal-body">

                    <div class="form-group">
                        <label>Booking Status</label>
                        <select name="status" id="booking_status" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel">Cancel</button>
                    <button type="submit" class="btn-save">Update Status</button>
                </div>
            </form>

        </div>
    </div>

@endsection

@section('script')

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const modal = document.getElementById('bookingStatusModal');
            const closeBtn = document.querySelector('.modal-close');
            const cancelBtn = document.querySelector('.btn-cancel');

            document.querySelectorAll('.editBookingBtn').forEach(btn => {
                btn.addEventListener('click', () => {

                    const bookingId = btn.dataset.id;
                    const status = btn.dataset.status;

                    document.getElementById('booking_id').value = bookingId;
                    document.getElementById('booking_status').value = status;

                    document.getElementById('bookingStatusForm').action =
                        `/dashboard/flight-bookings/${bookingId}/status`;

                    modal.classList.add('show');
                });
            });

            [closeBtn, cancelBtn].forEach(el => {
                el.addEventListener('click', () => modal.classList.remove('show'));
            });

            modal.addEventListener('click', e => {
                if (e.target === modal) modal.classList.remove('show');
            });

            document.addEventListener('keydown', e => {
                if (e.key === "Escape") modal.classList.remove('show');
            });

        });
    </script>



@endsection
