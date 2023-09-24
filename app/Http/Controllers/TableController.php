<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function tables(Request $request){
        $tableName = $request->query('parameter');
        $actions = $request->query('actions');
        $going = $request->query('routes');

        $allColumns = DB::getSchemaBuilder()->getColumnListing($tableName);
        // Columns to exclude (e.g., 'created_at', 'column_to_exclude', 'another_column_to_exclude')
        $columnsToExclude = ['updated_at'];
        // Filter the column names to exclude the specified columns
        $columns = array_diff($allColumns, $columnsToExclude);

        $data = DB::table($tableName)->get();
        // Modify the created_at column format
        foreach ($data as $item) {
            $item->created_at = Carbon::parse($item->created_at)->format('Y-m-d');
        }
        // dd($data);
        return view('admin.contents.table')->with(['columns'=>$columns, 'datas'=>$data, 'title'=>$tableName, 'actions'=>$actions, 'going'=>$going]);
    }

    public function getCreatedAtAttribute($value)
    {
        // Convert the created_at value to the desired format
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    
}
