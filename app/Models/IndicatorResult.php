<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicatorResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'indicator_id',
        'period_date',
        'period_label',
        'value',
        'value_text',
        'comment',
        'created_by',
    ];

    protected $casts = [
        'period_date' => 'date',
        'value'       => 'decimal:2',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
