<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
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
      //  $all_ads = Ad::where('user_id',Auth::user()->id)->get();

      if(Auth::user()->role != 'user'){
        return view('admin.admin',compact('all_ads', 'categories'));
      }
      else{
        return redirect()->route('home');
      }


    }
    //addDeposit metoda: Ovo je metoda koja se poziva kada korisnik pristupi /home/add-deposit. Metoda vraća view home.partials.addDeposit, gde se prikazuje forma za dodavanje depozita.
    public function edit($id){
        $single_ad = Ad::findOrFail($id);  // Ako oglas sa tim ID-jem ne postoji, biće izazvana greška 404
        $categories = Category::all();
        // Vraćaš view admin.edit.blade.php i prosleđuješ podatke o oglasu
        return view('admin.edit', compact('single_ad','categories'));
  
      }
      public function update(Request $request, $id)
        {  
        $ad = Ad::findOrFail($id);  // Pronađi oglas sa određenim ID-jem
        // dd($ad);
            // dd($request);
        // Validacija podataka
        // $validated = $request->validate([
        //     'title' => 'required|max:255',
        //     'body' => 'required',
        //     'price' => 'required|numeric',
        //     'image1' => 'nullable|mimes:jpeg,jpg,png|max:2048',  // Dodajte maksimalnu veličinu slike
        //     'image2' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        //     'image3' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        //     'category_id' => 'required|exists:categories,id',  // Ispravka na category_id
        // ]);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'price' => 'required',
            'image1' => 'mimes:jpeg,jpg,png',
            'image2' => 'mimes:jpeg,jpg,png',
            'image3' => 'mimes:jpeg,jpg,png',
            'category_id' => 'required'
        ]);



        // Ažuriraj osnovne podatke o oglasu
        $ad->title = $validated['title'];
        $ad->body = $validated['body'];
        $ad->price = $validated['price'];
        $ad->category_id = $validated['category_id'];

        // Obradi slike (ako su poslati)
        if ($request->hasFile('image1')) {
            $ad->image1 = $request->file('image1')->store('ad_images', 'public');
        }
        if ($request->hasFile('image2')) {
            $ad->image2 = $request->file('image2')->store('ad_images', 'public');
        }
        if ($request->hasFile('image3')) {
            $ad->image3 = $request->file('image3')->store('ad_images', 'public');
        }

        // Spasi izmene
        $ad->save();

        // Preusmeri na stranicu sa svim oglasima
        return redirect()->route('admin.admin')->with('success', 'Oglas uspešno ažuriran!');
            }
        public function destroy($id)
        {
            $ad = Ad::findOrFail($id);  // Pronađi oglas sa određenim ID-jem
            $ad->delete();  // Obriši oglas

            // Preusmeri na stranicu sa svim oglasima sa porukom o uspešnom brisanju
            return redirect()->route('admin.admin')->with('success', 'Oglas uspešno obrisan!');
        }

}