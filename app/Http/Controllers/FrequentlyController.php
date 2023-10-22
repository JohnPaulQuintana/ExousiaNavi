<?php

namespace App\Http\Controllers;

use App\Models\Update;
use App\Models\Frequently;
use Illuminate\Http\Request;

class FrequentlyController extends Controller
{
    public function frequently(){
        $frequentlies = Frequently::get();
        return view('admin.contents.frequently')->with('frequentlies', $frequentlies);
    }
    
    public function frequentlyManage(Request $request){
        //    dd($request);
       $inputs = $request->input('frequently_ask',[]);
       $ids = $request->input('ids',[]);
       $req = $request->input('action');
       $insertedNotif = []; // Initialize an array to store inserted products
       if($inputs){
            for ($i=0; $i < count($inputs); $i++) { 

                switch ($req) {
                    case 'add':
                        $input = Frequently::create(['frequently' => $inputs[$i]]);
                        $insertedNotif[] = $input;
                        Update::create(['from' => "Frequently Ask Question", 'list' => 'You have added a new Question.','status'=>0,'action'=>'added']);
                        break;
                    case 'update':
                        $input = Frequently::where('id', $ids[$i])->first();
                        if($input){
                            if ($input->frequently !== $inputs[$i]) {
                                $input->frequently = $inputs[$i];
                            }
                            if ($input->isDirty()) {
                                $input->save();
                                $insertedNotif[] = $input;
                            }
                            Update::create(['from' => "Frequently Ask Question", 'list' => 'You have updated a new Question.','status'=>0,'action'=>'updated']);
                        }
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
        }
         // Build the success message
         $message = 'Successfully ' . ($req === 'add' ? 'Added' : 'Edited') . ' ' . count($insertedNotif) . ' question(s)!';
         // Prepare the toast notification data
        $notification = [
            'status' => 'success',
            'message' => $message,
        ];
        // Convert the notification to JSON
        $notificationJson = json_encode($notification);

        // Redirect back with a success message and the inserted products
        return back()->with('notification', $notificationJson);
    }
}
