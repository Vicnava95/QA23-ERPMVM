<?php

namespace App\Http\Controllers;

use App\Todolist;
use Auth;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    public function store($idProject)
    {
        $valorNull = "";
        $user_id = Auth::user()->id;
        //ToDo
        foreach(request()->inputToDo as $item=>$v){
            if(strcmp(request()->inputToDo[$item], $valorNull)!== 0){
                $dataToDo = array(
                    'todoTitle' => request()->inputToDo[$item],
                    'todoComment' => request()->inputToDoComment[$item],
                    'todoDate' => request()->dateToDo[$item],
                    'project_fk' => $idProject,
                    'user_fk' => $user_id,
                    'generalStatus_fk' => 0,
                );
                $todoProject = Todolist::create($dataToDo);
                $todoProject->save();
            }
        }
        return redirect()->back();
    }

    public function update($idToDo)
    {
        $user_id = Auth::user()->id;
        $toDo = TodoList::find($idToDo);
        $toDo->update([
            'todoTitle' => request()->inputToDoUpdate,
            'todoComment' => request()->inputToDoCommentUpdate,
            'todoDate' => request()->dateToDoUpdate,
            'user_fk' => $user_id,
        ]);
        $toDo->save();
        return redirect()->back();
    }

    public function destroy($idToDoProject)
    {
        $toDo = Todolist::find($idToDoProject);
        $toDo->delete();
        return redirect()->back()->with('deleteMessage','The task was deleted');
    }

    public function changeStatusToDo($idToDoProject, $value){
        $toDo = Todolist::find($idToDoProject);
        $toDo->update([
            'generalStatus_fk' => $value
        ]);
        $toDo->save();
    }

    public function addNewToDoImages(){
        /* $dataToDo = array(
            'todoTitle' => request()->titleToDo,
            'todoComment' => request()->inputToDo,
            'todoDate' => request()->dateToDo,
            'project_fk' => $idProject,
            'user_fk' => $user_id,
            'generalStatus_fk' => 0,
        );
        $todoProject = Todolist::create($dataToDo);
        $todoProject->save();
        return view('Project.dropzoneScheduling',compact('todoProject','idProject')); */
    }
}
