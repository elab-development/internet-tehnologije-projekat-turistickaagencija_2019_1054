<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
           
                $table->id();  // Kreira auto-incrementalni primarni ključ 'id' za tabelu.
                $table->text('text');  // Kreira kolonu 'text' tipa TEXT koja će čuvati tekstualne poruke.
                $table->unsignedBigInteger('sender_id');  // Kreira kolonu 'sender_id' koja čuva ID pošiljaoca poruke (spoljni ključ).
                $table->unsignedBigInteger('receiver_id');  // Kreira kolonu 'receiver_id' koja čuva ID primaoca poruke (spoljni ključ).
                $table->unsignedBigInteger('ad_id');  // Kreira kolonu 'ad_id' koja se koristi za povezivanje poruke sa oglasom (spoljni ključ).
                $table->timestamps();  // Kreira dve kolone 'created_at' i 'updated_at' za praćenje vremena kada je poruka kreirana i poslednji put ažurirana.
                
                // Dodajemo strani ključ za 'ad_id' koji upućuje na tabelu 'ads'
                $table->foreign('ad_id')->references('id')->on('ads')->cascadeOnDelete();  // Kada se obriše oglas, sve povezane poruke će biti obrisane.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
