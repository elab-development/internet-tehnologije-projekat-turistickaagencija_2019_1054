

<!-- Ovo je dugme koje prikazuje trenutni iznos depozita korisnika ako je prijavljen i ima postavljen depozit.
     Ako korisnik nije prijavljen ili nema postavljen depozit, prikazuje 0 rsd. -->
     <button class="btn btn-success form-control m-2">Deposit {{ Auth::check() && Auth::user()->deposit ? Auth::user()->deposit : 0 }} rsd</button>

     <!-- Link koji vodi ka stranici sa svim oglasima (trenutno prazan href atribut znači da ne vodi nigde). -->
     <a href="{{route('home')}}" class="btn btn-secondary form-control m-2">All ads</a>
     
     <!-- Link ka stranici za dodavanje depozita. Koristi prilagođenu rutu definisanu kao 'home.addDeposit'. -->
     
      <!-- Ovaj link koristi route('home.addDeposit'), što generiše URL do /home/add-deposit, i vodi korisnika na stranicu gde može uneti iznos depozita. -->

     <a href="{{ route('home.addDeposit') }}" class="btn btn-secondary form-control m-2">Add deposit</a>
     
     <!-- Link ka stranici sa porukama (trenutno prazan href atribut znači da ne vodi nigde). -->
     <a href="{{ route('home.showMessages') }}" class="btn btn-secondary form-control m-2">Messages <span>{{ Auth::user()->messages->count() }}</span></a>

     
     <!-- Link koristi rutu home.showAddForm, što vodi korisnika na stranicu sa formom za kreiranje oglasa kada klikne na dugme "New Ad". -->
     <a href="{{route('home.showAddForm')}}" class="btn btn-primary form-control m-2">New Ad</a>
     