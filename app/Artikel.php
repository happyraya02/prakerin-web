<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $fillable = [
        'judul', 'slug', 'foto',
        'konten', 'id_user', 'id_kategori', 'id_tag',
    ];
    protected $table = 'artikels';

    public function Kategori()
    {
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }
    public function user()
    {
        return $this->belongsTo('App\user', 'id_user');
    }
    public function Tag()
    {
        return $this->belongsToMany('App\Tag', 'id_tag');
    }
    public function Artikel()
    {
        return $this->belongsTo('App\Artikel', 'id_Artikel');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
