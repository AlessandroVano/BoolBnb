<?php

use Illuminate\Database\Seeder;

use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Add all room services
        $services = config('all_service');

        foreach ($services as $service) {
            $new_service = new Service();

            $new_service->name = $service['name'];
            $new_service->icon = $service['icon'];

            $new_service->save();
        };
    }
}
