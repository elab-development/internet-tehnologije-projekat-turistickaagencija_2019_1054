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
<<<<<<< HEAD

                    <img src="/ad_images/{{$single_ad->image1}}" class="img-fluid">
=======
                    <img id="main-image" src="/ad_images/{{$single_ad->image1}}" class="img-fluid">
>>>>>>> nova-grana
                </div>
            @endif
                <div class="col-6 offset-3">
                    <div class="row">
                        @if (isset($single_ad->image2))
                        <div class="col-6">
<<<<<<< HEAD
                      <img src="/ad_images/{{$single_ad->image2}}" class="img-fluid">
=======
                      <img src="/ad_images/{{$single_ad->image2}}" class="thumb img-fluid">
>>>>>>> nova-grana
                        </div>
                        @endif
                        @if (isset($single_ad->image3))
                        <div class="col-6">
<<<<<<< HEAD
                      <img src="/ad_images/{{$single_ad->image3}}" class="img-fluid">
=======
                      <img src="/ad_images/{{$single_ad->image3}}" class="thumb img-fluid">
>>>>>>> nova-grana
                        </div>
                        @endif
                  </div>
                </div>
            </div>
<<<<<<< HEAD
=======




>>>>>>> nova-grana
        </div>
    </div>
</div>

@endsection



@section('page-scripts')
    <script>
        let thumbs = document.querySelectorAll('.thumb');
        for (let index = 0; index < thumbs.length; index++) {
            const thumb = thumbs[index];
            thumb.addEventListener('click', function() {
                let mainImg = document.querySelector('#main-image');
                let mainImgSrc = mainImg.getAttribute('src');
                let src = this.getAttribute('src');  // Preuzmi src kliknute mini slike
                mainImg.setAttribute('src', src);
                this.setAttribute('src',mainImgSrc);
                  // Postavi src glavne slike na src mini slike
            });
        }
    </script>
@endsection
