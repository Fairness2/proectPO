<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function getUsers(Request $request){
        $users = DB::table('users')->select('id', 'name', 'email', 'surname', 'patronymic')->get()->all();
        foreach ($users as &$user){
            $roles = DB::table('roles_user')->where('user_id', $user->id)->select('role_id')->get()->all();
            $user->roles = $roles;
        }
        return $users;
    }

    public function updateUser(Request $request){
        $id = $request->post('id', null);
        if ($id === null)
            return ['succeess' => false];
        $name = $request->post('name', null);
        $surname = $request->post('surname', null);
        $patronymic = $request->post('patronymic', null);
        $email = $request->post('email', null);
        $binds = [];
        if ($name)
            $binds['name'] = $name;
        if ($surname)
            $binds['surname'] = $surname;
        if ($patronymic)
            $binds['patronymic'] = $patronymic;
        if ($email)
            $binds['email'] = $email;
        $res = DB::table('users')->where('id', $id)->update($binds);
        return ['succeess' => (boolean)$res];
    }
}
