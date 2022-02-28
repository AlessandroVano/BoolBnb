<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('slug', 80)->unique();
            $table->decimal('price', 5, 2)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('rooms')->nullable();
            $table->tinyInteger('max_people')->nullable();
            $table->tinyInteger('bathrooms')->nullable();
            $table->smallInteger('square_meters')->nullable();
            $table->text('address')->nullable();
            $table->decimal('latitude', 8, 6 )->nullable();
            $table->decimal('longitude', 9, 6 )->nullable();
            $table->text('image')->nullable();
            $table->boolean('visibility')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
      
    }
}
