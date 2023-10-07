<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionBarangController extends Controller
{
    public function purchase(Request $request)
    {
        try {
            $student = Student::find($request->input('student_id'));
            $barang = Barang::find($request->input('barang_id'));

            if (!$student || !$barang) {
                throw new \Exception('Siswa atau barang tidak ditemukan.');
            }

            $hargaBarang = $barang->harga;
            $saldo = $student->wallet->amount;

            if ($saldo < $hargaBarang) {
                throw new \Exception('Saldo dompet tidak mencukupi untuk membeli barang ini.');
            }

            $transaction = Transaction::create([
                'student_id' => $student->id,
                'nominal' => -$hargaBarang,
            ]);

            $transaction->barangs()->attach($barang);

            $student->wallet->amount -= $hargaBarang;
            $student->wallet->save();

            return response()->json(['message' => 'Pembelian berhasil', 'transaction' => $transaction], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400); // Kode status 400 untuk pembelian gagal
        }
    }
}