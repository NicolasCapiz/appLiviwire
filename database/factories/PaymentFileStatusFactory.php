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
use App\Models\VoucherStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


class PaymentFileStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentFileStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->randomElement(['confirmed', 'rejected','pending']),
            'display_order' => $this->faker->numberBetween(),

        ];
    }
}
