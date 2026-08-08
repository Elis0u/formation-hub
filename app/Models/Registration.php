<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = ['session_id', 'external_contact_id', 'external_contact_name', 'status'];

    public function session()
    {
        return $this->belongsTo(FormationSession::class, 'session_id');
    }
}
