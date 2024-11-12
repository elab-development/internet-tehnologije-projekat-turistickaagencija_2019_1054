<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      //  $all_ads = Ad::where('user_id',Auth::user()->id)->get();

      $all_ads = Auth::user()->ads;
        return view('home',['all_ads' => $all_ads]);
    }
    //addDeposit metoda: Ovo je metoda koja se poziva kada korisnik pristupi /home/add-deposit. Metoda vraća view home.partials.addDeposit, gde se prikazuje forma za dodavanje depozita.
    public function addDeposit()
    {
        return view('home.partials.addDeposit');
    }
    public function updateDeposit(Request $request){

        $user = Auth::user();


        $request->validate([
            "deposit"=>"required|max:4"

        ],
        [
            "deposit.max"=>"Can't add more then 9999 rsd at once"

        ]);
        $user->deposit =  $user->deposit + $request->deposit;
        return redirect(route('home'));
    }
    //Metoda učitava sve kategorije iz baze koristeći Category::all() i prosleđuje ih view-u showAddForm kako bi korisnik mogao izabrati kategoriju prilikom dodavanja oglasa.
    public function showAddForm(){
        $allCategories = Category::all();
        return view('home.showAddForm',['categories'=>$allCategories]);
    }
  
     // Metoda za čuvanje oglasa
     public function saveAd(Request $request)
     {
         $request->validate([
             'title' => 'required|max:255',
             'body' => 'required',
             'price' => 'required',
             'image1' => 'mimes:jpeg,jpg,png',
             'image2' => 'mimes:jpeg,jpg,png',
             'image3' => 'mimes:jpeg,jpg,png',
             'category' => 'required'
         ]);
 
        // Provera da li je fajl sa imenom 'image1' poslat kroz HTTP zahtev
        if ($request->hasFile('image1')) {

            // Ako je fajl poslat, uzmi ga koristeći metodu 'file' i dodeli ga promenljivoj $image1
            $image1 = $request->file('image1');
            
            // Kreiraj jedinstveno ime za fajl koristeći trenutni timestamp i dodaj '1.' pre ekstenzije fajla
            // Ovo osigurava da fajl ima jedinstveno ime, na primer '1633404602_1.jpg'
            $image1_name = time().'1.'.$image1->extension();
            
            // Premesti fajl u direktorijum 'ad_images' unutar javnog direktorijuma (public)
            // Funkcija 'move' premešta fajl sa njegovog privremenog mesta u direktorijum 'ad_images' 
            // u javnom direktorijumu (gdje bi bio dostupan putem URL-a)
            $image1->move(public_path('ad_images'), $image1_name);
        }
         // Takođe proveri za druge slike ako su poslate (image2, image3)
         if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2_name = time().'2.'.$image2->extension();  // Koristi $image2->extension() umesto $image1->extension()
            $image2->move(public_path('ad_images'), $image2_name);
        }
        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $image3_name = time().'3.'.$image3->extension();  // Koristi $image3->extension() umesto $image1->extension()
            $image3->move(public_path('ad_images'), $image3_name);
        }


        Ad::create([
            'title'  => $request->title,
            'body'   => $request->body,
            'price'  => $request->price,
            'image1' => (isset($image1_name)) ? $image1_name : null,
            'image2' => (isset($image2_name)) ? $image2_name : null,
            'image3' => (isset($image3_name)) ? $image3_name : null,
            'user_id' => Auth::id(), // Korisnik koji je postavio oglas
            'category_id' => $request->category
        ]);
         return redirect()->route('home')->with('success', 'Ad saved successfully');

     }
        public function showSingleAd($id){

        // Pronalazi oglas u bazi koristeći njegov jedinstveni ID.
        // Metoda find() vraća model oglasa sa datim ID-em ili null ako oglas ne postoji.
        $single_ad = Ad::find($id);

        // Vraća view 'home.singleAd' i prosleđuje mu pronađeni oglas kroz promenljivu 'single_ad'.
        // Na ovaj način, view dobija pristup podacima oglasa za prikazivanje.
        return view('home.partials.singleAd', ['single_ad' => $single_ad]);
            
        }
        public function showMessages(){

            $messages = Message::where('receiver_id',Auth::user()->id)->get();
            // dd($messages);

            return view('home.messages',compact('messages'));

        }
       // Metoda  služi za prikazivanje odgovora na poruke povezane sa određenim oglasom. 
        public function reply(){
            // Uzima 'sender_id' iz zahteva (URL parametar koji je prosleđen u ruti)
            // Ovaj ID nam je potreban da bismo znali koji korisnik je poslao poruku
            $sender_id = request()->sender_id;

            // Uzima 'ad_id' iz zahteva (URL parametar koji je prosleđen u ruti)
            // Ovaj ID nam je potreban da bismo znali koji oglas je povezan sa porukom
            $ad_id = request()->ad_id;

            // Dohvata sve poruke koje imaju isti 'sender_id' i 'ad_id' iz baze podataka
            // Koristimo 'where' metodu za filtriranje poruka koje su poslate od strane određenog korisnika (sender_id)
            // i koje su vezane za određeni oglas (ad_id)
            // Ovaj upit vraća kolekciju poruka koje zadovoljavaju ove uslove
            $messages = Message::where('sender_id', $sender_id)
                            ->where('ad_id', $ad_id)
                            ->get();

            // Vraća view 'home.reply' i prosleđuje sledeće podatke:
            // - 'sender_id' koji predstavlja ID pošiljaoca poruke
            // - 'ad_id' koji predstavlja ID oglasa na koji se odgovara
            // - 'messages' koji sadrži sve poruke koje su povezane sa određenim pošiljaocem i oglasom
            // Funkcija 'compact' se koristi da prosledi ove varijable u view
            return view('home.reply', compact('sender_id', 'ad_id', 'messages'));
        }

        // koristi za kreiranje nove poruke kao odgovor na prethodno primljene poruke
        public function replyStore(Request $request){

            $sender = User::find($request->sender_id);
            $ad = Ad::find($request->ad_id);


            $new_msg = new Message();
            $new_msg->text = $request->msg;
            $new_msg->sender_id  = Auth::user()->id;
            $new_msg->receiver_id = $sender->id;
            $new_msg->ad_id = $ad->id;
            $new_msg->save();
            return redirect()->route('home.showMessages')->with('message','Reply sent');
            
        }
    }