<?php

namespace Database\Factories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoardFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  protected $model = Board::class;

  public function definition()
  {
    return [
      'title' => $this->faker->text(30),
      'description' => $this->faker->text(100)
    ];
  }
}
