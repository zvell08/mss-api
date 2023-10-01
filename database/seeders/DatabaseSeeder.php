<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Parents;
use App\Models\Student;
use App\Models\TopUp;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Parents::factory(10)
            ->has(User::factory())
            ->has(Student::factory()->count(3)
                ->has(Wallet::factory())
                ->has(Transaction::factory()->count(10)))
            ->create();

        TopUp::factory(10)->create();
    }
}