<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPenarik extends Model
{
    use HasFactory;
    protected $table = "master_penarik";
    protected $guarded = ['id'];

    // public function wajibpajak() {
    //     return $this->belongsTo(WajibPajak::class, 'id_wp', 'id');
    // }

    // public function users() {
    //     return $this->belongsTo(User::class, 'id_user', 'id');
    // }


}
