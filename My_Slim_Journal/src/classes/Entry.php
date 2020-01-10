<?php
namespace App\Classes;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
   //public $timestamps = false;
   protected $table = 'posts';
   //const created_at = 'date';
   //protected $dateFormat = 'd/m/y';
   //protected $fillable = ['title','date','body'];
   public function entry()
     {
        return $this->hasMany('App\Comment', 'entry_id');
     }
}
