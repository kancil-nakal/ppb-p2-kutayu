<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class WajibPajak extends Model
{
    use HasFactory;
    protected $table = "wajib_pajak";
    protected $guarded = ['id'];
    // use Searchable;

    // public function users() {
    //     return $this->belongsTo(User::class, 'id_user', 'id');
    // }

    public function setoran() {
        return $this->hasMany(Setoran::class, 'id_wp', 'id');
    }

    // public function master_penarik(){
    //     return $this->hasMany(MasterPenarik::class, 'id_wp', 'id');
    // }

    public function getSearchResult($search)
    {
        $result = WajibPajak::with('users')->where('nama', 'LIKE', "%$search%")
                 ->orWhere('no_sppt', 'LIKE', "%$search%")
                 ->get();

        return $result;
    }

}
