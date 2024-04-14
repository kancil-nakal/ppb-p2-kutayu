<?php

namespace Database\Seeders;

use App\Models\WajibPajak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MasterPenarikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wajibPajakData = DB::table('wajib_pajak')->get();
        foreach ($wajibPajakData as $data) {
            $randomIdUser = rand(2, 11);

            DB::table('master_penarik')->insert([
                'id_user' => $randomIdUser,
                'no_sppt' => $data->no_sppt,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
