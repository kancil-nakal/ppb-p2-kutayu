<?php

namespace App\Http\Controllers;

use App\Exports\RekapExport;
use App\Models\User;
use App\Models\WajibPajak;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;



class RekapController extends Controller
{
    public function index(Request $request) {
        $tahun = $request->get('tahun');

        $users = new User;
        $rekap = $users->getRekapSetoran(['tahun' =>$tahun]);
        $data = [
            'title' => 'Rekap',
            'penarik' => $rekap,
            'tahun' => WajibPajak::select('tahun')->groupBy('tahun')->orderBy('tahun', 'desc')->get(),
            'value_tahun' => $tahun,
        ];

        return view('admin.pages.rekap.index',compact('data'));
    }

    public function export(Request $request) {

        return Excel::download(new RekapExport, 'rekap-bbb.xlsx');
    }
}
