<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\PrescriptionMedicines;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Prescription::all();
        
        return view('admin.prescriptions.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prescriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Prescription();
        $data->prescription_name = $request->prescription_name;
        $data->for_problem = $request->for_problem;
        $prescription_image='';

        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                
                  $image = $request->file('file');
                $imageName = time() . '_' . $image->getClientOriginalName();
               
                $destination = '/src/assets/uploads/Prescription/' .  $imageName;
                $request->file->move(public_path('src/assets/uploads/Prescription'), $imageName);
                $fullPath = public_path($destination);
                $prescription_image=$destination;
                
            } else {
                $request->merge(['prescription_image'=> '']);
                return response()->json(['message' => 'Error uploading profile picture. Please try again later.'], 400);
            }
        }
        $data->prescription_image =$prescription_image;
        $data->save();

        for($i=0; $i<count($request->medicine_name); $i++){

            $prescription_medicine = new PrescriptionMedicines();

            $prescription_medicine->medicine_name = $request->medicine_name[$i];
            $prescription_medicine->medicine_times = $request->medicine_times[$i];
            $prescription_medicine->medicine_days = $request->medicine_days[$i];
            $prescription_medicine->prescription_id = $data->id;
            $prescription_medicine->save();

        }

        return redirect('/admin/prescriptions')->with('success', 'Prescription created successfully');
        //return redirect()->back()->with('success', 'Prescription created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Prescription::with('prescriptionMedicines')->find($id);

        return view('admin.prescriptions.edit',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = Prescription::find($id);

        $data->prescription_name = $request->prescription_name;
        $data->for_problem = $request->for_problem;
        $prescription_image=$data->prescription_image;

        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                $image = $request->file('file');
                $imageName = time() . '_' . $image->getClientOriginalName();
               
                $destination = '/src/assets/uploads/Prescription/' .  $imageName;
                $request->file->move(public_path('src/assets/uploads/Prescription'), $imageName);
                $fullPath = public_path($destination);
                $prescription_image=$destination;
                
            } else {
                $request->merge(['prescription_image'=> '']);
                return response()->json(['message' => 'Error uploading profile picture. Please try again later.'], 400);
            }
        }

        $data->prescription_image =$prescription_image;
        $data->update();

        //clearing old medicines
        PrescriptionMedicines::where('prescription_id',$id)->delete();
        //ending clearing
        if($request->medicine_name){
            for($i=0; $i<count($request->medicine_name); $i++){


                $prescription_medicine = new PrescriptionMedicines();
    
                $prescription_medicine->medicine_name = $request->medicine_name[$i];
                $prescription_medicine->medicine_times = $request->medicine_times[$i];
                $prescription_medicine->medicine_days = $request->medicine_days[$i];
                $prescription_medicine->prescription_id = $data->id;
                $prescription_medicine->save();
    
            }
        }
        
        return redirect('/admin/prescriptions')->with('success', 'Prescription updated successfully');
        //return redirect()->back()->with('success', 'Prescription updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Prescription::find($id)->delete();

        return response('Deleted');
    }
}
