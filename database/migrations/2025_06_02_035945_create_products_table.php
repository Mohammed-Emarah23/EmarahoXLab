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
        Schema::create('products', function (Blueprint $table) {
            /*

                Add Columns [name , desc , price , image , quantity ]

            */

            $table->id();
            $table->string('name',255);
            $table->text('desc');
            $table->decimal('price',8,2);
            $table->string('image',255)->nullable();
            $table->integer('quantity');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
