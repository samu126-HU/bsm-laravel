<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //

       
    public function index(Request $request)
    {
        $request->validate([
            'table' => 'required'
        ]);
        if (isset($request->search)) {
            $table = $request->table;
            $columns = DB::getSchemaBuilder()->getColumnListing($table);
            $data = DB::table($request->table)
                ->where(function($query) use ($request, $columns) {
                    foreach($columns as $column) {
                        $query->orWhere($column, 'like', '%' . $request->search . '%');
                    }
                })
                ->get()
                ->toArray();

            return view('admin.data', compact('columns', 'data', 'table'));
        } else {
        $table = $request->table;
        $columns = DB::getSchemaBuilder()->getColumnListing($request->table);
        $data = DB::table($request->table)->get()->toArray();
        return view('admin.data', compact('columns', 'data', 'table'));
        }
    }

    public function modify(Request $request)
    {
        $request->validate([
            'table' => 'required',
            'mode' => 'required',
        ]);
        $mode = $request->mode;
        $table = $request->table;
        if ($mode == 'insert') {
            $columns = DB::getSchemaBuilder()->getColumnListing($table);
            return view('admin.modify', compact('columns', 'table', 'mode'));

        } else if ($mode == 'update') {
            $request->validate([
                'id' => 'required',
            ]);
            $id = $request->id;
            $columns = DB::getSchemaBuilder()->getColumnListing($table);
            $data = DB::table($table)->where('id', $id)->get()->toArray();
            return view('admin.modify', compact('columns', 'data', 'table', 'mode', 'id'));
        } elseif ($mode == 'delete') {
            $request->validate([
                'id' => 'required',
            ]);
            try {
                DB::table($table)->where('id', $request->id)->delete();
                return redirect()->to('/admin')->with('status', 'Adat sikeresen törölve.');
            } catch (\Throwable $th) {
                return redirect()->to('/admin')->with('error', 'Hiba az adat törlése közben.');
            }

        }
        
    }

    public function insert(Request $request)
    {
        $request->validate([
            'table' => 'required',
        ]);
        $data = $request->except('_token', 'table');
        try {
            DB::table($request->table)->insert($data);
            return redirect()->to('/admin')->with('status', 'Adat sikeresen hozzáadva.');
        } catch (\Exception $e) {
            return redirect()->to('/admin')->with('error', 'Hiba az adat hozzáadása közben.');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'table' => 'required',
            'id' => 'required',
        ]);
        $data = $request->except('_token', 'table', 'id');
        try {
            DB::table($request->table)->where('id', $request->id)->update($data);
            return redirect()->to('/admin')->with('status', 'Adat sikeresen frissítve.');
        } catch (\Exception $e) {
            return redirect()->to('/admin')->with('error', 'Hiba az adat frissítése  közben.');
        }


    }

}
