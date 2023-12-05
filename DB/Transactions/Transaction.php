<?php

namespace DB\Transactions;

use DB\ConnectionDb;
use mysqli;

class Transaction
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = ConnectionDb::getConnection();
    }

    /**
     * @param int $userId
     * @return bool|\mysqli_result
     */
    public function getUserTransactions(int $userId)
    {
        $sql = "SELECT * FROM transactions WHERE paid_to = $userId OR paid_by = $userId";

        return $this->db->query($sql);
    }
}
