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
            $table->foreignIdFor(\App\Models\FoodCategories::class)->constrained();
            $table->foreignIdFor(\App\Models\Restaurant::class)->constrained();
            $table->foreignIdFor(\App\Models\Discount::class)->nullable()->constrained();
            $table->string('raw_material')->nullable();
            $table->integer('price');
            $table->string('image_path')->nullable()->default('food/images/food.jpg');
            $table->timestamps();
            //foodParty
            //discount
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
