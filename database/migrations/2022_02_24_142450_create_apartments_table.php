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
            $table->unsignedSmallInteger('price');
            $table->text('description');
            $table->tinyInteger('rooms');
            $table->tinyInteger('max_people');
            $table->tinyInteger('bathrooms');
            $table->smallInteger('square_meters');
            $table->decimal('latitude', $precision = 8, $scale = 6 );
            $table->decimal('longitude', $precision = 9, $scale = 6 );
            $table->text('image')->nullable();
            $table->boolean('visibility')->default(1);  
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
