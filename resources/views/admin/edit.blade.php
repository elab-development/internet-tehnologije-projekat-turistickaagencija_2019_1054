
{{--
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
                    <img id="main-image" src="/ad_images/{{$single_ad->image1}}" class="img-fluid">
                </div>
            @endif
                <div class="col-6 offset-3">
                    <div class="row">
                        @if (isset($single_ad->image2))
                        <div class="col-6">
                      <img src="/ad_images/{{$single_ad->image2}}" class="thumb img-fluid">
                        </div>
                        @endif
                        @if (isset($single_ad->image3))
                        <div class="col-6">
                      <img src="/ad_images/{{$single_ad->image3}}" class="thumb img-fluid">
                        </div>
                        @endif
                  </div>
                </div>
            </div>




        </div>
    </div>
</div>

@endsection

--}}
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
     
        
        <div class="col-8">
            <h4>Izmeni oglas: {{ $single_ad->title }}</h4>

            <!-- Forma za izmenu oglasa -->
            <form action="{{ route('admin.update', ['id' => $single_ad->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')  <!-- Ovaj metod omogućava PUT zahtev za izmenu podataka -->

                <div class="form-group">
                    <label for="title">Naslov oglasa</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $single_ad->title }}" required>
                </div>

                <div class="form-group">
                    <label for="body">Opis oglasa</label>
                    <textarea name="body" id="body" class="form-control" required>{{ $single_ad->body }}</textarea>
                </div>

                <div class="form-group">
                    <label for="price">Cena</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ $single_ad->price }}" required>
                </div>

                <div class="form-group">
                    <label for="category">Kategorija</label>
                    <select name="category_id" id="category" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $single_ad->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image1">Slika 1</label>
                    <input type="file" name="image1" id="image1" class="form-control">
                    @if ($single_ad->image1)
                        <img src="/ad_images/{{ $single_ad->image1 }}" class="img-fluid mt-2" alt="Slika 1">
                    @endif
                </div>

                <div class="form-group">
                    <label for="image2">Slika 2</label>
                    <input type="file" name="image2" id="image2" class="form-control">
                    @if ($single_ad->image2)
                        <img src="/ad_images/{{ $single_ad->image2 }}" class="img-fluid mt-2" alt="Slika 2">
                    @endif
                </div>

                <div class="form-group">
                    <label for="image3">Slika 3</label>
                    <input type="file" name="image3" id="image3" class="form-control">
                    @if ($single_ad->image3)
                        <img src="/ad_images/{{ $single_ad->image3 }}" class="img-fluid mt-2" alt="Slika 3">
                    @endif
                </div>

                <button type="submit" class="btn btn-success mt-3">Sacuvaj izmene</button>
            </form>
        </div>
    </div>
</div>

@endsection
