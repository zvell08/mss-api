<?php

use App\Models\Barang;
use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Transaction::class)->constrained();
            $table->foreignIdFor(Barang::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_transaction');
    }
};