<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Renta;
use App\Cliente;
use Illuminate\Support\Facades\Request as Reque;

class Update_Dispatch extends Controller

{
    public function index($id){

        $machi= DB::table('machineries')->get();
        $targ_rent=Renta::with('clientes')->where('id','=',$id)->first();
        $name=$targ_rent->clientes->full_name;
        $addres=$targ_rent->delivery_site;
        $deli_date=date("m/d/Y",strtotime($targ_rent->dispatch_date));
        $pick_date=date("m/d/Y",strtotime($targ_rent->pick_up_date));
        $note=$targ_rent->delivery_note;
        $rent_machi=$targ_rent->machine;
        $rent_id=$targ_rent->id;
        return View('DispachCenter.update_dispatch')->with('target',$name)->with('equip', $machi)->with('addre',$addres)->with('deliv_date', $deli_date)->with('pick_date',$pick_date)->with('note',$note)->with('mach',$rent_machi)->with('id',$rent_id);

    }

    public function update_rental(Request $request){

        $same_id=$request->input('same_id');
        $alter_name=$request->input('alter_name');
        $alter_machine=$request->input('alter_machin');
        $alter_delivery=$request->input('alter_address');
        $alter_start=date("Y-m-d",strtotime(($request->input('alter_start'))));
        $alter_pickup=date("Y-m-d",strtotime(($request->input('alter_pickup'))));
        $alter_notes=$request->input('alter_note');



        if (Cliente::where('full_name', Reque::get($alter_name))->exists()) {
            $id_client=DB::table('clients')->where('full_name', '=', $alter_name)->get();

        }else{
            $id_client = DB::table('clients')->insertGetId(["full_name"=>$alter_name, 'client_address' => $alter_delivery]);
        }

        $mach_id = DB::table('machineries')->select('id_machine')->where('name', '=', $alter_machine)->get();

        foreach ($mach_id as $post) {

            $maquina_id = $post->id_machine;
        }

        if (empty($request->input('alter_note'))){

            $alter_notes='No notes';

        }







        $rent = Renta::find($same_id);
        $rent->machine=$maquina_id;
        $rent->client=$id_client;
        $rent->delivery_site=$alter_delivery;
        $rent->dispatch_date=$alter_start;
        $rent->pick_up_date=$alter_pickup;
        $rent->delivery_note=$alter_notes;
        $rent->save();

         return redirect()->action('Calendar_Controller@index');






    }
}
