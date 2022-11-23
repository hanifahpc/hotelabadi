<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;

    protected $table= 'buku';

    protected $fillable= [
        'judul',
        'deskripsi',
        'penulis',
        'penerbit',
        'harga',
        'view',
        'stok',
        'status',
        'kategori_id',
        'user_id',
    ];

        public function kategori(){
            return $this->belongsTo('App\Models\Kategori','kategori_id');
        }

        public function user(){
            return $this->belongsTo('App\Models\User','user_id');
        }

        public function fotobuku(){
            return $this->hasMany('App\Models\FotoBuku');

        }

}
