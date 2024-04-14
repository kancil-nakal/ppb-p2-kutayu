<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $url = config('app.url');
        $urlSplit = explode(".", $url);
        $domainEmail = $urlSplit[1].".".end($urlSplit);

        $users = [
            [
                'name' => 'ADMINISTRATOR',
                'email' => 'admin@' . $domainEmail,
                'username' => 'admin',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IMAM MAHDI',
                'email' => 'imam.mahdi@' . $domainEmail,
                'username' => 'imammahdi',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LINDA DWI SUSANTI',
                'email' => 'linda.dwisusanti@' . $domainEmail,
                'username' => 'lindadwisusanti',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MUHAMMAD MAMDOH',
                'email' => 'muhammad.mamdoh@' . $domainEmail,
                'username' => 'muhammadmamdoh',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NASIRIN',
                'email' => 'nasirin@' . $domainEmail,
                'username' => 'nasirin',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => 'SAIMIN',
                'email' => 'saimin@' . $domainEmail,
                'username' => 'saimin',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SEPTIAN ALAN MP',
                'email' => 'septian.alan@' . $domainEmail,
                'username' => 'septianalan',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'name' => 'SONO BUDIYANTO',
            //     'email' => 'sono.budiyanto@' . $domainEmail,
            //     'username' => 'sonobudiyanto',
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'email_verified_at' => now(),
            //     'role' => 'user',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'name' => 'SOPANI',
                'email' => 'sopani@' . $domainEmail,
                'username' => 'sopani',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SUSI ALMAIDAH',
                'email' => 'susi.almaidah@' . $domainEmail,
                'username' => 'susi.almaidah',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BALAI DESA',
                'email' => 'balai.desa@' . $domainEmail,
                'username' => 'balaidesa',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('users')->insert($users);

        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@' . $domainEmail,
        //     'username' => 'admin',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'email_verified_at' => now(),
        //     'role' => 'admin',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'User',
        //     'email' => 'user@' . $domainEmail,
        //     'username' => 'user',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'email_verified_at' => now(),
        //     'role' => 'user',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
