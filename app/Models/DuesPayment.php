<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuesPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'due_id',
        'academic_year_id',
        'level_id',
        'date_paid',
        'amount_paid',
        'receipt_number',
        'souvenir_collected',
        'status',
    ];

    protected $casts = [
        'date_paid' => 'date',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function due()
    {
        return $this->belongsTo(Due::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function souvenirs()
    {
        return $this->belongsToMany(Souvenir::class, 'dues_payment_souvenir')
            ->withTimestamps();
    }
}
