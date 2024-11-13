{{-- resources/views/payment/cancel.blade.php --}}

@extends('layouts.app') {{-- Prilagodite prema svom osnovnom layoutu --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Payment Canceled</div>

                    <div class="card-body">
                        <h3>We're sorry, but your payment was canceled.</h3>
                        <p>If this was a mistake, please try again. If you have any questions, feel free to contact us.</p>

                        <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
