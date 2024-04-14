<?php

namespace App\Exports;

use App\Models\WajibPajak;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WajibPajakExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return WajibPajak::select('wajib_pajak.no_sppt',
            'nama',
            'tahun',
            'rt',
            'rw',
            'alamat_pemilik',
            'objek_pajak',
            'luas_bumi',
            'luas_bangunan',
            'pagu_pajak',
            'users.name as penarik',
            'status')->join('master_penarik', 'wajib_pajak.no_sppt', '=', 'master_penarik.no_sppt')->join('users', 'master_penarik.id_user', '=', 'users.id')->get();


    }

    public function headings(): array
    {
        return [
            'No SPPT',
            'Nama',
            'Tahun',
            'RT',
            'RW',
            'Alamat Pemilik',
            'Objek Pajak',
            'Luas Bumi (m2)',
            'Luas Bangunan (m2)',
            'Pagu Pajak (Rp)',
            'Nama Penarik',
            'Keterangan',
        ];
    }
}
