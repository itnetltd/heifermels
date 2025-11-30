<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'code',
        'name',
        'description',
        'unit',
        'data_type',
        'frequency',
        'baseline_value',
        'target_value',
        'is_kpi',
        'is_active',
    ];

    protected $casts = [
        'baseline_value' => 'decimal:2',
        'target_value'   => 'decimal:2',
        'is_kpi'         => 'boolean',
        'is_active'      => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function results()
{
    return $this->hasMany(IndicatorResult::class);
}

}
