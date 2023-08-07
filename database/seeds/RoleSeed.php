<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo('users_manage');
        $role->givePermissionTo('data_master_manage');
        $role->givePermissionTo('delete_pinjaman');

        $role = Role::create(['name' => 'orang_tua']);
        $role->givePermissionTo('create_pinjaman');
        $role->givePermissionTo('create_pembayaran_cicilan');

        $role = Role::create(['name' => 'bendahara']);
        $role->givePermissionTo('approval_pinjaman_bendahara');
        $role->givePermissionTo('reject_pinjaman_bendahara');
        $role->givePermissionTo('approval_pembayaran_bendahara');
        $role->givePermissionTo('reject_pembayaran_bendahara');
        $role->givePermissionTo('show_pinjaman');
        $role->givePermissionTo('edit_pinjaman');

        $role = Role::create(['name' => 'ketua']);
        $role->givePermissionTo('approval_pinjaman_ketua');
        $role->givePermissionTo('reject_pinjaman_ketua');
        $role->givePermissionTo('show_pinjaman');
    }
}