<?php

use Illuminate\Database\Seeder;
use App\PaymentStatus;

class PaymentStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$statuses = [            
	        ['id' => 1, 'name' => 'created'],
	        ['id' => 2, 'name' => 'authorized'],
	        ['id' => 3, 'name' => 'captured'],
	        ['id' => 4, 'name' => 'refunded'],
	        ['id' => 5, 'name' => 'failed']
	    ];

        foreach ($statuses as $item) {
		    PaymentStatus::updateOrCreate(['id' => $item['id']], $item);
		}
    }
}
