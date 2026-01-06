@extends('dashboard.layouts.master')
@section('title', 'Contact Details')

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
            <div class="col-md-6 text-right">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Contact Information</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4"><b>Name:</b> {{ $contact->name }}</div>
                    <div class="col-md-4"><b>Email:</b> {{ $contact->email ?? '-' }}</div>
                    <div class="col-md-4"><b>Phone:</b> {{ $contact->phone }}</div>

                    <div class="col-md-12 mt-2"><b>Message:</b>
                        <p class="mb-0">{{ $contact->message }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
