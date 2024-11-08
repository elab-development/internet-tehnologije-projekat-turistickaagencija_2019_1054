@extends('layouts.app')
{{-- Proširuje osnovni layout 'layouts.app', koji sadrži zajednički izgled stranice, kao što su zaglavlje, navigacija, i footer. --}}

@section('content')
{{-- Početak sekcije 'content' koja će biti uključena u osnovni layout na mestu predviđenom za sadržaj stranice --}}

<div class="container">
    {{-- Glavni kontejner stranice koji koristi Bootstrap klasu 'container' za centriranje i bolji raspored elemenata --}}
    <div class="row">
        <div class="col-4">
            {{-- Prva kolona širine 4 (od 12), koristi se za prikaz bočne trake --}}
            @include('home.partials.sidebar')
            {{-- Uključuje sidebar fajl sa dodatnim navigacionim opcijama ili linkovima --}}
        </div>
        
        <div class="col-8">
            {{-- Druga kolona širine 8, sadrži listu oglasa korisnika --}}
            <h2>All Ads</h2>
            {{-- Naslov za sekciju sa oglasima --}}

            <ul class="list-group">
                {{-- Neuređena lista sa Bootstrap klasom 'list-group' za stilizaciju --}}
                @foreach ($all_ads as $ad)
                    {{-- Petlja koja prolazi kroz svaki oglas u nizu 'all_ads' --}}
                    
                    <li class="list-group-item">
                        {{-- Svaki oglas je prikazan kao stavka liste sa Bootstrap klasom 'list-group-item' --}}
                        
                        <a href="{{ route('home.singleAd', ['id' => $ad->id]) }}">
                            {{-- Link koji vodi na pojedinačnu stranicu oglasa. Koristi rutu 'home.singleAd' i prosleđuje id oglasa --}}
                            {{$ad->title}}
                            {{-- Prikazuje naslov oglasa kao tekst linka --}}
                        </a>
                    </li>
                @endforeach
            </ul>
            {{-- Kraj liste oglasa --}}
        </div>
    </div>
</div>

@endsection
{{-- Zatvaranje sekcije 'content' --}}

