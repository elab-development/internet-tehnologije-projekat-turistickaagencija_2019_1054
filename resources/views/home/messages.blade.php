@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-4">
            @include('home.partials.sidebar')
        </div>
        
        <div class="col-8">
            <h2>All Messages</h2>

            <ul class="list-group">
                @foreach ($messages as $message)
                    <li class="list-group-item mb-2">
                        <p>
                            Oglas: {{$message->ad->title}} <br>
                            <span class="float-right">{{ $message->created_at->format('d M Y') }}</span> <br>
                            <p>From: {{$message->sender->name}}</p>
                            <p><strong>{{$message->text}}</strong></p>
                            <a href="">Reply</a>
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
