<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'index_number',
        'name',
        'email',
        'phone',
        'level_id',
        'academic_year_id',
        'address',
        'status',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function duesPayments()
    {
        return $this->hasMany(DuesPayment::class);
    }

}
