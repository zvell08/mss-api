<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Barang extends Model
{
    use HasFactory;

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class);
    }
    public function barangsTransactions(): BelongsToMany
    {
        return $this->belongsToMany(BarangTransactions::class);
    }

}