<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    //

    public function __construct()
    {

    }

    public function getTasks(Request $request){
        $project = $request->get('project', false);
        $id = $request->get('id', false);
        $user = $request->get('user', false);
        $stage = $request->get('stage', false);
        $previous_task = $request->get('previous_task', false);
        $next_task = $request->get('next_task', false);
        $where = [];
        if ($project)
            $where[] = ['project_id', $project];
        if ($id)
            $where[] = ['id', $id];
        if ($user)
            $where[] = ['user_id', $user];
        if ($stage)
            $where[] = ['stage_id', $stage];
        if ($previous_task)
            $where[] = ['previous_task_id', $previous_task];
        if ($previous_task)
            $where[] = ['next_task_id', $next_task];
        $tasks = DB::table('tasks')->where($where)->get();
        return $tasks;
    }

    public function addTask(Request $request){
        $name = $request->get('name');
        $date_begin = $request->get('date_begin', null);
        $date_end = $request->get('date_end', null);
        $description = $request->get('description', null);
        $project_id = $request->get('project_id', null);
        $user_id = $request->get('user_id', null);
        $previous_task_id = $request->get('previous_task_id', null);
        $next_task_id = $request->get('next_task_id', null);
        $stage_id = $request->get('stage_id', null);
        $res = DB::table('tasks')->insertGetId([
            'name' => $name,
            'date_begin' => $date_begin,
            'date_end' => $date_end,
            'description' => $description,
            'project_id' => $project_id,
            'user_id' => $user_id,
            'previous_task_id' => $previous_task_id,
            'next_task_id' => $next_task_id,
            'stage_id' => $stage_id,
        ]);
        return ['id' => $res];
    }

    public function updateTask(Request $request){
        $id = $request->get('id', null);
        if ($id === null)
            return ['succeess' => false];
        $name = $request->get('name', null);
        $date_begin = $request->get('date_begin', null);
        $date_end = $request->get('date_end', null);
        $description = $request->get('description', null);
        $project_id = $request->get('project_id', null);
        $user_id = $request->get('user_id', null);
        $previous_task_id = $request->get('previous_task_id', null);
        $next_task_id = $request->get('next_task_id', null);
        $stage_id = $request->get('stage_id', null);
        $binds = [];
        if ($name)
            $binds['name'] = $name;
        if ($date_begin)
            $binds['date_begin'] = $date_begin;
        if ($date_end)
            $binds['date_end'] = $date_end;
        if ($description)
            $binds['description'] = $description;
        if ($project_id)
            $binds['project_id'] = $project_id;
        if ($user_id)
            $binds['user_id'] = $user_id;
        if ($previous_task_id)
            $binds['previous_task_id'] = $previous_task_id;
        if ($next_task_id)
            $binds['next_task_id'] = $next_task_id;
        if ($stage_id)
            $binds['stage_id'] = $stage_id;
        $res = DB::table('tasks')->where('id', $id)->update($binds);
        return ['succeess' => (boolean)$res];
    }

    public function deleteTask(Request $request){
        $id = $request->get('id', null);
        if ($id === null)
            $res = false;
        else
            $res = DB::table('tasks')->where('id', $id)->delete();
        return ['succeess' => $res];
    }
}
