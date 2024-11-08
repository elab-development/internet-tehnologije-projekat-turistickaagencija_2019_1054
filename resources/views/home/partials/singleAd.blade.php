@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-4">
            @include('home.partials.sidebar')
        </div>
        
        <div class="col-8">
           <h4>{{ $single_ad->title}}</h4>
        </div>
    </div>
</div>

@endsection
