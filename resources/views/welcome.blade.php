@extends('layouts.master')

@section('main')
    <h1>All ads</h1>
    <!-- Dodaj ovde kod za prikazivanje oglasa -->
        <div class="row">
            <div class="col-3 bg-secondary">
                <ul class="list-group list-group-flush">
                    @foreach ($categories as $cat)
                        <li class="list-group-item bg-secondary">
                                <a href="" class="text-light">{{$cat->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-9">
                <ul class="list-group">
                    @foreach ($all_ads as $ad)
                        <li class="list-group-item">
                            <a href="{{ route('singleAd', ['id' => $ad->id]) }}" >{{$ad->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

@endsection
