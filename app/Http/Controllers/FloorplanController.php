<?php

namespace App\Http\Controllers;

use App\Models\Floorplan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FloorplanController extends Controller
{
   public function floorPlanLayout(){
      $data = DB::table('eastwoods_facilities')->select('id', 'facilities', 'floor')->get();

        return view('admin.contents.floorplan')->with(['facilities'=>$data]);
   }

   public function floorPlanLayoutSave(Request $request){
      // dd($request->gridDetails);
      $floorplan = new Floorplan();
      $floorplan->floor = $request->gridDetails['floor'];
      $floorplan->gridSize = $request->gridDetails['gridSize'];
      $floorplan->gridDetails = $request->gridDetails['gridDetails'];
      $floorplan->save();
      return response()->json(['status'=>'success']);
   }

   public function floorPlanLayoutGet(Request $request){
      $floorplans = Floorplan::get();
      // dd($floorplans);

      return view('admin.contents.testfloor')->with(['details'=>$floorplans]);
   }
}
