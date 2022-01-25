<?php
namespace Database\Factories;
/** @var Faker $faker */

use App\Models\Booking;
use App\Models\Company;
use App\Models\Organization;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

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
            'name'=> $this->faker->name(),
            'last_name'=> $this->faker->lastName(),
            'age'=> Str::random(10),
            'number' => $this->faker->bothify('########'),
        ];
    }
}
