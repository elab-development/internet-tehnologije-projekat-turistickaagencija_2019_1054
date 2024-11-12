<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class AdController extends Controller
{
  public function index()
{

    $all_ads = new Ad; 
    // Proverava da li postoji parametar 'cat' u zahtevu
    if (isset(request()->cat)) {
        // Pronalazi kategoriju koja odgovara imenu prosleđenom kroz 'cat' parametar
       // $cat = Category::where('name', request()->cat)->first();
        
        // Ako je kategorija pronađena, dohvata sve oglase povezane sa tom kategorijom
        // Uključen je i `category` model sa svakim oglasom pomoću `with` za optimizaciju upita
       // $all_ads = Ad::with('category')->where('category_id', $cat->id)->get();
      // Koristi whereHas da dohvati sve oglase koji pripadaju kategoriji sa određenim imenom
      $all_ads = Ad::whereHas('category',function ($query)
      {
         // $query->where('name',request()->cat);
         $query->whereName(request()->cat);

      });
      

    } 
    if(isset(request()->type)){
      $type = (request()->type== 'lower') ? 'asc' : 'desc';

      $all_ads = $all_ads->orderBy('price',$type);
    }
    $all_ads = $all_ads->get();
    // Dohvata sve kategorije koje se prikazuju kao filteri ili meni u prikazu
    $categories = Category::all();

    // Prosleđuje varijable `all_ads` i `categories` u `welcome` pogled
    return view('welcome', compact('all_ads', 'categories'));
}
  public function show($id){

    $single_ad = Ad::find($id);
    
    // Provera da li je korisnik prijavljen i da li je različit od vlasnika oglasa
    if (Auth::check() && Auth::user()->id !== $single_ad->user_id) {
      $single_ad->increment('views');
  }
   // Vraća pogled 'singleAd' sa podatkom o oglasu
    return view('singleAd',compact('single_ad')); 

}
    public function sendMessage(Request $request,$id){
     
    // Pronalazi oglas na osnovu ID-a iz URL-a
    $ad = Ad::find($id);

    // Dohvata korisnika koji je vlasnik oglasa
    $ad_owner = $ad->user;

    // Kreira novu instancu modela Message za slanje poruke
    $new_msg = new Message();

    // Postavlja sadržaj poruke na osnovu vrednosti unete u formu
    $new_msg->text = $request->msg;

    // Postavlja ID korisnika koji šalje poruku
    $new_msg->sender_id = Auth::user()->id;

    // Postavlja ID korisnika koji prima poruku (vlasnik oglasa)
    $new_msg->receiver_id = $ad_owner->id;

    // Povezuje poruku sa određenim oglasom pomoću ID-a oglasa
    $new_msg->ad_id = $ad->id;

    // Snima poruku u bazu podataka
    $new_msg->save();

    // Vraća korisnika na prethodnu stranicu sa porukom o uspehu
      return redirect()->back()->with('message','Message sent');
   
    }
}
