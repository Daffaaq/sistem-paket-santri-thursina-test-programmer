<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuGroup::insert(
            [
                [
                    'name' => 'Dashboard',
                    'icon' => 'fas fa-tachometer-alt',
                    'permission_name' => 'dashboard',
                ],
                [
                    'name' => 'Master Management',
                    'icon' => 'fas fa-cogs', // ikon untuk pengaturan atau manajemen master data
                    'permission_name' => 'master.management',
                ],
                [
                    'name' => 'Transaksi Management',
                    'icon' => 'fas fa-exchange-alt', // ikon yang melambangkan proses transaksi
                    'permission_name' => 'transaksi.management',
                ],
                [
                    'name' => 'Laporan Management',
                    'icon' => 'fas fa-file-alt', // ikon dokumen cocok untuk laporan
                    'permission_name' => 'laporan.management',
                ],
                [
                    'name' => 'Users Management',
                    'icon' => 'fas fa-users',
                    'permission_name' => 'user.management',
                ],
                [
                    'name' => 'Role Management',
                    'icon' => 'fas fa-user-tag',
                    'permisison_name' => 'role.permission.management',
                ],
                [
                    'name' => 'Menu Management',
                    'icon' => 'fas fa-bars',
                    'permisison_name' => 'menu.management',
                ]
            ]
        );
    }
}
