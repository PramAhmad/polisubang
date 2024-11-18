<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name' => 'superadmin',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'kepala_lab',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // kepala prododi sek prodi
            [
                'name' => 'kepala_prodi',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // sekprodi
            [
                'name' => 'sekprodi',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
