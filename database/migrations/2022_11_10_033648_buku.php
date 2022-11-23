<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('buku', function (Blueprint $table){
            $table->id();
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('penulis');
            $table->string('penerbit');
            $table->float('harga',10,2);
            $table->integer('view');
            $table->integer('stok');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('kategori')->constrained()->onDelete('cascade');
            $table->enum('status',['publish','draft']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
