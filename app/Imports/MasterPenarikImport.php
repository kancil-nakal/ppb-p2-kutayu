<?php

namespace App\Imports;

use App\Models\MasterPenarik;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterPenarikImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $penarik = $row['nama_penarik'];
        $users = User::where('name', 'LIKE', "%$penarik%")->first();

        $master = MasterPenarik::where('no_sppt', $row['no_sppt'])->first();

        if(!$master) {
            if (!empty(array_filter($row))) {
                return new MasterPenarik([
                    'no_sppt' => $row['no_sppt'],
                    'id_user' => $users->id
                ]);
            }
        }
        return null;
    }
}
