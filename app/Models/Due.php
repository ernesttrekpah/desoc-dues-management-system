<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Due extends Model
{
    protected $fillable = [
        'academic_year_id',
        'level_id',
        'amount',
        'status',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
