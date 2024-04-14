<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function wajib_pajak(){
    //     return $this->hasMany(WajibPajak::class, 'id_user', 'id');
    // }

    // public function master_penarik() {
    //     return $this->hasMany(MasterPenarik::class, 'id_user', 'id');
    // }

    public function getRekapSetoran($params = []){
        $tahun = $params['tahun'];

        $condition = '';

        if (isset($params['tahun']) && $params['tahun'] != '') {
            $condition = 'where tahun = ' . $tahun ;
        }

        $query = DB::table('users')
            ->leftJoin(DB::raw('(SELECT master_penarik.id_user,
                            SUM(wajib_pajak.pagu_pajak) as total_baku,
                            COUNT(wajib_pajak.id) as total_sppt
                        FROM master_penarik ' . $condition . '
                        JOIN wajib_pajak ON wajib_pajak.no_sppt = master_penarik.no_sppt
                        GROUP BY id_user) as wajib_pajak_baku'), 'users.id', '=', 'wajib_pajak_baku.id_user')


            ->leftJoin(DB::raw('(SELECT master_penarik.id_user,
                                    SUM(CASE WHEN status = 1 THEN wajib_pajak.pagu_pajak ELSE 0 END) as total_setoran,
                                    COUNT(CASE WHEN status = 1 THEN wajib_pajak.id ELSE NULL END) as total_sppt_setoran
                                FROM master_penarik  ' . $condition . '
                                JOIN wajib_pajak ON wajib_pajak.no_sppt = master_penarik.no_sppt
                                GROUP BY id_user) as wajib_pajak_setoran'), 'users.id', '=', 'wajib_pajak_setoran.id_user')



            ->select('users.name as penarik',
                     'wajib_pajak_baku.total_baku as jml_baku',
                     'wajib_pajak_baku.total_sppt as jml_sppt_baku',
                     'wajib_pajak_setoran.total_setoran as jml_setoran',
                     'wajib_pajak_setoran.total_sppt_setoran as jml_sppt_setoran',
                     DB::raw('IFNULL(wajib_pajak_baku.total_baku, 0) - IFNULL(wajib_pajak_setoran.total_setoran, 0) as selisih_jml_setoran'),
                     DB::raw('IFNULL(wajib_pajak_baku.total_sppt, 0) - IFNULL(wajib_pajak_setoran.total_sppt_setoran, 0) as selisih_jml_sppt'))
            ->get();

            return $query;

    }
}
