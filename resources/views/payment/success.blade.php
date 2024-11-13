{{-- resources/views/payment/success.blade.php --}}

@extends('layouts.app') {{-- Prilagodite prema svom osnovnom layoutu --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Success</div>

                    <div class="card-body">
                        <h3>Thank you for your payment!</h3>
                        <p>Your payment has been successfully processed. Your order is complete.</p>

                        <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
