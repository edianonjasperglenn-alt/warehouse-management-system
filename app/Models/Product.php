<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model {protected $fillable=['sku','name','category_id','price','stock_quantity','description'];protected $casts=['price'=>'decimal:2','stock_quantity'=>'integer'];public function category(){return $this->belongsTo(Category::class);}public function getStockStatusAttribute(){return $this->stock_quantity===0?'Out of Stock':($this->stock_quantity<=5?'Low Stock':'In Stock');}}
