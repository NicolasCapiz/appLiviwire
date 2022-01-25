<?php
namespace Database\Factories;
/** @var Faker $faker */

use App\Models\Booking;
use App\Models\Company;
use App\Models\Organization;
use App\Models\PaymentFile;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


class VoucherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voucher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        $booking_base_rate =$this->faker->randomFloat(15);
        $booking_taxes =$this->faker->randomFloat(15);
        $gross_amount  =$this->faker->numberBetween($min = 500, $max = 16000);
        $gsa_comission_amount  =$this->faker->randomFloat(15);

        return [
            'booking_id' => function () {
                return Booking::all()->random();
            },
            'company_id' => function () {
                return Company::all()->random();
            },
            'user_id' => function () {
                return User::all()->random();
            },
            'organization_id' => function () {
                return Organization::all()->random();
            },
            'gsa_organization_id' => function () {
                return Organization::all()->random();
           },
            'voucher_status_id' => function () {
                return VoucherStatus::all()->random();
            },
            'payment_file_id' => function () {
                return PaymentFile::all()->random();
            },
            'booking_base_rate' => $booking_base_rate,
            'booking_taxes' => $booking_taxes,
            'booking_total' => $booking_taxes + $booking_base_rate,
            'gsa_comission_amount' => $gsa_comission_amount,
            'gsa_comission_rate' => $this->faker->numberBetween($min = 0, $max = 16000),
            'gsa_taxes_included' => $this->faker->numberBetween(1,20),
            'account'=> $this->faker->name(),

            'abg_net_amount' => $gross_amount - $gsa_comission_amount,

            'number' => $this->faker->bothify('??#########'),

            'past_due' => $this->faker->numberBetween(0,1),
            'iata_code' => $this->faker->bothify('???????#'),
            'gross_amount' => $gross_amount

        ];
    }
}
