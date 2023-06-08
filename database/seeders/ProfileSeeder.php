<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profilesJson = File::get('database/json/profiles.json');
        $profiles = collect( json_decode($profilesJson) );

        $profiles->each(function ($profile) {
            Profile::create([
                'email'=> $profile->email,
                'firstName'=> $profile->firstName,
                'lastName'=> $profile->lastName,
                'mobile'=> $profile->mobile,
                'city'=> $profile->city,
                'shippingAddress'=> $profile->shippingAddress,
            ]);
        });
    }
}
