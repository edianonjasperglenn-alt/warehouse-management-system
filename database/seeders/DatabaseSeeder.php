<?php
namespace Database\Seeders;
use App\Models\{User,Category,Product,Post};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {public function run():void{
 User::create(['name'=>'System Administrator','email'=>'admin@warehouse.test','password'=>Hash::make('password'),'role'=>'Admin','status'=>'Active']);
 User::create(['name'=>'Inventory Editor','email'=>'editor@warehouse.test','password'=>Hash::make('password'),'role'=>'Editor','status'=>'Active']);
 User::create(['name'=>'Warehouse Viewer','email'=>'viewer@warehouse.test','password'=>Hash::make('password'),'role'=>'Viewer','status'=>'Active']);
 foreach(['Electronics','Office Supplies','Packaging','Cleaning Supplies'] as $n) Category::create(['name'=>$n,'description'=>"{$n} inventory"]);
 $cats=Category::pluck('id','name');
 Product::insert([
 ['sku'=>'WH-1001','name'=>'Barcode Labels','category_id'=>$cats['Packaging'],'price'=>120,'stock_quantity'=>40,'description'=>'Roll of warehouse labels','created_at'=>now(),'updated_at'=>now()],
 ['sku'=>'WH-1002','name'=>'USB Keyboard','category_id'=>$cats['Electronics'],'price'=>550,'stock_quantity'=>12,'description'=>'Standard USB keyboard','created_at'=>now(),'updated_at'=>now()],
 ['sku'=>'WH-1003','name'=>'Printer Paper A4','category_id'=>$cats['Office Supplies'],'price'=>250,'stock_quantity'=>4,'description'=>'500 sheets per ream','created_at'=>now(),'updated_at'=>now()],
 ['sku'=>'WH-1004','name'=>'Packing Tape','category_id'=>$cats['Packaging'],'price'=>85,'stock_quantity'=>0,'description'=>'Heavy duty clear tape','created_at'=>now(),'updated_at'=>now()],
 ]);
 Post::create(['title'=>'Warehouse System Launch','body'=>'The new warehouse management dashboard is ready for inventory tracking and announcements.','status'=>'Published','author_id'=>1,'views'=>25]);
 Post::create(['title'=>'Inventory Check Reminder','body'=>'Please review low-stock items and update quantities after physical counts.','status'=>'Published','author_id'=>2,'views'=>12]);
}}
