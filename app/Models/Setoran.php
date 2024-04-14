<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;
    protected $table = "setoran";
    protected $guarded = ['id'];

    public function wajibpajak() {
        return $this->belongsTo(WajibPajak::class, 'id_wp', 'id');
    }
}
