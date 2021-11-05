<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use msztorc\LaravelEnv\Env;

class ConfigController extends Controller
{
    public function step1() {
        return view('config.step1');
    }
    
    public function step2() {
        Artisan::call('config:clear');
        return view('config.step2');
    }

    public function step3() {
        return view('config.step3');
    }
    
    public function configDbCheck(Request $request) {
        $db_query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $user_query = "SELECT user FROM mysql.user WHERE user=?";
        $host_query = "SELECT host FROM mysql.user WHERE user=? and host=?";
        $password_query = "SELECT password FROM mysql.user WHERE user=? and password=?";
        
        if (!DB::select($db_query, [$request->db_name])) {
            return redirect('/step-2')->with('error', 'Please, provide a correct information.');
        } elseif(!DB::select($user_query, [$request->db_user])) {
            return redirect('/step-2')->with('error', 'user not found!');
        } elseif(!DB::select($host_query, [$request->db_user, $request->db_host])) {
            return redirect('/step-2')->with('error', 'host not found!');
        } elseif(!DB::select($password_query, [$request->db_user, $request->db_password]) && !empty($request->db_password)) {
            return redirect('/step-2')->with('error', 'password didn\'t match!');
        } else {
            $env = new ENV();
            $env->setValue('DB_DATABASE', $request->db_name);
            $env->setValue('DB_HOST', $request->db_host);
            $env->setValue('DB_USERNAME', $request->db_user);
            $env->setValue('DB_PASSWORD', $request->db_password ?: "");
            Artisan::call('config:clear');
            return redirect('/step-3');
        }
    }

    public function configFinish(Request $request) {
        Artisan::call('migrate');
        $env = new Env();
        $env->setValue('CONFIG', false);
        Artisan::call('config:clear');
        return redirect('/');
    }

    
    public function configButton() {
        $env = new Env();
        $env->setValue('CONFIG', true);
        Artisan::call('config:clear');
        return redirect('/');
    }
}
