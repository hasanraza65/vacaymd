<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function index(){

        $data = State::all();
        return view('admin.states.index',compact(['data']));

    }

    public function create(){

        return view('admin.states.create');

    }

    public function edit($id){

        $data = State::find($id);
        return view('admin.states.edit',compact(['data']));

    }

    public function store(Request $request){

        $data = new State();
        $data->create($request->all());

        return redirect('/admin/state')->with('success', 'State created successfully');

    }

    public function update(Request $request, $id){

        $data = State::find($id);
        $data->update($request->all());

        return redirect('/admin/state')->with('success', 'State updated successfully');

    }

    public function destroy($id)
    {
        $data = State::find($id)->delete();

        return response('Deleted');
    }
}
