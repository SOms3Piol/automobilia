<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
      Plan::insert([
        [
            'title' => 'Basic',
            'price' => 0,
            'allowed_ads' => 5
           ],[
            'title' => 'Pro',
            'price' => 80,
            'allowed_ads' => 10
           ]
      ]);
    }
}
