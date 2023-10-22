<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Frequently;
use App\Events\UpdateSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EastwoodsFacilities;
use App\Models\Update;

class TeacherController extends Controller
{
    public function teachers()
    {
        // $teachers = Teacher::get();
        $facilities = EastwoodsFacilities::get();
        $teachers = DB::table('teachers')
        ->select('teachers.*', 'f1.facilities AS facilities')
        ->join('eastwoods_facilities AS f1', 'teachers.facilities_id', '=', 'f1.id')
        ->get();

        // dd($teachers);
        return view('admin.contents.teacher')->with(['teachers' => $teachers, 'facilities'=>$facilities]);
    }

    public function teachersManage(Request $request)
    {
        // dd($request);
        $inputs = $request->input('teachers_name', []);
        $inputsPosition = $request->input('teachers_position', []);
        $inputsLocated = $request->input('teachers_located', []);
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
                        $input = Teacher::create(['name' => $inputs[$i], 'position' => $inputsPosition[$i], 'facilities_id' => $inputsLocated[$i]]);
                        $insertedNotif[] = $input;
                        $actionText = 'Added';
                        $actionType = 'success';
                        $actionName = "Teacher";
                        Update::create(['from' => "Teachers Information", 'list' => 'You have added a new information.','status'=>0,'action'=>'added']);
                        break;
                    case 'update':
                        $input = Teacher::where('id', $ids[$i])->first();
                        $located = EastwoodsFacilities::where('facilities', $inputsLocated[$i])->first();
                        // dd($located->id);
                        if ($input && $located) {
                            if ($input->name !== $inputs[$i]) {
                                $input->name = $inputs[$i];
                            }
                            if ($input->position !== $inputsPosition[$i]) {
                                $input->position = $inputsPosition[$i];
                            }
                            if ($input->facilities_id !== $located->id) {
                                $input->facilities_id = $located->id;
                            }
                            if ($input->isDirty()) {
                                $input->save();
                                $insertedNotif[] = $input;
                                $actionText = 'Updated';
                                $actionType = 'success';
                                $actionName = "Teacher";
                                Update::create(['from' => "Teachers Information", 'list' => 'You have updated a new information.','status'=>0, 'action'=>'updated']);
                            }else{
                                $actionType = 'error';
                                $actionName = "Teacher";
                            }
                        }else{
                            $actionType = 'error';
                            $actionName = "Teacher";
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
                        Update::create(['from' => "Teachers Information", 'list' => 'You have deleted information.','status'=>0,'action'=>'deleted']);
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
                        Update::create(['from' => "Facilities Information", 'list' => 'You have deleted information.','status'=>0,'action'=>'deleted']);
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
                        Update::create(['from' => "Frequently Ask Question", 'list' => 'You have deleted information.','status'=>0,'action'=>'deleted']);
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        // Build the success message
        $message = $actionText . ' ' . count($insertedNotif) .' '.$actionName. ' record(s)!';
        // Prepare the toast notification data
        $notification = [
            'status' => $actionType,
            'message' => $message,
        ];
        // Convert the notification to JSON
        $notificationJson = json_encode($notification);

       
        
        // Redirect back with a success message and the inserted products
        return back()->with('notification', $notificationJson);
    }
}
