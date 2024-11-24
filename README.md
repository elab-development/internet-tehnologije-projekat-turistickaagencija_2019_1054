# C2C E-Trgovina

C2C E-Trgovina je aplikacija koja omogućava korisnicima da postavljaju i pregledaju oglase, komuniciraju sa vlasnicima oglasa, upravljaju svojim depozitima, i vrše plaćanja putem integracije sa Stripe-om. Aplikacija koristi Laravel kao backend i omogućava pristup svim funkcijama korisnicima sa različitim nivoima privilegija.

## Funkcionalnosti

- **Korisnički deo:**
  - Pregled svih oglasa sa mogućnostima filtriranja po kategorijama i sortiranja po ceni.
  - Pregled detalja oglasa sa opcijom slanja poruke vlasniku oglasa.
  - Dodavanje novih oglasa sa nazivom, opisom, cenom, kategorijom i slikama.
  - Upravljanje depozitima uz mogućnost dodavanja depozita do 9999 RSD.
  - Pregled i odgovaranje na poruke.
  - Plaćanje putem Stripe integracije za korisnike koji žele da izvrše transakcije.


- **Admin deo:**
  - Pregled i upravljanje svim oglasima.
  

## Tehnologije

- **Backend**: Laravel 11.x
- **Frontend**: HTML, CSS (Bootstrap), SCSS
- **Baza podataka**: MySQL
- **Stripe integracija** za plaćanja
- **Autentifikacija**: Laravel Auth

## Instalacija i pokretanje na lokalnoj mašini

Pratite sledeće korake da biste postavili i pokrenuli projekat na lokalnoj mašini:

### 1. Kloniranje repozitorijuma

Prvo klonirajte repozitorijum na vaš računar:

```bash
git clone https://github.com/elab-development/internet-tehnologije-projekat-turistickaagencija_2019_1054
2. Instalacija zavisnosti
Pređite u direktorijum sa projektom i instalirajte zavisnosti putem Composer:

bash
Copy code
cd c2c_e_trgovina
composer install
3. Postavljanje env fajla
Kopirajte .env.example u novi fajl nazvan .env:

bash
Copy code
cp .env.example .env
Zatim, u .env fajlu postavite odgovarajuće vrednosti za vašu bazu podataka i druge parametre (npr. Stripe API ključ, mail konfiguracija itd.).

4. Kreiranje baze podataka
Kreirajte bazu podataka i pokrenite migracije:

bash
Copy code
php artisan migrate
Ako želite da napunite bazu podataka početnim podacima, možete pokrenuti seeders:

bash
Copy code
php artisan db:seed
5. Generisanje aplikacijskog ključa
Pokrenite sledeću komandu da biste generisali aplikacijski ključ:

bash
Copy code
php artisan key:generate
6. Pokretanje lokalnog servera
Pokrenite lokalni server koristeći Artisan komandu:

bash
Copy code
php artisan serve
Server će biti dostupan na http://localhost:8000.

7. Stripe API konfiguracija
Ako želite da testirate Stripe plaćanja, obavezno dodajte svoj Stripe API ključ u .env fajl:

plaintext
Copy code
STRIPE_KEY=vaš_stripe_publishable_key
STRIPE_SECRET=vaš_stripe_secret_key
8. Login i registracija
Na početnoj stranici možete pronaći opcije za prijavu i registraciju korisnika. Ukoliko nemate nalog, registrujte se sa osnovnim podacima (ime, email, lozinka).
