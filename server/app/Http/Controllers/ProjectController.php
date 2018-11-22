<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    //

    public function __construct()
    {

    }

    public function getProjects(Request $request){
        $projects = DB::table('projects')->get();
        return $projects;
    }

    public function addProject(Request $request){
        $name = $request->get('name');
        $date_begin = $request->get('date_begin', null);
        $date_end = $request->get('date_end', null);
        $res = DB::table('projects')->insertGetId(['name' => $name, 'date_begin' => $date_begin, 'date_end' => $date_end]);
        return ['id' => $res];
    }

    public function updateProject(Request $request){
        $id = $request->post('id', null);
        if ($id === null)
            return ['succeess' => false];
        $name = $request->post('name', null);
        $date_begin = $request->get('date_begin', null);
        $date_end = $request->get('date_end', null);
        $binds = [];
        if ($name)
            $binds['name'] = $name;
        if ($date_begin)
            $binds['date_begin'] = $date_begin;
        if ($date_end)
            $binds['date_end'] = $date_end;
        $res = DB::table('projects')->where('id', $id)->update($binds);
        return ['succeess' => (boolean)$res];
    }

    public function deleteProject(Request $request){
        $id = $request->get('id', null);
        if ($id === null)
            $res = false;
        else
            $res = DB::table('projects')->where('id', $id)->delete();
        return ['succeess' => $res];
    }
}
