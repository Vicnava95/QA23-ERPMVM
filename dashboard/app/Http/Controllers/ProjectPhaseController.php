<?php

namespace App\Http\Controllers;

use App\ProjectPhase;
use App\Project;
use App\Phase;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectPhaseController extends Controller
{
    public function index(Project $project)
    {
        $phases = $project->phases()->where('project_id',$project->id)->get();
        return view('Phase/show_phases',compact('phases','project'));
    }

    public function create(Project $project)
    {
        return view('Phase.new_phase',compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $valorNull = "";
        //Phases
        if(count(request()->inputPhase) > 0){
            foreach(request()->inputPhase as $item=>$v){
                if(strcmp(request()->inputPhase[$item], $valorNull)!==0){
                    $dataPhase = array(
                        'name_phase' => request()->inputPhase[$item],
                        'text_phase' => request()->inputPhaseComment[$item],
                        'budget_phase' => request()->budgetPhase[$item],
                        'sold_phase' => request()->soldPhase[$item]
                    );
                    $phase = Phase::create($dataPhase);
                    $project->phases()->attach($phase);

                    $pivotTable = DB::table('project_phases')->where('phase_id',$phase->id)->get();
                    //dd($pivotTable);

                    DB::table('project_phases')
                        ->where('id', $pivotTable[0]->id)
                        ->update(['service_id' => request()->inputService[$item]]);
                }
            }
        }
        return redirect()->back(); 
    }

    public function show(Project $project,Phase $phase)
    {
        return view('Phase.phase',compact('project','phase'));
    }

    public function edit(Project $project,Phase $phase)
    {
        return view('Phase.edit_phase',compact('project','phase'));
    }

    public function update(Request $request, Phase $phase )
    {
        //return $phase;
        $phase->update([
            'name_phase' => request('inputPhase'),
            'text_phase' => request('inputPhaseComment'),
            'budget_phase' => request('budgetPhase'),
            'sold_phase' => request('soldPhase')
        ]);

        $pivotTable = DB::table('project_phases')->where('phase_id',$phase->id)->get(); 
        DB::table('project_phases')
            ->where('id', $pivotTable[0]->id)
            ->update(['service_id' => request('inputServiceEdit')]);

        return redirect()->back();
    }

    public function confirm(Project $project, Phase $phase){
        return view('Phase.confirmPhase',compact('project','phase'));
    }

    public function destroy(Phase $phase)
    {
        $phase->delete();
        return redirect()->back();
    }

    public function addMorePhasesAjax($id){
        $allServices = Service::where('generalStatus',1)->get();
        $output = '<div class="row" id="container-'.$id.'">
        <div class="col-11" style="padding-right:5px;">
    <div class="form-group text-center">
            <input class="form-control form-control-sm formModalToDo" type="text" id="inputPhase" name="inputPhase[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Title" required>
            <textarea class="form-control form-control-sm formModalToDo" name="inputPhaseComment[]" id="inputPhaseComment[]" rows="3" placeholder="Description"></textarea>
            <input class="form-control form-control-sm formModalToDo" type="number" id="budgetPhase" name="budgetPhase[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Budget"  min="0" step="0.01" required>
            <input class="form-control form-control-sm formModalToDo" type="number" id="soldPhase" name="soldPhase[]" autocomplete="off" style="margin-bottom: 5px;" placeholder="Sold"  min="0" step="0.01">
            <select class="form-control form-control-sm formModalToDo" id="inputService" style="margin-bottom: 5px;" name="inputService[]">
            <option>Choose a service</option>';
            foreach($allServices as $service)
                        {
                            $output .= 
                            '<option value="'.$service->id.'">'.$service->name_service.'</option>';
                        }
              $output .='</select>';
              $output .= '</div>
                </div>
                <div class="col-1" style="padding-left: 0px;">
                    <span class="badge badge-outline-danger" onclick="deleteInputToDo('.$id.')" style="cursor: pointer; border-color: white;"  href="#addPhase" role="button" aria-expanded="false" aria-controls="collapseExample"><i style="color:red" class="fas fa-times"></i></span>
                </div>
            </div>';

        echo $output;
    }
}
