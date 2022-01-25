<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Company;
use App\Models\Organization;
use App\Models\PaymentFile;
use App\Models\PaymentFileStatus;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->count(1)->create(['name'=>'Budget']);
        Company::factory()->count(1)->create(['name'=>'Avis']);
        PaymentFileStatus::factory(13)->create();
        Organization::factory(13)->create();
        VoucherStatus::factory(13)->create();
        User::factory(3)->create();
        Booking::factory(13)->create();
        PaymentFile::factory(13)->create();
        Voucher::factory(50)->create();
    }
}
