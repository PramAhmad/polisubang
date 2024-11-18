<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('12345678'), 
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $superadmin->assignRole('superadmin');

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'), 
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $admin->assignRole('admin');

        $kepalaLab = User::create([
            'name' => 'Kepala Lab',
            'email' => 'kepalalab@mail.com',
            'password' => Hash::make('12345678'), 
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $kepalaLab->assignRole('kepala_lab');

        $kepalaProdi = User::create([
            'name' => 'Kepala Prodi',
            'email' => 'kepalaprodi@mail.com',
            'password' => Hash::make('12345678'), 
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $kepalaProdi->assignRole('kepala_prodi');

        $sekprodi = User::create([
            'name' => 'Sekprodi',
            'email' => 'sekprodi@mail.com',
            'password' => Hash::make('12345678'), 
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $sekprodi->assignRole('sekprodi');
    }
}
