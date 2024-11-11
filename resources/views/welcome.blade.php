@extends('layouts.master')

@section('main')
    <h1>All ads</h1>
    <!-- Dodaj ovde kod za prikazivanje oglasa -->
        <div class="row">
            <div class="col-3 bg-secondary">
                <ul class="list-group list-group-flush">
                    @foreach ($categories as $cat)
                        <li class="list-group-item bg-secondary">
                                <a href="{{route('welcome')}}?cat={{$cat->name}}" class="text-light">{{$cat->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-9">
                <ul class="list-group">
                    @foreach ($all_ads as $ad)
                    {{--
                        <li class="list-group-item">
                            <a href="{{ route('singleAd', ['id' => $ad->id]) }}" >{{$ad->title}}</a>
                            <span class="badge badge-warning p-1 ml-2">Pregleda {{$ad->views}}</span>
                            <span class="badge badge-primary p-1 ml-2">{{ $ad->price }} rsd</span>
                        </li>
                        --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('singleAd', ['id' => $ad->id]) }}">{{ $ad->title }}</a>
                            <div>
                                <span class="badge bg-warning text-dark me-2">Pregleda {{ $ad->views }}</span>
                                <span class="badge bg-primary text-light">{{ $ad->price }} rsd</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

@endsection

 {{--
@section('styles')
<style>
    #main-image, .thumb {
    max-width: 100%;
    height: auto;
    object-fit: contain;  /* Prilagođava slike unutar njihovih okvira, održavajući odnos širine i visine */
}
</style>
@endsection
 --}}