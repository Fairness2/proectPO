<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StageController extends Controller
{
    //
    public function __construct()
    {

    }

    public function getStages(Request $request){
        $stages = DB::table('stages')->get();
        return $stages;
    }

    public function addStage(Request $request){
        $name = $request->get('name');
        $previous = $request->get('previous', null);
        $next = $request->get('next', null);
        $res = DB::table('stages')->insertGetId(['name' => $name, 'previous' => $previous, 'next' => $next]);
        return ['id' => $res];
    }

    public function updateStage(Request $request){
        $id = $request->post('id', null);
        if ($id === null)
            return ['succeess' => false];
        $name = $request->post('name', null);
        $previous = $request->post('previous', null);
        $next = $request->post('next', null);
        $binds = [];
        if ($name)
            $binds['name'] = $name;
        if ($previous)
            $binds['previous'] = $previous;
        if ($next)
            $binds['next'] = $next;
        $res = DB::table('stages')->where('id', $id)->update($binds);
        return ['succeess' => (boolean)$res];
    }

    public function deleteStage(Request $request){
        $id = $request->get('id', null);
        if ($id === null)
            $res = false;
        else
            $res = DB::table('stages')->where('id', $id)->delete();
        return ['succeess' => $res];
    }
}
