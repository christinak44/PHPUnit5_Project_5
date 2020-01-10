<?php
namespace App\Classes;
use App\Exception\ApiException;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   //public $timestamps = false;
   protected $table = 'comments';
   //protected $fillable = ['commenter','comment'];
   public function entry()
   {
        return $this->belongsTo('App\Entry');
   }
}
