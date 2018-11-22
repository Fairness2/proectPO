<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //

    public function __construct()
    {

    }

    public function getRoles(Request $request){
        $roles = DB::table('roles')->get();
        return $roles;
    }

    public function addRole(Request $request){
        $name = $request->get('name');
        $res = DB::table('roles')->insertGetId(['name' => $name]);
        return ['id' => $res];
    }

    public function updateRole(Request $request){
        $id = $request->post('id', null);
        if ($id === null)
            return ['succeess' => false];
        $name = $request->post('name', null);
        $binds = [];
        if ($name)
            $binds['name'] = $name;
        $res = DB::table('roles')->where('id', $id)->update($binds);
        return ['succeess' => (boolean)$res];
    }

    public function deleteRole(Request $request){
        $id = $request->get('id', null);
        if ($id === null)
            $res = false;
        else
            $res = DB::table('roles')->where('id', $id)->delete();
        return ['succeess' => $res];
    }

    public function setRole(Request $request){
        $user = $request->get('user', false);
        $role = $request->get('role', false);
        if (!$user || !$role)
            return ['success' => false];
        $res = DB::table('roles_user')->insert(['user_id' => $user, 'role_id' => $role]);
        return ['success' => $res];
    }

    public function getUserRoles(Request $request){
        $user = $request->get('user', false);
        if (!$user)
            return ['success' => false];
        $res = DB::table('roles_user')->where('user_id', $user)->select('role_id')->get()->all();
        return ['success' => true, 'data' => $res];
    }
}
