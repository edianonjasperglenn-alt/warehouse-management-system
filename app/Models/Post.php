<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Post extends Model {protected $fillable=['title','body','status','author_id','views'];protected $casts=['views'=>'integer'];public function author(){return $this->belongsTo(User::class,'author_id');}}
