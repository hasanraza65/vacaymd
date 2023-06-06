<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UpSaleItem;

class UpSaleItemController extends Controller
{
    public function index()
    {
        $items = UpSaleItem::all()->groupBy('item_name');
        
        return view('admin.upsaleitems.index',compact(['items']));
    }

    public function create()
    {
        return view('admin.upsaleitems.create');
    }

    public function store(Request $request)
    {

        for($i=0; $i<count($request->treatment); $i++){

            $data = new UpSaleItem();

            $thumbnail_image = '';

            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                    
                    $image = $request->file('file');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                
                    $destination = '/src/assets/uploads/Items/' .  $imageName;
                    $request->file->move(public_path('src/assets/uploads/Items'), $imageName);
                    $fullPath = public_path($destination);
                    $thumbnail_image=$destination;
                    
                } else {
                    $thumbnail_image = null;
                }
            }else {
                $thumbnail_image = null;
            }
            $data->item_name = $request->item_name;
            $data->treatment = $request->treatment[$i];
            $data->item_price = $request->item_price;
            $data->item_description = $request->item_description;
            $data->thumbnail = $thumbnail_image;
            $data->save();

        }
        

        return redirect('/admin/upsaleitems')->with('success', 'Upsale Item created successfully');

    }

    public function edit($id)
    {
        $item = UpSaleItem::find($id);
        $data = UpSaleItem::where('item_name', $item->item_name)->get();

        return view('admin.upsaleitems.edit',compact(['data', 'item']));
    }

    public function update(Request $request, $id)
    {

        //dd($request->all());
        
        UpSaleItem::where('item_name', trim($request->item_name))->delete();

        for($i=0; $i<count($request->treatment); $i++){
            
            $thumbnail_image = '';

            $data = new UpSaleItem();

            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                    
                    $image = $request->file('file');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                
                    $destination = '/src/assets/uploads/Items/' .  $imageName;
                    $request->file->move(public_path('src/assets/uploads/Items'), $imageName);
                    $fullPath = public_path($destination);
                    $thumbnail_image=$destination;
                    
                } else {
                    $thumbnail_image = $request->old_image;
                }
            }else {
                $thumbnail_image = $request->old_image;
            }

            $data->item_name = $request->item_name;
            $data->treatment = $request->treatment[$i];
            $data->item_price = $request->item_price;
            $data->item_description = $request->item_description;
            $data->thumbnail = $thumbnail_image;
            $data->save();

        }

        return redirect('/admin/upsaleitems')->with('success', 'Upsale Item updated successfully');

    }

    public function destroy($id)
    {
        $data = UpSaleItem::find($id)->delete();

        return response('Deleted');
    }
}
