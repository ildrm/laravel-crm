<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('workflows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('trigger')->nullable();
            $table->string('action')->nullable();
            $table->text('elements')->nullable(); // New field for storing workflow elements
            $table->text('connections')->nullable(); // New field for storing connections between elements
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('workflows');
    }
};
