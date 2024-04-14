<?php

namespace App\Imports;

use App\Models\User;
use App\Models\WajibPajak;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

class WajibPajakImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function headingRow(): int
    // {
    //     return 1;
    // }
    public function model(array $row)
    {

        $wajibpajak = WajibPajak::where('no_sppt', $row['no_sppt'])->where('tahun', $row['tahun'])->first();

        if(!$wajibpajak){
            if (!empty(array_filter($row))) {
                return new WajibPajak([
                    'no_sppt' => $row['no_sppt'] ?? null,
                    'nama' => $row['nama'] ?? null,
                    'tahun' => $row['tahun'] !== null ? date('Y', strtotime($row['tahun'])) :null,
                    'rt' => $row['rt'] ?? null,
                    'rw' => $row['rw'] ?? null,
                    'alamat_pemilik' => $row['alamat_pemilik'] ?? null,
                    'objek_pajak' => $row['objek_pajak'] ?? null,
                    'luas_bumi' => $this->cleanAndConvertToInt($row['luas_bumi']),
                    'luas_bangunan' => $this->cleanAndConvertToInt($row['luas_bangunan']),
                    'pagu_pajak' => $this->cleanAndConvertToInt($row['pagu_pajak']),
                    'nama_penarik' => $row['nama_penarik'] ?? null,
                    // 'id_user' => 1,
                    'status' => $row['keterangan'] ?? 0,
                ]);
            }
        }
        return null;
    }

    private function cleanAndConvertToInt($value)
    {
        $cleanedValue = preg_replace('/[^0-9]/', '', $value);
        return intval($cleanedValue);
    }
}
