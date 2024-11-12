<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function ads()
    {
        return $this->hasMany('App\Models\Ad');


    }
    // Metoda koja definiše vezu između korisnika i poruka koje je korisnik primio
    public function messages(){
        // Vezujemo model User sa modelom Message koristeći 'hasMany' vezu,
        // što znači da jedan korisnik može imati više poruka
        // Prvi parametar je putanja do modela Message koji je povezan sa User modelom
        // Drugi parametar je kolona 'receiver_id' u tabeli messages koja se koristi kao strani ključ 
        // za povezivanje poruke sa korisnikom koji je primalac
        return $this->hasMany('App\Models\Message','receiver_id');
        //U tvojoj migraciji 2024_11_06_130230_create_messages_table, kada se kreira tabela messages, postoji kolona receiver_id, koja je strani ključ koji povezuje poruku sa korisnikom (primaocem).
    }
}
