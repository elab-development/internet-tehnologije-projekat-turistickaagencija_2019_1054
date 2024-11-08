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
        Schema::create('ads', function (Blueprint $table) {

            //opisujemo jedan nas oglas
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->integer('price');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
                // Dodajemo strani ključ za 'user_id'
            $table->foreign('user_id')  // Definišemo da će kolona 'user_id' biti strani ključ
                ->references('id')      // 'user_id' se povezuje sa kolonom 'id' u tabeli 'users'
                ->on('users')           // Tabela na koju se upućuje strani ključ je 'users'
                ->cascadeOnDelete();    // Ako se obriše korisnik (user), svi oglasi povezani sa njim (putem 'user_id') će biti obrisani
            $table->foreign('category_id')  
                ->references('id')      
                ->on('categories');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
