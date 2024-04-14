<?php

namespace App\Http\Controllers;

use App\Exports\WajibPajakExport;
use App\Models\User;
use App\Models\WajibPajak;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\WajibPajakImport;
use App\Models\MasterPenarik;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
class WajibPajakController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function data()
    {
        $data = WajibPajak::select('wajib_pajak.*','users.name as penarik')->join('master_penarik', 'wajib_pajak.no_sppt', '=', 'master_penarik.no_sppt')->join('users', 'master_penarik.id_user', '=', 'users.id')->get();
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <form action="" method="POST" style="display: inline-block;">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm("Anda yakin ingin menghapus user ini?")"><i class="bi bi-trash"></i></button>
                                </form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $data->toJson();
    }

    public function index(Request $request)
    {

        // $data = WajibPajak::select('wajib_pajak.*','master_penarik.*','users.name as penarik')->join('master_penarik', 'wajib_pajak.no_sppt', '=', 'master_penarik.no_sppt')->join('users', 'master_penarik.id_user', '=', 'users.id')->orderBy('wajib_pajak.created_at', 'desc')->get();
        // dd($data);

        if ($request->ajax()) {
            $tahun = $request->get('tahun');
            $search = $request->get('search');

            $data = WajibPajak::select('wajib_pajak.*','users.name as penarik')->join('master_penarik', 'wajib_pajak.no_sppt', '=', 'master_penarik.no_sppt')->join('users', 'master_penarik.id_user', '=', 'users.id');

            if($tahun) {
                $data->where('wajib_pajak.tahun', $tahun);
            }
            if ($search) {
                $data->where(function($q) use ($search) {
                    $q->where('wajib_pajak.no_sppt', 'like', '%'.$search.'%')
                    ->orWhere('wajib_pajak.nama', 'like', '%'.$search.'%');
                });
            }


            $data->get();

            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('jumlah_setoran', function($row){
                $jumlah_storan = 'Rp. ' . number_format($row->pagu_pajak, 0, ',', '.');
                return $jumlah_storan;
            })
            ->addColumn('status', function($row){
                $status = $row->status == 0 ? '<span class="badge bg-secondary">belum lunas</span>' : '<span class="badge bg-success">lunas</span>';
                return $status;
            })
            ->addColumn('penarik', function($row){
                return $row->penarik;
            })
            ->addColumn('opsi', function($row){
                $editUrl = route('wajibpajak.edit', $row->no_sppt);
                $deleteUrl = route('wajibpajak.destroy', $row->no_sppt);
                $btn = '<a href="'. $editUrl .'" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <form action="'. $deleteUrl .'" method="POST" style="display: inline-block;">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Anda yakin ingin menghapus user ini?\')"><i class="bi bi-trash"></i></button>
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                    </form>';
                return $btn;
            })
            ->rawColumns(['opsi','status'])
            ->make(true);
        }

        $data = [
            'title' => 'Wajib Pajak',
            'tahun' => WajibPajak::select('tahun')->groupBy('tahun')->orderBy('tahun', 'desc')->get()
        ];

        return view('admin.pages.wajib_pajak.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $data = [
            'title' => 'Wajib Pajak',
            'users' => User::all(),
        ];

        return view('admin.pages.wajib_pajak.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'no_sppt' => 'required',
                'nama' => 'required',
                'tahun' => 'numeric|max_digits:4|required',
                'rt' => 'numeric',
                'rw' => 'numeric',
                'alamat_pemilik' => '',
                'objek_pajak' => 'required',
                'luas_bumi' => 'required|numeric',
                'luas_bangunan' => 'required|numeric',
                'pagu_pajak' => 'required|numeric',
                'id_user' => 'required|numeric',
            ]);

            $wajibPajak = WajibPajak::where('no_sppt', $validatedData['no_sppt'])->where('tahun', $validatedData['tahun'])->first();

            $penarik = MasterPenarik::where('no_sppt', $validatedData['no_sppt'])->first();

            if(!$wajibPajak) {
                WajibPajak::create([
                    'no_sppt' => $validatedData['no_sppt'],
                    'nama' => $validatedData['nama'],
                    'tahun' => $validatedData['tahun'],
                    'rt' => $validatedData['rt'],
                    'rw' => $validatedData['rw'],
                    'alamat_pemilik' => $validatedData['alamat_pemilik'],
                    'objek_pajak' => $validatedData['objek_pajak'],
                    'luas_bumi' => $validatedData['luas_bumi'],
                    'luas_bangunan' => $validatedData['luas_bangunan'],
                    'pagu_pajak' => $validatedData['pagu_pajak'],
                ]);

                if(!$penarik) {
                    MasterPenarik::create([
                        'no_sppt' => $validatedData['no_sppt'],
                        'id_user' => $validatedData['id_user'],
                    ]);
                } else {
                    MasterPenarik::where('no_sppt', $validatedData['no_sppt'])->update([
                        'id_user' => $validatedData['id_user'],
                    ]);
                }

                DB::commit();

                return redirect()->route('wajibpajak.index')->with('success', 'Wajib Pajak berhasil ditambahkan.');
            } else {
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', 'Wajib Pajak sudah ada');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan wajib pajak: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WajibPajak $wajibPajak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $data = [
            'title' => 'Wajib Pajak',
            'users' => User::all(),
        ];
        $wajibpajak = WajibPajak::select('wajib_pajak.*','master_penarik.id_user')->where('wajib_pajak.no_sppt',$id)->join('master_penarik', 'wajib_pajak.no_sppt', '=', 'master_penarik.no_sppt')->firstOrFail();

        return view('admin.pages.wajib_pajak.edit',compact('data','wajibpajak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'no_sppt' => 'required',
                'nama' => 'required',
                'tahun' => 'numeric|max_digits:4|required',
                'rt' => 'numeric',
                'rw' => 'numeric',
                'alamat_pemilik' => '',
                'objek_pajak' => 'required',
                'luas_bumi' => 'required|numeric',
                'luas_bangunan' => 'required|numeric',
                'pagu_pajak' => 'required|numeric',
                'id_user' => 'required|numeric',
            ]);


            WajibPajak::where('id',$id)->update([
                'nama' => $validatedData['nama'],
                'tahun' => $validatedData['tahun'],
                'rt' => $validatedData['rt'],
                'rw' => $validatedData['rw'],
                'alamat_pemilik' => $validatedData['alamat_pemilik'],
                'objek_pajak' => $validatedData['objek_pajak'],
                'luas_bumi' => $validatedData['luas_bumi'],
                'luas_bangunan' => $validatedData['luas_bangunan'],
                'pagu_pajak' => $validatedData['pagu_pajak'],
            ]);

            MasterPenarik::where('no_sppt', $validatedData['no_sppt'])->update([
                'id_user' => $validatedData['id_user'],
            ]);
            DB::commit();

            return redirect()->route('wajibpajak.index')->with('success', 'Wajib Pajak berhasil diubah.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengubah wajib pajak: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $wajibpajak = WajibPajak::where('no_sppt', $id)->firstOrFail();

        $wajibpajak->delete();

        return redirect('/wajibpajak')->with('success', 'Wajib Pajak berhasil dihapus.');
    }


    public function export () {

        return Excel::download(new WajibPajakExport(), 'PBB-P2.xlsx');
    }
    public function import() {

        $data = [
            'title' => 'Wajib Pajak',
        ];
        return view('admin.pages.wajib_pajak.import',compact('data'));
    }

    public function import_data(Request $request) {
        try {
            $file = $request->file('file');

            Excel::import(new WajibPajakImport, $file);
            return redirect()->route('wajibpajak.index')->with('success', 'Wajib Pajak berhasil diimport.');
        } catch (\Throwable $th) {
            return redirect()->route('wajibpajak.import')->with('error', 'Terjadi kesalahan saat menambahkan setoran: ' . $th->getMessage());
        }
    }
}
