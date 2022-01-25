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


class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        return [
            'organization_type_id' => null,
            'name' => $this->faker->company()
        ];
    }
}
