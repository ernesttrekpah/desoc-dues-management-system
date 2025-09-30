<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'name', 'description'];

    // Optional accessor: auto-generate display name
    public function getDisplayNameAttribute()
    {
        return "Level {$this->number}";
    }
}
