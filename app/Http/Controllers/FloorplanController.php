<?php

namespace App\Http\Controllers;

use App\Models\Update;
use App\Models\Floorplan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FloorplanController extends Controller
{
   public function floorPlanLayout(){
      $data = DB::table('eastwoods_facilities')->select('id', 'facilities', 'floor')->get();

        return view('admin.contents.floorplan')->with(['facilities'=>$data]);
   }

   public function floorPlanLayoutSave(Request $request) {
      try {
          $floorplan = new Floorplan();
          $floorplan->floor = $request->gridDetails['floor'];
          $floorplan->gridSize = $request->gridDetails['gridSize'];
          $floorplan->gridDetails = $request->gridDetails['gridDetails'];
          $floorplan->save();
          Update::create(['from' => "Floor Plan", 'list' => 'You have Added a new layout.','status'=>0,'action'=>'added']);
          return response()->json(['status' => 'success']);
      } catch (\Exception $e) {
          // Handle any exceptions that occur during the save operation
          return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
      }
  }
  

   public function floorPlanLayoutGet(Request $request){
      $floorplans = Floorplan::get();
      // dd($floorplans);

      return view('admin.contents.testfloor')->with(['details'=>$floorplans]);
   }
}
