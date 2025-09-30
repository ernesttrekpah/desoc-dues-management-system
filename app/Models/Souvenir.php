<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level_id',
        'academic_year_id',
        'description',
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
        return $this->belongsToMany(DuesPayment::class, 'dues_payment_souvenir')
            ->withTimestamps();
    }

}
