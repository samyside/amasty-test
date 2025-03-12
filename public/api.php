<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PizzaApp\Controllers\OrderController;

header('Content-Type: application/json');

try {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    throw new RuntimeException("HTTP-метод не поддерживается", 400);
  }

    $controller = new OrderController();
    $response = $controller->createOrder($_POST);

    echo json_encode([
      'status' => 'success',
      'data' => $response,
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (Exception $e) {
  http_response_code(400);
  echo json_encode([
    'status' => 'error',
    'message' => 'Try again later',
    'stack' => $e->getMessage(),
  ], JSON_PRETTY_PRINT);
}
