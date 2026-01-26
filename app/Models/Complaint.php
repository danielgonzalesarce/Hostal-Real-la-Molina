<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    protected $fillable = [
        'claimant_name',
        'claimant_dni',
        'claimant_phone',
        'claimant_email',
        'claimant_address',
        'complaint_description',
        'status',
        'response',
        'response_date',
        'user_id',
    ];

    protected $casts = [
        'response_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pendiente',
            'in_progress' => 'En Proceso',
            'resolved' => 'Resuelto',
            'dismissed' => 'Desestimado',
            default => 'Desconocido',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'in_progress' => 'blue',
            'resolved' => 'green',
            'dismissed' => 'red',
            default => 'gray',
        };
    }
}
