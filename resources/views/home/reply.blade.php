@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <!-- Deo za sidebar, uključuje delimični prikaz za navigaciju -->
        <div class="col-4">
            @include('home.partials.sidebar')
        </div>
        
        <!-- Glavni deo za prikazivanje poruka i formulara za odgovor -->
        <div class="col-8">
            <h2>Odgovori</h2>

            <!-- Lista prethodnih poruka koje se odnose na određeni oglas -->
            <ul class="list-group">
                <!-- Prolazi kroz svaku poruku i prikazuje pošiljaoca, datum i sadržaj -->
                @foreach ($messages as $message)
                <li class="list-group-item mb-2">
                    <p>
                        <!-- Prikazuje naslov oglasa na koji se poruka odnosi -->
                        Oglas: {{$message->ad->title}} <br>
                        <!-- Prikazuje datum kreiranja poruke -->
                        <span class="float-right">{{ $message->created_at->format('d M Y') }}</span> <br>
                        <!-- Prikazuje ime pošiljaoca poruke -->
                        <p>Od: {{$message->sender->name}}</p>
                        <!-- Prikazuje tekst poruke -->
                        <p><strong>{{$message->text}}</strong></p>
                        <!-- Link za odgovor na ovu specifičnu poruku za dati oglas i pošiljaoca -->
                        <a href="{{ route('home.reply',['sender_id'=>$message->sender->id,'ad_id'=>$message->ad_id]) }}">Odgovori</a>
                    </p>
                </li>
                @endforeach

                <!-- Formular za slanje nove poruke (odgovora) pošiljaocu -->
                <li class="list-group-item mb-2">
                    <form action="{{ route('home.replyStore') }}" method="POST">
                        @csrf
                        <!-- Skriveno polje za ID pošiljaoca, kako bi se odgovor poslao pravoj osobi -->
                        <input type="hidden" name="sender_id" value="{{$sender_id}}">
                        <!-- Skriveno polje za ID oglasa, kako bi se odgovor povezao sa tačnim oglasom -->
                        <input type="hidden" name="ad_id" value="{{$ad_id}}">

                        <!-- Tekstualno polje za unos odgovora -->
                        <textarea name="msg" class="form-control" cols="30" rows="10"></textarea>
                        <!-- Dugme za slanje odgovora -->
                        <button type="submit" class="btn btn-primary form-control">Odgovori</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection

