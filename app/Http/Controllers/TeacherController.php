<?php

namespace App\Http\Controllers;

use App\Events\UpdateSystem;
use App\Models\EastwoodsFacilities;
use App\Models\Frequently;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teachers()
    {
        $teachers = Teacher::get();
        return view('admin.contents.teacher')->with(['teachers' => $teachers]);
    }

    public function teachersManage(Request $request)
    {
        // dd($request);
        $inputs = $request->input('teachers_name', []);
        $inputsPosition = $request->input('teachers_position', []);
        $ids = $request->input('ids', []);
        $req = $request->input('action');
        // dd($req);
        $insertedNotif = []; // Initialize an array to store inserted products
        $actionText = '';
        $actionType = '';
        $actionName = '';
        $tableUpdates = [];

        if ($inputs || $ids) {
            // dd('true');
            for ($i = 0; $i < count($inputs); $i++) {
                switch ($req) {
                    case 'add':
                        $input = Teacher::create(['name' => $inputs[$i], 'position' => $inputsPosition[$i]]);
                        $insertedNotif[] = $input;
                        $actionText = 'Added';
                        $actionType = 'success';
                        $actionName = "Teacher";
                       
                        break;
                    case 'update':
                        $input = Teacher::where('id', $ids[$i])->first();
                        if ($input) {
                            if ($input->name !== $inputs[$i]) {
                                $input->name = $inputs[$i];
                            }
                            if ($input->position !== $inputsPosition[$i]) {
                                $input->position = $inputsPosition[$i];
                            }
                            if ($input->isDirty()) {
                                $input->save();
                                $insertedNotif[] = $input;
                                $actionText = 'Updated';
                                $actionType = 'success';
                                $actionName = "Teacher";
                            }
                        }
                        break;

                    case 'destroy_t':
                        // dd('true');
                        // Convert the "ids" string into an array
                        $idsArray = explode(",", $ids[0]);
                        // Use Eloquent to delete records based on the IDs
                        Teacher::whereIn('id', $idsArray)->delete();
                        $insertedNotif[] = $idsArray;
                        $actionText = 'Deleted';
                        $actionType = 'success';
                        $actionName = "Teacher";
                        break;

                    case 'destroy_ef':
                        // dd('true');
                        // Convert the "ids" string into an array
                        $idsArray = explode(",", $ids[0]);
                        // Use Eloquent to delete records based on the IDs
                        EastwoodsFacilities::whereIn('id', $idsArray)->delete();
                        $insertedNotif[] = $idsArray;
                        $actionText = 'Deleted';
                        $actionType = 'success';
                        $actionName = "Facility";
                        break;

                    case 'destroy_f':
                        // dd('true');
                        // Convert the "ids" string into an array
                        $idsArray = explode(",", $ids[0]);
                        // Use Eloquent to delete records based on the IDs
                        Frequently::whereIn('id', $idsArray)->delete();
                        $insertedNotif[] = $idsArray;
                        $actionText = 'Deleted';
                        $actionType = 'success';
                        $actionName = "Frequently";
                        break;
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

        $tableUpdates = "Maintenance Notice!.The system will be temporarily unavailable for improvements! in 10 seconds!. Sorry for any inconvenience. Maintenance will take about 3-10 seconds!. Thank you for your patience! Countdown!!! 3.! 2.! 1.!. 
        ";
        // for static response only 
        event(new UpdateSystem($tableUpdates));
        // Redirect back with a success message and the inserted products
        return back()->with('notification', $notificationJson);
    }
}
