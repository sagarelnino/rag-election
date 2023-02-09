<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'is_active',
        'show_vote',
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
