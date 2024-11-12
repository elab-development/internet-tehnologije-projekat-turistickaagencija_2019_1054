<?php

namespace App\Models;
//Ova linija omogućava da Message klasa koristi sve funkcionalnosti Laravelovog Model sistema, što uključuje rad sa bazom podataka (kao što su dohvatanje, čuvanje i ažuriranje podataka)
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    //Ova metoda definiše relaciju između Message modela i Ad modela. Kada pozovemo ad() na objektu Message, vraća nam oglas (Ad) koji je povezan sa tom porukom.
    public function ad(){
        //Ovaj deo koda koristi Laravelovu funkciju belongsTo, koja označava da poruka (Message) pripada jednom oglasu (Ad).
        // To znači da će Message model imati ad_id kolonu u svojoj tabeli, koja referencira oglas u ads tabeli
        return $this->belongsTo('\App\Models\Ad');
    }

  //  Ova relacija omogućava da se lako pristupi oglasu koji je povezan sa određenom porukom, tako što će se, na primer, pozvati Message::find($id)->ad, gde $id predstavlja ID poruke

    public function sender(){
        // Ovaj deo koda koristi Laravelovu funkciju belongsTo, koja označava da poruka (Message) pripada jednom korisniku (User).
        // To znači da će Message model imati sender_id kolonu u svojoj tabeli, koja referencira korisnika (User) koji je poslao poruku.
        return $this->belongsTo('\App\Models\User','sender_id');
    }
}
