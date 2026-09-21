<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration{public function up(){Schema::create('products',function(Blueprint $t){$t->id();$t->string('sku')->unique();$t->string('name');$t->foreignId('category_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();$t->decimal('price',12,2)->default(0);$t->unsignedInteger('stock_quantity')->default(0);$t->text('description')->nullable();$t->timestamps();});}public function down(){Schema::dropIfExists('products');}};
