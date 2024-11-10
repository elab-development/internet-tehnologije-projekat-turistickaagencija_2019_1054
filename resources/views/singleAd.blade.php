@extends('layouts.master')

@section('main')
    <div class="row">
        @if (isset($single_ad->image1))
            <div class="col-4">
                <div class="card">
                        <div class="card-body">
                          
                            <img src="/ad_images/{{$single_ad->image1}}" class="img-fluid">
                        </div>
                </div>
            </div>
        @endif
        @if (isset($single_ad->image2))
            <div class="col-4">
                <div class="card">
                        <div class="card-body">
                     
                            <img src="/ad_images/{{$single_ad->image2}}" class="img-fluid">
                        </div>
                </div>
            </div>
        @endif
        @if (isset($single_ad->image3))
            <div class="col-4">
                <div class="card">
                        <div class="card-body">
                     
                            <img src="/ad_images/{{$single_ad->image3}}" class="img-fluid">
                        </div>
                </div>
            </div>
        @endif
        <div class="col-12">
            <h1 class="display-4">{{$single_ad->title}} <span class="btn btn-success">{{$single_ad->category->name}}</span></h1>
            <p>{{$single_ad->body}}</p>
    </div>
@endsection

