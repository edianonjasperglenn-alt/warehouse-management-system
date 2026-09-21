<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration{public function up(){Schema::create('posts',function(Blueprint $t){$t->id();$t->string('title');$t->longText('body');$t->enum('status',['Draft','Published'])->default('Draft');$t->foreignId('author_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();$t->unsignedInteger('views')->default(0);$t->timestamps();});}public function down(){Schema::dropIfExists('posts');}};
