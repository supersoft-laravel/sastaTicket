@extends('dashboard.layouts.master')
@section('title', 'Flight Booking Details')

@section('css')
    <style>
        /* Page spacing */
        .container-fluid {
            padding: 20px;
        }

        /* Card design */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        /* Card headers */
        .card-header {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            padding: 14px 18px;
            border-bottom: none;
        }

        /* Card body */
        .card-body {
            padding: 20px;
            background: #ffffff;
        }

        /* Labels */
        .card-body b {
            color: #555;
            font-weight: 600;
        }

        /* Values spacing */
        .card-body .col-md-3,
        .card-body .col-md-4,
        .card-body .col-md-6 {
            margin-bottom: 12px;
            font-size: 14px;
            color: #333;
        }

        /* Header row */
        .row.mb-3 {
            align-items: center;
        }

        .row.mb-3 small {
            font-size: 13px;
            color: #777;
        }

        /* Back button */
        .btn-secondary {
            background: #f1f3f6;
            border: none;
            color: #333;
            border-radius: 20px;
            padding: 6px 16px;
        }

        .btn-secondary:hover {
            background: #e2e6ea;
        }

        /* Status badges */
        .badge {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 20px;
            text-transform: capitalize;
        }

        .badge-success {
            background: #28a745;
        }

        .badge-danger {
            background: #dc3545;
        }

        .badge-warning {
            background: #ffc107;
            color: #000;
        }

        /* Total amount highlight */
        .text-success {
            font-size: 16px;
            font-weight: 700;
        }

        /* Notes box */
        .card-body p {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            margin-top: 6px;
            font-size: 14px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .card-body {
                padding: 15px;
            }

            .card-body .col-md-3,
            .card-body .col-md-4,
            .card-body .col-md-6 {
                font-size: 13px;
            }

            .card-header {
                font-size: 14px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <small class="text-muted">Booking ID: {{ $flightBooking->booking_id ?? 'N/A' }}</small>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        {{-- Passenger Info --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Passenger Information</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4"><b>Name:</b> {{ $flightBooking->name }}</div>
                    <div class="col-md-4"><b>Email:</b> {{ $flightBooking->email ?? '-' }}</div>
                    <div class="col-md-4"><b>Phone:</b> {{ $flightBooking->phone }}</div>

                    <div class="col-md-4 mt-2"><b>DOB:</b> {{ $flightBooking->dob ?? '-' }}</div>
                    <div class="col-md-4 mt-2"><b>Gender:</b> {{ ucfirst($flightBooking->gender ?? '-') }}</div>
                    <div class="col-md-4 mt-2"><b>Address:</b> {{ $flightBooking->address ?? '-' }}</div>

                    <div class="col-md-4 mt-2"><b>Passport No:</b> {{ $flightBooking->passport_no ?? '-' }}</div>
                    <div class="col-md-4 mt-2"><b>Visa No:</b> {{ $flightBooking->visa_no ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- Flight Info --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Flight Information</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4"><b>Airline:</b> {{ $flightBooking->flight_airline }}</div>
                    <div class="col-md-4"><b>Class:</b> {{ $flightBooking->flight_class }}</div>
                    <div class="col-md-4"><b>Stops:</b> {{ $flightBooking->flight_stops }}</div>

                    <div class="col-md-4 mt-2"><b>From:</b> {{ $flightBooking->flight_from }}</div>
                    <div class="col-md-4 mt-2"><b>To:</b> {{ $flightBooking->flight_to }}</div>
                    <div class="col-md-4 mt-2"><b>Duration:</b> {{ $flightBooking->flight_duration ?? '-' }}</div>

                    <div class="col-md-6 mt-2">
                        <b>Departure:</b>
                        {{ \Carbon\Carbon::parse($flightBooking->flight_departure_datetime)->format('d M Y, h:i A') }}
                    </div>
                    <div class="col-md-6 mt-2">
                        <b>Arrival:</b>
                        {{ \Carbon\Carbon::parse($flightBooking->flight_arrival_datetime)->format('d M Y, h:i A') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Booking Details --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Booking Details</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"><b>Departure Date:</b> {{ $flightBooking->departure_date }}</div>
                    <div class="col-md-3"><b>Adults:</b> {{ $flightBooking->adults }}</div>
                    <div class="col-md-3"><b>Children:</b> {{ $flightBooking->children }}</div>
                    <div class="col-md-3"><b>Infants:</b> {{ $flightBooking->infants }}</div>
                </div>
            </div>
        </div>

        {{-- Pricing --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Pricing</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"><b>Flight Price:</b> {{ \App\Helpers\Helper::formatCurrency($flightBooking->flight_price) }}</div>
                    <div class="col-md-3"><b>Tax:</b> {{ \App\Helpers\Helper::formatCurrency($flightBooking->tax) }}</div>
                    <div class="col-md-3"><b>Discount:</b> {{ \App\Helpers\Helper::formatCurrency($flightBooking->discount_amount) }}</div>
                    <div class="col-md-3 text-success">
                        <b>Total:</b> {{ \App\Helpers\Helper::formatCurrency($flightBooking->total_amount) }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Payment & Status --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Payment & Status</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <b>Payment Method:</b> {{ strtoupper($flightBooking->payment_method) }}
                    </div>
                    <div class="col-md-4">
                        <b>Status:</b>
                        <span
                            class="badge
                        {{ $flightBooking->status == 'confirmed'
                            ? 'badge-success'
                            : ($flightBooking->status == 'cancelled'
                                ? 'badge-danger'
                                : 'badge-warning') }}">
                            {{ ucfirst($flightBooking->status) }}
                        </span>
                    </div>
                </div>

                @if ($flightBooking->notes)
                    <div class="mt-3">
                        <b>Notes:</b>
                        <p class="mb-0">{{ $flightBooking->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
