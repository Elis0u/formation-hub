<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormationSession extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'trainer_id', 'start_at', 'end_at', 'location', 'max_capacity'];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime:d-m-Y H:i',
            'end_at' => 'datetime:d-m-Y H:i',
        ];
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'session_id');
    }
}
