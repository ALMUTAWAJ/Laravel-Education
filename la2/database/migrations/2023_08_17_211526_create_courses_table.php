<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('user');  // Add the foreign key column and in next line mark it as foreign key
            $table->foreign('user')->references('username')->on('users');  // (reference is the users table) 
            $table->string("code");
            $table->unique(['user', 'code']); // to indicate that the combination of code and username is unique
            $table->integer("credit");
            $table->decimal("grade");
            $table->string('major');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
