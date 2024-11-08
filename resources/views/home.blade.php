@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-4">
    @include('home.partials.sidebar')
       
    </div>
        
        <div class="col-8">
            <h2>All Ads</h2>
            <ul class="list-group">
                @foreach ($all_ads as $ad)
                 {{-- <a href=""> </a>--}}  
                <li class="list-group-item">
                    <a href=""> 
                        {{$ad->title}}
                    </a>
                </li>

                @endforeach

            </ul>
        </div>
    </div>
</div>
@endsection 
