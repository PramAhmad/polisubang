<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        
        $menus = [
            [
                'name' => 'Home',
                'route' => 'home',
                'icon' => 'ti ti-layout-dashboard',
                'sequence' => '1.0'
            ],
            [
                'name' => 'User Management',
                'sequence' => '2.0'
            ],
            [
                'name' => 'Role',
                'route' => 'role.index',
                'icon' => 'ti ti-lock-access',
                'sequence' => '2.1',
                'permissions' => [
                    [
                        'name' => 'view role',
                        'guard_name' => 'web'
                    ],
                    [
                        'name' => 'create role',
                        'guard_name' => 'web'
                    ],
                    [
                        'name' => 'edit role',
                        'guard_name' => 'web'
                    ],
                    [
                        'name' => 'delete role',
                        'guard_name' => 'web'
                    ]
                ]
            ],
            [
                'name' => 'User',
                'route' => 'user.index',
                'icon' => 'ti ti-users',
                'sequence' => '2.1',
                'permissions' => [
                    [
                        'name' => 'view user',
                        'guard_name' => 'web'
                    ],
                    [
                        'name' => 'create user',
                        'guard_name' => 'web'
                    ],
                    [
                        'name' => 'edit user',
                        'guard_name' => 'web'
                    ],
                    [
                        'name' => 'delete user',
                        'guard_name' => 'web'
                    ]
                ]
            ]
        ];

        foreach($menus as $m)
        {
            $insertMenu = [
                'name' => $m['name'],
                'route' => $m['route'] ?? null,
                'icon' => $m['icon'] ?? null,
                'sequence' => $m['sequence']
            ];

            $menu = Menu::create($insertMenu);

            if (isset($m['permissions'])) {
                foreach ($m['permissions'] as $p) {
                    $permission = Permission::create(
                        [
                            'name' => $p['name'],
                            'guard_name' => $p['guard_name'] ?? 'web'
                        ]
                    );

                    MenuPermission::create(
                        [
                            'alias' => explode(' ', $p['name'])[0],
                            'menu_id' => $menu->id,
                            'permission_id' => $permission->id
                        ]
                    );
                }
            }
        }
    }
}
