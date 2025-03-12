<?php

namespace PizzaApp\Services;

use PizzaApp\Models\Pizza;
use PizzaApp\Database\Connection;

class PriceCalculator {
  private $db;

  public function __construct() {
    $this->db = Connection::getInstance()->getConnection();
  }

  public function calculateTotalPrice(Pizza $pizza, int $sizeId, int $sauceId): float {
    $stmt = $this->db->prepare("SELECT price_multiplier FROM pizza_sizes WHERE id = ?");
    $stmt->execute([$sizeId]);
    $sizeMultiplier = $stmt->fetchColumn();

    $stmt = $this->db->prepare("SELECT price_usd FROM sauces WHERE id = ?");
    // $stmt->execute($sauceId);
    $saucePrice = $stmt->fetchColumn();

    return ($pizza->getBasePrice() * $sizeMultiplier) + $saucePrice;
  }
}
