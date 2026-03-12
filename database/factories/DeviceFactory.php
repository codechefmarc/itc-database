<?php

namespace Database\Factories;

use App\Models\ComputerModel;
use App\Models\Pool;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Provides dummy device data for the database.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory {

  /**
   * A randomly selected pool of pools.
   *
   * @var array|null
   */
  private static $poolsPool = NULL;

  /**
   * Current index for cycling through pools.
   *
   * @var int
   */
  private static $currentIndex = 0;

  /**
   * Define the model's default state.
   *
   * @return array
   *   An array of dummy device data.
   */
  public function definition(): array {

    // 90% chance.
    $hasSrjcTag = fake()->numberBetween(1, 10) <= 9;
    // 30% chance.
    $hasSerial = fake()->numberBetween(1, 10) <= 3;

    if (!$hasSrjcTag && !$hasSerial) {
      $hasSerial = TRUE;
    }

    // Pick a random model string and find-or-create the ComputerModel record.
    [$manufacturer, $modelName] = explode(' ', fake()->randomElement([
      'Dell Latitude 9450',
      'Dell Latitude 7350',
      'Dell Latitude 7455',
      'Dell Latitude 7450',
      'Dell Latitude 7650',
      'Dell Latitude 5550',
      'Dell Latitude 5455',
    ]), 2);

    $computerModel = ComputerModel::firstOrCreate(
      [
        'manufacturer' => $manufacturer,
        'model_name' => $modelName,
      ],
      [
        'release_year' => fake()->numberBetween(2018, 2024),
        'purchase_date' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
      ],
    );

    if (self::$poolsPool === NULL) {
      // Get random pools to reuse frequently.
      self::$poolsPool = Pool::inRandomOrder()->take(10)->pluck('id')->toArray();
      // Shuffle the pool for randomness.
      shuffle(self::$poolsPool);
    }

    $poolSize = count(self::$poolsPool);

    // First pass: ensure every pool gets at least one device.
    if (self::$currentIndex < $poolSize) {
      $poolId = self::$poolsPool[self::$currentIndex];
    }
    else {
      // After first pass: random distribution for remaining activities.
      $poolId = fake()->randomElement(self::$poolsPool);
    }

    self::$currentIndex++;

    return [
      'srjc_tag'          => $hasSrjcTag ? fake()->unique()->randomNumber(5) : NULL,
      'serial_number'     => $hasSerial ? fake()->unique()->bothify('#??#??#') : NULL,
      'computer_model_id' => $computerModel->id,
      'pool_id' => $poolId,
    ];
  }

}
