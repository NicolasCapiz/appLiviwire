<?php
namespace Database\Factories;
/** @var Faker $faker */

use App\Models\Booking;
use App\Models\Company;
use App\Models\Organization;
use App\Models\PaymentFile;
use App\Models\PaymentFileStatus;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


class PaymentFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentFile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $inicio = Carbon::createFromTimestamp($this->faker->dateTime->getTimestamp());
        $fin = Carbon::createFromTimestamp($inicio->getTimestamp())->add(new \DateInterval('P5D'));

        return [

            'user_id' => function () {
                return User::all()->random();
            },
            'organization_id' => function () {
                return Organization::all()->random();
            },
            'company_id' => function () {
                return Company::all()->random();
            },
            'payment_file_status_id' => function () {
                return PaymentFileStatus::all()->random();
            },
            'cycle_start'=> $inicio->format('Y-m-d'),
            'cycle_end'=> $fin->format('Y-m-d'),
            'account'=> $this->faker->name(),
        ];
    }
}
