<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['barang_id', 'student_id'];
}