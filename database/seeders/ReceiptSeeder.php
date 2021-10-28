<?php

namespace Database\Seeders;

use App\Models\Receipt;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $receipts = Receipt::where('prize', 0)->get();
        foreach ($receipts as $receipt) {
            $receipt->code = null;
            $receipt ->save();
        }
    }
}
