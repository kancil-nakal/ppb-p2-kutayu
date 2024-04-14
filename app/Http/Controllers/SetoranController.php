<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\WajibPajak;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function index() {

        $tahun = WajibPajak::select('tahun')->groupBy('tahun')->orderBy('tahun', 'desc')->get();
        // $setoran = Setoran::where('setoran.status', 1)->join('wajib_pajak', 'setoran.id_wp', '=', 'wajib_pajak.id')->join('master_penarik', 'wajib_pajak.no_sppt', '=', 'master_penarik.no_sppt')->join('users', 'master_penarik.id_user', '=', 'users.id')->orderBy('setoran.created_at', 'desc')->get();

        $setoran = WajibPajak::select('wajib_pajak.*','users.name as penarik')->where('status', 1)->join('master_penarik', 'wajib_pajak.no_sppt', '=', 'master_penarik.no_sppt')->join('users', 'master_penarik.id_user', '=', 'users.id')->orderBy('wajib_pajak.updated_at', 'desc')->get();

        $wajibpajak = WajibPajak::select('wajib_pajak.*','users.name as penarik')->where('status', 0)->join('master_penarik', 'wajib_pajak.no_sppt', '=', 'master_penarik.no_sppt')->join('users', 'master_penarik.id_user', '=', 'users.id')->orderBy('tahun', 'desc')->get();

        $data = [
            'title' => 'Setoran',
            'setoran' => $setoran,
            'tahun' => $tahun,
            'wajibpajak' => $wajibpajak
        ];

        return view('admin.pages.setoran.index',compact('data'));
    }

    public function getdatabysppt(Request $request) {
        $no_sppt = $request->input('no_sppt');
        $tahun = $request->input('tahun');

        $wajibpajak = WajibPajak::select('wajib_pajak.*','users.name as penarik')
                        ->where('wajib_pajak.no_sppt', $no_sppt)->where('tahun', $tahun)->join('master_penarik', 'wajib_pajak.no_sppt', '=', 'master_penarik.no_sppt')->join('users', 'master_penarik.id_user', '=', 'users.id')->first();

        if(isset($wajibpajak) ) {
            $wajibpajak->jumlah_setoran =  'Rp. ' . number_format($wajibpajak->pagu_pajak, 0, ',', '.');
        }

        if(isset($wajibpajak) ) {
            return response()->json(['data'=> $wajibpajak, 'status' => 'success', 'message' => 'SPPT ditemukan']);
        } else {
            return response()->json(['data'=>[], 'status' => 'error', 'message' => 'Data Tidak Ditemukan']);
        }

    }

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'id_wp' => 'required',
                'tgl_setoran' => 'required',
            ]);
            // dd($validatedData);

            WajibPajak::where('id', $validatedData['id_wp'])->update([
                'status' => 1,
                'tgl_setoran' => $validatedData['tgl_setoran'],
                'setoran_by' => auth()->user()->id,
                'updated_at' => now()
            ]);


            return redirect()->route('setoran.index')->with('success', 'Setoran Berhasil');

            // if(empty($isSetoran)) {
            //     $setoran = Setoran::create($validatedData);

            //     if($setoran) {
            //     } else {
            //         return redirect()->route('setoran.index')->with('error', 'Setoran Gagal');
            //     }
            // } else {
            //     return redirect()->route('setoran.index')->with('error', 'SPPT ini sudah terdapat setoran');
            // }


        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan setoran: ' . $th->getMessage());
        }
    }
}
