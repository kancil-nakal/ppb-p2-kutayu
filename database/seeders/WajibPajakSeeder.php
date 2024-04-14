<?php

namespace Database\Seeders;

use App\Models\WajibPajak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WajibPajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WajibPajak::factory(15)->create();
    }
}
