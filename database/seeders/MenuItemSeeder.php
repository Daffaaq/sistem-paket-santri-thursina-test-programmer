<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::insert(
            [
                // id = 1
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard',
                    'permission_name' => 'dashboard',
                    'menu_group_id' => 1,
                ],
                // id = 2
                [
                    'name' => 'Asrama List',
                    'route' => 'master-management/asrama',
                    'permission_name' => 'asrama.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Kategori Paket List',
                    'route' => 'master-management/kategori-paket',
                    'permission_name' => 'kategori-paket.index',
                    'menu_group_id' => 2,
                ],
                // id = 3
                [
                    'name' => ' Paket List',
                    'route' => 'transaksi-management/paket',
                    'permission_name' => 'paket.index',
                    'menu_group_id' => 3,
                ],
                // id = 4
                [
                    // laporan
                    'name' => 'Laporan',
                    'route' => 'laporan-management/laporan',
                    'permission_name' => 'laporan.index',
                    'menu_group_id' => 4,
                ],
                // id = 5
                [
                    'name' => 'Santri List',
                    'route' => 'user-management/santri',
                    'permission_name' => 'santri.index',
                    'menu_group_id' => 5,
                ],
                [
                    'name' => 'User List',
                    'route' => 'user-management/user',
                    'permission_name' => 'user.index',
                    'menu_group_id' => 5,
                ],
                // id = 6
                [
                    'name' => 'Role List',
                    'route' => 'role-and-permission/role',
                    'permission_name' => 'role.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'Permission List',
                    'route' => 'role-and-permission/permission',
                    'permission_name' => 'permission.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'Permission To Role',
                    'route' => 'role-and-permission/assign',
                    'permission_name' => 'assign.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'User To Role',
                    'route' => 'role-and-permission/assign-user',
                    'permission_name' => 'assign.user.index',
                    'menu_group_id' => 6,
                ],
                // id = 7
                [
                    'name' => 'Menu Group',
                    'route' => 'menu-management/menu-group',
                    'permission_name' => 'menu-group.index',
                    'menu_group_id' => 7,
                ],
                [
                    'name' => 'Menu Item',
                    'route' => 'menu-management/menu-item',
                    'permission_name' => 'menu-item.index',
                    'menu_group_id' => 7,
                ],
            ]
        );
    }
}
