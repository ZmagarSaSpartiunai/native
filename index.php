<?php

use Services\Balance\BalanceCalculator;

require_once __DIR__ . '/vendor/autoload.php';

$id = $_GET['id'] ?? null;
try {
    if (is_numeric($id)) {
        $balanceCalculator = new BalanceCalculator();
        $balance = $balanceCalculator->calculateBalance(intval($id));

        echo json_encode(['balance' => $balance]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid user ID']);
    }
} catch (\Throwable $exception) {
    http_response_code($exception->getCode());
    echo json_encode([
        'error' => $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine()
    ]);
}

