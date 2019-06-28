<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Kategori extends Model
{
    protected $fillable = ['nama_kategori', 'slug'];
    public $timestamps = true;

    public function Artikel()
    {
        return $this->hasMany('App\Artikel', 'id_kategori');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($kategori) {
            //mencetak
            if ($kategori->artikel->count() > 0) {
                $html = 'Kategori tdk bisa dihapus karena 
                masih digunakan oleh artikel';
                $html .= '<ul>';
                foreach ($kategori->artikel as $data) {
                    $html .= "<li>$data->judul</li>";
                }
                $html .= '<ul>';
                Session::flash("flash_notification", [

                    "level" => "danger",
                    "message" => $html
                ]);
                return false;
            }
        });
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
