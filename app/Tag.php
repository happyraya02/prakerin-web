<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Tag extends Model
{
    protected $fillable = ['nama_tag', 'slug'];
    public $timestamps = true;

    public function artikel()
    {
        return $this->belongsToMany('App\Artikel', 'artikel_tag', 'id_tag', 'id_artikel');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    // public static function boot()
    // {
    //     parent::boot();
    //     self::deleting(function ($tag) {
    //         //mencetak
    //         if ($tag->Artikel->count() > 0) {
    //             $html = 'Tag tdk bisa dihapus karena masih digunakan oleh artikel';
    //             $html .= '<ul>';
    //             foreach ($tag->Artikel as $data) {
    //                 $html .= "<li>$data->judul</li>";
    //             }
    //             $html .= '<ul>';
    //             Session::flash("flash_notification", [

    //                 "level" => "danger",
    //                 "message" => $html
    //             ]);
    //             return false;
    //         }
    //     });
}
