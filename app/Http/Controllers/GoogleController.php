<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended('admin/home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);
                $getId = Auth::User()->id;

                $newUser->assignRole('orang_tua');
                $newUser->givePermissionTo('create_pinjaman');

                $parents            = StudentParent::create([
                    'user_id'       => $getId,
                    'mobile'        => '000000000',
                    'occupation'    => '==Update Pekerjaan==',
                    'address'       => 'Update Alamat'
                ]);

                $students           = Student::create([
                    'parent_id'      => $parents->id,
                    'name'           => 'Update Nama',
                    'nim'           => '000000000',
                    'class_id'      => 1,
                    'address'       => 'Update Alamat'
                ]);

                return redirect()->intended('admin/home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}