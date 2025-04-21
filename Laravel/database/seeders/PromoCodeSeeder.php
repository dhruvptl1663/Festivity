<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PromoCode;
use Carbon\Carbon;

class PromoCodeSeeder extends Seeder
{
    public function run(): void
    {
        PromoCode::create([
            'code' => 'WELCOME20',
            'discount_percentage' => 20.00,
            'max_discount_amount' => 1000.00,
            'expiry_date' => Carbon::now()->addMonths(1)
        ]);
    }
}
