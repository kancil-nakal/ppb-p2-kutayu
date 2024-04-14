<?php

namespace App\Http\Controllers;

use App\Imports\MasterPenarikImport;
use App\Models\MasterPenarik;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MasterPenarikController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {

            $data = MasterPenarik::join('users', 'master_penarik.id_user', '=', 'users.id')->get();

            return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
        }

        $data = [
            'title' => 'Master Penarik',
            'penarik' => MasterPenarik::join('users', 'master_penarik.id_user', '=', 'users.id')->get()
        ];
        return view('admin.pages.penarik.index',compact('data'));
    }

    public function import(Request $request) {
        try {
            $file = $request->file('file');
            Excel::import(new MasterPenarikImport, $file);
            return redirect()->route('penarik.index')->with('success', 'Master Data berhasil diimport.');
        } catch (\Throwable $th) {
            return redirect()->route('penarik.index')->with('error', 'Terjadi kesalahan saat menambahkan setoran: ' . $th->getMessage());
        }
    }
}
