<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'start_date',
        'end_date',
        'coverage',
        'target_households',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'coverage'   => 'array',
    ];

    public function indicators()
{
    return $this->hasMany(\App\Models\Indicator::class);
}

}
