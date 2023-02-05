<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'election_id',
        'type',
        'hall',
        'department',
        'fullname',
        'home_district',
        'thumb',
        'votes',
    ];

    const TYPE_KING = 1;
    const TYPE_QUEEN = 2;

    const candidates = [
        [
            'type' => self::TYPE_KING,
            'hall' => 'Bangabandhu Sheikh Mujibur Rahman Hall',
            'department' => 'Department of Bangla',
            'fullname' => 'ASM Shafi Kamal Biplab',
            'home_district' => 'Natore',
            'thumb' => 'bb_biplob.jpg'
        ],
        [
            'type' => self::TYPE_KING,
            'hall' => 'Mir Mosharraf Hossain Hall',
            'department' => 'Department of Botany',
            'fullname' => 'Md Biplob Hossain',
            'home_district' => 'Thakurgaon',
            'thumb' => 'mh_biplob.jpg'
        ],
        [
            'type' => self::TYPE_QUEEN,
            'hall' => 'Sheikh Hasina Hall',
            'department' => 'Department of Drama & Dramatics',
            'fullname' => 'Shahinur Akter Prity',
            'home_district' => 'Netrokona',
            'thumb' => 'prity.jpg'
        ],
        [
            'type' => self::TYPE_QUEEN,
            'hall' => 'Jahanara Imam Hall',
            'department' => 'Department of Philosophy',
            'fullname' => 'Ponny Khan',
            'home_district' => 'Dhaka',
            'thumb' => 'ponny.jpg'
        ],
    ];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }
}
