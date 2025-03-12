<?php

namespace PizzaApp\Interfaces;

interface PizzaInterface {
  public function getType(): string;
  public function getBasePrice(): float;
}
