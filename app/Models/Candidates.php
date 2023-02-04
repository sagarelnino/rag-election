<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
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
        'hall_id',
        'department_id',
        'fullname',
        'home_district',
        'thumb',
        'votes',
    ];
}
