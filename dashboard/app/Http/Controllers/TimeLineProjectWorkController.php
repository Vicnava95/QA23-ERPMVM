<?php

namespace App\Http\Controllers;

use App\TimeLineProjectWork;
use App\ToDoListImage;
use App\Project;
use Illuminate\Http\Request;

class TimeLineProjectWorkController extends Controller
{
    public function addTimelineProject(Project $project){
        $idProject = $project->id;
        $timeLine = TimeLineProjectWork::create([
            'timeLineTitle' => request('inputTitleTimeline'),
            'timeLineComment' => request('inputCommentTimeline'),
            'timeLineDate' => request('dateTimeline'),
            'project_fk' => $project->id
        ]);
        $timeLine->save();
        return view('Project.dropzoneScheduling',compact('timeLine','idProject')); 
    }

    public function addMoreImageTimeLine($idPro, $idTimeLine){
        $idProject = Project::find($idPro);
        $timeLine = TimeLineProjectWork::find($idTimeLine);
        return view('Project.dropzoneScheduling',compact('timeLine','idProject')); 
    }

    public function updateTimeLine($idTimeLine){
        $timeLine = TimeLineProjectWork::find($idTimeLine);
        $timeLine->update([
            'timeLineTitle' => request('inputTitleTimelineUpdate'),
            'timeLineComment' => request('inputCommentTimelineUpdate'),
            'timeLineDate' => request('dateTimelineUpdate')
        ]);
        $timeLine->save();
        return redirect()->back();
    }

    public function deleteTimeLine($idTimeLine){
        $timeLine = TimeLineProjectWork::find($idTimeLine);
        $imageList = ToDoListImage::where('timeLineWork_fk',$idTimeLine)->get();
        foreach ($imageList as $iList){
            $image = ToDoListImage::find($iList->id);
            $image->delete();
        }
        $timeLine->delete();
        return redirect()->back();
    }
}
