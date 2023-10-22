<?php

namespace App\Http\Controllers;

use App\Models\Update;
use Illuminate\Http\Request;
use App\Models\Functionality;

class FunctionalityController extends Controller
{
    public function manage(){
        $manageSystem = Functionality::all();
        return view("admin.contents.functionality")->with(['systems'=>$manageSystem]);
    }

    public function update(Request $request){
        // dd($request);
        $action = (int) $request->input('action');
        $updates = Functionality::find($request->id);

       if($action){
            $updates->status = 0;
            $updates->save();
            $message = 'disabled';
            Update::create(['from' => "Functionalities Update", 'list' => 'You have disabled '. $updates->function .' function.','status'=>0,'action'=>'updated']);
       }else{
            $updates->status = 1;
            $updates->save();
            $message = 'enabled';
            Update::create(['from' => "Functionalities Update", 'list' => 'You have enabled '. $updates->function .' function.','status'=>0,'action'=>'updated']);
       }
       $notification = [
        'status' => 'success',
        'message' => $updates->function. ' system is successfully '.$message,
    ];
    // Convert the notification to JSON
    $notificationJson = json_encode($notification);
    
    // Redirect back with a success message and the inserted products
    return back()->with('notification', $notificationJson);
    }
}
