<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['user_id'];

    public function topUps(): HasMany
    {
        return $this->hasMany(TopUp::class);
    }

    public function parents(): BelongsTo
    {
        return $this->belongsTo(Parents::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function scopeWithParent($query)
    {
        $query->addSelect([
            'parent' => Parents::select('nama_ayah')
                ->whereColumn('id', $this->getTable() . '.parent_id')
                ->take(1)
        ]);
    }
}