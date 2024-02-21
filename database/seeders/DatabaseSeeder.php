<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('kategori')->insert(
            [
                [
                    'id_kategori' => Str::uuid(),
                    'nama_kategori' => "obat batuk"
                ],
                [
                    'id_kategori' => Str::uuid(),
                    'nama_kategori' => "obat pilek"
                ],
                [
                    'id_kategori' => Str::uuid(),
                    'nama_kategori' => "obat meriang"
                ],
            ]
        );

        DB::table('pembayaran')->insert(
            [
                [
                    'id_pembayaran' => Str::uuid(),
                    'nama_pembayaran' => 'cash'
                ],
                [
                    'id_pembayaran' => Str::uuid(),
                    'nama_pembayaran' => 'transfer'
                ],
                [
                    'id_pembayaran' => Str::uuid(),
                    'nama_pembayaran' => 'kredit'
                ],
            ]
        );

        DB::table('user')->insert([
            'id_user' => Str::uuid(),
            'nama_user' => "Surya Rafliansyah",
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'alamat' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis, alias."
        ]);

        DB::table('user')->insert([
            'id_user' => Str::uuid(),
            'nama_user' => "Rafliansyah",
            'username' => 'petugas',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'alamat' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis, alias."
        ]);
    }
}
