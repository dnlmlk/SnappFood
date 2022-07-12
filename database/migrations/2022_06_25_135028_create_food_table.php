<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(\App\Models\Restaurant::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\FoodCategories::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Discount::class)->nullable()->constrained()->nullOnDelete();
            $table->string('raw_material')->nullable();
            $table->float('price');
            $table->float('final_price')->nullable();
            $table->string('image_path')->nullable()->default('food/images/food.jpg');
            $table->timestamps();
            //foodParty
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
};
