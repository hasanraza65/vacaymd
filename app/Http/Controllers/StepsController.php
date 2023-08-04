<?php

namespace App\Http\Controllers;
use App\Models\State;

use Illuminate\Http\Request;

class StepsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->to('/');
    }

    public function chooseState(){ 

        $data = State::all();
        return view('landing.states',compact(['data']));

    }

    public function chooseTreatment(){ 

        if(isset($_GET['state'])){

            $state_id = $_GET['state'];

        }else{

            return redirect()->to('/choose-state');
        }

        $data = State::find($state_id);
        return view('landing.steps',compact(['data','state_id']));

    }
}
