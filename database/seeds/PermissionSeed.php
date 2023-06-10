<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // Permissiion for Admin
        Permission::create([
            'name'  =>  'data_master_manage'
        ]);
        Permission::create([
            'name'  =>  'users_manage'
        ]);
        //  Permission for Pinjaman
        Permission::create([
            'name'  =>  'create_pinjaman'
        ]);
        Permission::create([
            'name'  =>  'delete_pinjaman'
        ]);
        Permission::create([
            'name'  =>  'edit_pinjaman'
        ]);
        Permission::create([
            'name'  =>  'approval_pinjaman_bendahara'
        ]);
        Permission::create([
            'name'  =>  'approval_pinjaman_ketua'
        ]);
        Permission::create([
            'name'  =>  'reject_pinjaman_bendahara'
        ]);
        Permission::create([
            'name'  =>  'reject_pinjaman_ketua'
        ]);
        Permission::create([
            'name'  =>  'show_pinjaman'
        ]);
        Permission::create([
            'name'  =>  'approval_pembayaran_bendahara'
        ]);
        Permission::create([
            'name'  =>  'reject_pembayaran_bendahara'
        ]);
    }
}
