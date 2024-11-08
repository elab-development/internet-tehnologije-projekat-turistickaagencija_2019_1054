<!-- Ovaj deo proširuje osnovni layout fajl 'layouts.app', tako da će ovaj sadržaj biti uključen unutar definisanog layout-a. -->
@extends('layouts.app')

<!-- Definisanje sekcije 'content' koja će zameniti deo sadržaja definisanog kao 'content' u osnovnom layout-u. -->
@section('content')

<div class="container">
    <!-- Glavni kontejner za sadržaj stranice koji koristi Bootstrap klasu 'container' za centriranje i raspored. -->
    <div class="row">
        <!-- Prva kolona koja zauzima 4 od 12 Bootstrap kolona. Ovaj deo uključuje fajl 'home.partials.sidebar'. -->
        <div class="col-4">
            @include('home.partials.sidebar')
        </div>
        
        <!-- Druga kolona koja zauzima 8 od 12 Bootstrap kolona i sadrži formu za dodavanje depozita. -->
        <div class="col-8">
         
            <form action=" " method="POST" enctype="multipart/form-data">
                @csrs
                <input type="text" name="title" placeholder="title" class="form-control"><br>
                <textarea name="body" class="form-control" placeholder="body"  cols="30" rows="10"></textarea>
                <input type="number" name="price" class="form-control" placeholder="price"><br>
                <input type="file" neme="image1" class="form-control">
                <input type="file" neme="image2" class="form-control">
                <input type="file" neme="image3" class="form-control"><br>
                <select name="category" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>

                    
                @endforeach
                </select><br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@endsection



