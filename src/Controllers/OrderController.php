<?php

namespace PizzaApp\Controllers;

use PizzaApp\Models\{Pizza, PepperoniPizza, CountryPizza, HawaiianPizza, MushroomPizza};
use PizzaApp\Services\PriceCalculator;
use PizzaApp\Database\Connection;

class OrderController {
  private PriceCalculator $calculator;

  public function __construct() {
    $this->calculator = new PriceCalculator();
  }

  public function createOrder(array $data): array {
    $pizza = $this->getPizzaInstance($data['pizza_type']);
    $sizeId = (int) $data['size'];
    $sauceId = (int) $data['sauce'];


    $totalPrice = $this->calculator->calculateTotalPrice($pizza, $sizeId, $sauceId);

    $this->saveOrderToDatabase($pizza, $sizeId, $sauceId, $totalPrice);

    return [
      'ingredients' => $this->buildIngredients($pizza, $sizeId, $sauceId),
      'total_price' => $totalPrice,
    ];
  }

  public function getPizzaInstance(string $type): Pizza {
    return match ($type) {
      'Пепперони' => new PepperoniPizza(),
      'Деревенская' => new CountryPizza(),
      'Гавайская' => new HawaiianPizza(),
      'Грибная' => new MushroomPizza(),
      default => throw new \InvalidArgumentException('Неверный тип пиццы'),
    };
  }

  private function saveOrderToDatabase(Pizza $pizza, int $sizeId, int $sauceId, float $price): void {
    $db = Connection::getInstance()->getConnection();

    $sql = <<<SQL
      INSERT INTO orders
      SET
        pizza_id = ?,
        size_id = ?,
        sauce_id = ?,
        total_price_byn = ?
    SQL;

    $stmt = $db->prepare($sql);
    $stmt->execute([
      $this->getPizzaId($pizza),
      $sizeId,
      $sauceId,
      $price
    ]);
  }

  private function getPizzaId(Pizza $pizza): int {
    $db = Connection::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT id FROM pizzas WHERE pizza_type = ?");
    $stmt->execute([$pizza->getType()]);
    return $stmt->fetchColumn();
  }

  private function buildIngredients($pizza, $sizeId, $sauceId): array {
    $db = Connection::getInstance()->getConnection();
    $sql = <<<SQL
      SELECT size_cm, sauce_name
      FROM pizza_sizes, sauces
      WHERE pizza_sizes.id = {$sizeId}
    SQL;

    return [
      'pizza' => $pizza->getType(),
      'size' => $sizeId,
      'sauce' => '',
    ];
  }
}
