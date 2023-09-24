<?php

namespace App\Http\Controllers;

use App\Events\UpdateSystem;
use App\Models\EastwoodsFacilities;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    // public function facilties
    public function facilities(Request $request){
        $facilities = EastwoodsFacilities::get();
        return view('admin.contents.facilities')->with(['facilities'=>$facilities]);
    }

    public function facilitiesManage(Request $request)
    {
        // dd($request);
        $facilities = array_map('strtolower', $request->input('facilities', []));
        $operation_hours = array_map('strtolower', $request->input('operation_hours', []));
        $selected_floor = array_map('strtolower', $request->input('selected_floor', []));

        $ids = $request->input('ids', []);
        $req = $request->input('action');
        // dd($req);
        $insertedNotif = []; // Initialize an array to store inserted products
        $actionText = '';
        $actionType = '';
        $actionName = '';
        $tableUpdates = [];

        if ($facilities) {
            // dd('true');
            for ($i = 0; $i < count($facilities); $i++) {
                switch ($req) {
                    case 'add':
                        $input = EastwoodsFacilities::create(['facilities' => $facilities[$i], 'operation_time' => $operation_hours[$i], 'floor' => $selected_floor[$i]]);
                        $insertedNotif[] = $input;
                        $actionText = 'Added';
                        $actionType = 'success';
                        $actionName = "Facilities";
                       
                        break;
                    case 'update':
                        $input = EastwoodsFacilities::where('id', $ids[$i])->first();
                        if ($input) {
                            if ($input->facilities !== $facilities[$i]) {
                                $input->facilities = $facilities[$i];
                            }
                            if ($input->operation_time !== $operation_hours[$i]) {
                                $input->operation_time = $operation_hours[$i];
                            }
                            if ($input->floor !== $selected_floor[$i]) {
                                $input->floor = $selected_floor[$i];
                            }
                            if ($input->isDirty()) {
                                $input->save();
                                $insertedNotif[] = $input;
                                $actionText = 'Updated';
                                $actionType = 'success';
                                $actionName = "Facilities";
                            }
                        }
                        break;

                    // case 'destroy_t':
                    //     // dd('true');
                    //     // Convert the "ids" string into an array
                    //     $idsArray = explode(",", $ids[0]);
                    //     // Use Eloquent to delete records based on the IDs
                    //     EastwoodsFacilities::whereIn('id', $idsArray)->delete();
                    //     $insertedNotif[] = $idsArray;
                    //     $actionText = 'Deleted';
                    //     $actionType = 'success';
                    //     $actionName = "Teacher";
                    //     break;

                    
                    default:
                        # code...
                        break;
                }
            }
        }
        // Build the success message
        $message = 'Successfully ' . $actionText . ' ' . count($insertedNotif) .' '.$actionName. ' record(s)!';
        // Prepare the toast notification data
        $notification = [
            'status' => $actionType,
            'message' => $message,
        ];
        // Convert the notification to JSON
        $notificationJson = json_encode($notification);

        $tableUpdates = "Maintenance Notice!.The system will be temporarily unavailable for improvements!!. Sorry for any inconvenience.! Thank you for your patience! Countdown!!! 3.! 2.! 1.!. 
        ";
        // for static response only 
        // event(new UpdateSystem($tableUpdates));
        // Redirect back with a success message and the inserted products
        return back()->with('notification', $notificationJson);
    }
}
