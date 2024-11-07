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
            <!-- Forma za dodavanje depozita koja šalje POST zahtev na rutu 'home.addDeposit'.
            
            action=" {{-- {{ route('home.addDeposit') }}  --}}": Ukazuje da će podaci iz ove forme biti poslati na rutu 'home.addDeposit', odnosno na URL /home/add-deposit.
            method="POST": Definiše da će forma koristiti POST metodu. Ipak, trenutno je ruta home.addDeposit definisana kao GET u web.php, što može uzrokovati problem jer GET ruta ne prihvata POST zahteve.
            
            Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'storeDeposit'])->name('home.storeDeposit');

            -->
        
            <form action="{{ route('home.addDeposit')}}" method="POST">
                <!-- CSRF zaštita, koristi Laravel-ov helper @csrf kako bi se generisao CSRF token za sigurnost. -->
                @csrf
                <!-- Labela za polje depozita. -->
                <label for="deposit">Add deposit</label>
                <!-- Polje za unos iznosa depozita, koristi Bootstrap klasu 'form-control' za stilizaciju. -->
                <input type="text" placeholder="deposit" name="deposit" class="form-control"><br>
                @error('deposit')
                    <p class="bg-warning">{{ $errors->first('deposit')}}</p>
                @enderror

                <!-- Dugme za slanje forme. -->
                <button type="submit" class="btn btn-info">Add</button>
            </form>
        </div>
    </div>
</div>

@endsection



