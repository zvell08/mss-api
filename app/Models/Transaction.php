<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'nominal'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function parents(): BelongsTo
    {
        return $this->belongsTo(Parents::class);
    }
    public function barangs(): BelongsToMany
    {
        return $this->belongsToMany(Barang::class);
    }
}