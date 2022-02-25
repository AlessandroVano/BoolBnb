<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Apartment;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Add default apartment data
        $apartments = config('apartments');

        foreach ($apartments as $apartment) {
            $new_apartment = new Apartment();

            $new_apartment->name = $apartment['name'];//
            $new_apartment->slug = Str::slug($new_apartment->name, '-');
            $new_apartment->price = $apartment['price'];//
            $new_apartment->description = $apartment['description'];//
            $new_apartment->rooms = $apartment['rooms'];//
            $new_apartment->max_people = $apartment['max_people'];//
            $new_apartment->bathrooms = $apartment['bathrooms'];
            $new_apartment->square_meters = $apartment['square_meters'];
            $new_apartment->latitude = $apartment['latitude'];
            $new_apartment->longitude = $apartment['longitude'];
            $new_apartment->image = $apartment['image'];//
            $new_apartment->visibility = $apartment['visibility'];

            $new_apartment->save();
        }
    }
}
