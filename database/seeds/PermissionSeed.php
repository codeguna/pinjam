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
            'name'  =>  'users_manage',
            'name'  =>  'data_master_manage'
        ]);
        //  Permission for Pinjaman
        Permission::create([
            'name'  =>  'create_pinjaman',
            'name'  =>  'approval_pinjaman_bendahara',
            'name'  =>  'approval_pinjaman_ketua',
            'name'  =>  'reject_pinjaman',
            'name'  =>  'show_pinjaman']);
    }
}