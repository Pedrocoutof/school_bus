<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Attachment;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'neighborhood',
        'city',
        'number',
        'phone',
        'public_place',
        'state',
        'zip_code',
        'complement',
        'school_id',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function fullName(): Attribute {
        return Attribute::make(
            get: fn ($value) => ucwords(strtolower($value)),
            set: fn ($value) => ucwords(strtolower($value))
        );
    }

    protected function status(): Attribute {
        return Attribute::make(
            get: fn($value) => $value === 'active' ? 'Ativo' : 'Desativado',
        );
    }

    public function school(): BelongsTo {
        return $this->belongsTo(School::class);
    }

}
