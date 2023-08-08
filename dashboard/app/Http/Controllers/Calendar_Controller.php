<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Renta;
use App\Machinery;
use Illuminate\View\View;
use DB;

class Calendar_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today_format=date('l dS F Y ');
        $today=date("Y-m-d");
        $like_day=date("Y-m",strtotime($today));
        $next=date("Y-m-d",strtotime($today.' +1 day'));
        $previous=date("Y-m-d",strtotime($today.' -1 day'));
        $re=Renta::with('clientes')->get();
        $machi= DB::table('machineries')->get();
        $tomorrow_rents=DB::table('rentals')->where('dispatch_date','like','%'.$next.'%')->get();
        $condi_rents = DB::table('rentals')->where('dispatch_date','like','%'.$like_day.'%')->get();  // PARA CONDICIONARLO A LAS RENTAS

        


        $rents_today=array();
        $id_rents_today=array();
        $date_outs=array();
        foreach ($condi_rents as $rent){

            if ($today < $rent ->dispatch_date ){

            }elseif($today >= $rent->dispatch_date and $today <= $rent->pick_up_date){
                array_push($id_rents_today,$rent->machine);

                foreach ($machi as $equi){
                    if ($rent->machine==$equi->id_machine){

                        array_push($rents_today,$equi->model);
                        array_push($date_outs,$rent->pick_up_date);


                    }
                }


            }

            else{

            }
        }
        
        $tomorrow=array();
        
        foreach ($tomorrow_rents as $next_day){

                 foreach ($machi as $equi){
                    if ($next_day->machine==$equi->id_machine){

                        array_push($tomorrow,$equi->model);

                    }
                }

        }


        $no_rents_today=array();
        foreach ($machi as $maquin){

            if (in_array($maquin->id_machine,$id_rents_today)){

            }else{
                array_push($no_rents_today, $maquin->model);
            }

        }
        
       
        $value_no_rent=count($no_rents_today);
        $value_rent=count($rents_today);
        $value_next=count($tomorrow);

        return View('DispachCenter.dispatch_center')->with('today',$today)->with('today_format',$today_format)->with('next',$next)->with('previous',$previous)->with('machi',$machi)->with('out',$rents_today)->with('rentals',$re)->with('inyard',$no_rents_today)->with('out',$rents_today)->with('zise_no_rents', $value_no_rent)->with('size_rent',$value_rent)->with('date_out',$date_outs)->with('next_day_rent',$tomorrow)->with('size_next',$value_next);

    }

    public function getAjax ($date_incoming){

        $today=date("Y-m-d",strtotime($date_incoming));
        $like_day=date("Y-m",strtotime($date_incoming));
        $next=date("Y-m-d",strtotime($date_incoming.' +1 day'));
        $previous=date("Y-m-d",strtotime($date_incoming.' -1 day'));
        $today_format=date('l dS F Y ',strtotime($today));
        $re=Renta::with('clientes')->get();
        $machi= DB::table('machineries')->get();
        $tomorrow_rents=DB::table('rentals')->where('dispatch_date','like','%'.$next.'%')->get();
        $condi_rents = DB::table('rentals')->where('dispatch_date','like','%'.$like_day.'%')->get();  // PARA CONDICIONARLO A LAS RENTAS


        $rents_today=array();
        $id_rents_today=array();
        foreach ($condi_rents as $rent){

            if ($today < $rent ->dispatch_date ){

            }elseif($today >= $rent->dispatch_date and $today <= $rent->pick_up_date){
                array_push($id_rents_today,$rent->machine);

                foreach ($machi as $equi){
                    if ($rent->machine==$equi->id_machine){

                        array_push($rents_today,$equi->model);

                    }
                }


            }

            else{

            }
        }
        
        $tomorrow=array();
        
        foreach ($tomorrow_rents as $next_day){

                 foreach ($machi as $equi){
                    if ($next_day->machine==$equi->id_machine){

                        array_push($tomorrow,$equi->model);

                    }
                }

        }


        $no_rents_today=array();
        foreach ($machi as $maquin){

            if (in_array($maquin->id_machine,$id_rents_today)){

            }else{
                array_push($no_rents_today, $maquin->model);
            }

        }

        $value_no_rent=count($no_rents_today);
        $value_rent=count($rents_today);
        $value_next=count($tomorrow);
        return View('DispachCenter.dispatch_center')->with('today',$today)->with('today_format',$today_format)->with('next',$next)->with('previous',$previous)->with('machi',$machi)->with('out',$rents_today)->with('rentals',$re)->with('inyard',$no_rents_today)->with('out',$rents_today)->with('zise_no_rents', $value_no_rent)->with('size_next',$value_next)->with('next_day_rent',$tomorrow)->with('size_rent',$value_rent);
//

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatedelivered($id)
    {
        DB::table('rentals')->where('id', $id)->update(['status_deliver' => 0]);
    }
    public function updatePending($id)
    {
        DB::table('rentals')->where('id', $id)->update(['status_deliver' => 1]);
    }
    public function updatePickup($id)
    {
        DB::table('rentals')->where('id', $id)->update(['status_pickup' => 0]);
    }
    public function updatePending_pickup($id)
    {
        DB::table('rentals')->where('id', $id)->update(['status_pickup' => 1]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$flag)
    {
        if ($flag==1){

            $date_row_deleted= DB::table('rentals')->where('id','=',$id)->get();// si viene de su delivery

        }else{

            $date_row_deleted= DB::table('rentals')->where('id','=',$id)->get();// si viene de su pick_up_date
        }

        $rm_rent=DB::table('rentals')->where('id','=',$id)->delete(); //sacar la fecha de esta row a lemiminar y cuando elim,ine redireccionar a esta fecha
        if($rm_rent){



            if ($flag==1){
                foreach ($date_row_deleted as $reload_date){
//                    return View('DispachCenter.document_contract')->with('like',$reload_date->dispatch_date);
                    return $this->getAjax($reload_date->dispatch_date);
                }


            }else{

                foreach ($date_row_deleted as $reload_date){
//                    return View('DispachCenter.document_contract')->with('like',$reload_date->pick_up_date);
                    return $this->getAjax($reload_date->pick_up_date);
                }
            }

        }
}

}
