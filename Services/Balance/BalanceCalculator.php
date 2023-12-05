<?php

namespace Services\Balance;

use DB\Transactions\Transaction;

class BalanceCalculator
{
    /**
     * @param int $userId
     * @return float
     */
    public function calculateBalance(int $userId): float
    {
        $transactions = new Transaction();
        $userTransactions = $transactions->getUserTransactions($userId);

        $balance = 0.0;
        foreach ($userTransactions as $transaction) {
            if ($transaction['paid_to'] == $userId) {
                $balance += $transaction['amount'];
            } else {
                $balance -= $transaction['amount'];
            }
        }

        return $balance;
    }
}
