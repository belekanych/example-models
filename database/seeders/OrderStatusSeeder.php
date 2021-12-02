<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Pending',
            'In progress',
            'Completed',
            'Cancelled',
        ];

        foreach ($statuses as $status) {
            OrderStatus::firstOrCreate([
                'name' => $status,
            ]);
        }
    }
}
