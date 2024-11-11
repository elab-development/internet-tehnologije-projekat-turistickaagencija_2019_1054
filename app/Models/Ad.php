<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{   /*
    Ovaj kod predstavlja Eloquent model za Ad (oglas) entitet u Laravelu.
    Laravel koristi Eloquent ORM (Object-Relational Mapping) 
    za rad sa bazom podataka, što omogućava lako mapiranje između objekata i tabela baze podataka.
    */
    
    // $guarded je zaštita od masovnog dodeljivanja. Ovo znači da neće biti moguće masovno dodeliti vrednosti
    // za ove atribute. U ovom slučaju, prazan niz znači da su svi atributi dozvoljeni za masovno dodeljivanje.
    protected $guarded = [];

    /**
     * Definiše odnos između modela Ad i Category.
     * Ovaj metod označava da svaki oglas pripada jednoj kategoriji.
     * U bazi podataka, tabela ads ima strani ključ category_id koji upućuje na tabelu categories.
     *
     * 
     */
    public function category(){
      // Vraća instancu klase BelongsTo koja označava da Ad pripada Category.
        return $this->belongsTo('\App\Models\Category');

    }

     /**
     * Definiše odnos između modela Ad i User.
     * Ovaj metod označava da svaki oglas pripada jednom korisniku (korisnik koji je postavio oglas).
     * U bazi podataka, tabela ads ima strani ključ user_id koji upućuje na tabelu users.
     *
     * 
     */
    public function user(){
       // Vraća instancu klase BelongsTo koja označava da Ad pripada User.
        return $this->belongsTo('\App\Models\User');

    }
}
