<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'participant_uid',
        'full_name',
        'gender',
        'date_of_birth',
        'phone',
        'national_id',
        'province',
        'district',
        'sector',
        'cell',
        'village',
        'is_youth',
        'is_person_with_disability',
        'additional_attributes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_youth' => 'boolean',
        'is_person_with_disability' => 'boolean',
        'additional_attributes' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
