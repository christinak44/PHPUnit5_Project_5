<?php
namespace App\Classes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   //public $timestamps = false;
   protected $table = 'comments';
   //protected $fillable = ['commenter','comment'];
   public function comment()
   {
        return $this->belongsTo('App\Entry');
   }
}
