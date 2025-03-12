<?php

namespace PizzaApp\Models;

use PizzaApp\Interfaces\PizzaInterface;

abstract class Pizza implements PizzaInterface {
  protected string $type;
  protected float $basePrice;

  public function getType(): string {
    return $this->type;
  }

  public function getBasePrice(): float {
    return $this->basePrice;
  }
}
