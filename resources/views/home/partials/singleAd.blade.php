@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-4">
            @include('home.partials.sidebar')
        </div>
        
        <div class="col-8">
           <h4>{{ $single_ad->title}}</h4>
           <div class="row p-3">
            @if (isset($single_ad->image1))
                <div class="col-6 offset-3">

                    <img src="/ad_images/{{$single_ad->image1}}" class="img-fluid">
                </div>
            @endif
                <div class="col-6 offset-3">
                    <div class="row">
                        @if (isset($single_ad->image2))
                        <div class="col-6">
                      <img src="/ad_images/{{$single_ad->image2}}" class="img-fluid">
                        </div>
                        @endif
                        @if (isset($single_ad->image3))
                        <div class="col-6">
                      <img src="/ad_images/{{$single_ad->image3}}" class="img-fluid">
                        </div>
                        @endif
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
