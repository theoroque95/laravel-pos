<?php

namespace App\Traits;

use App\ReceiptLog;
use DB;

trait ReceiptTrait
{
    protected function setReceiptNo() {
        $receipt = DB::table('receipt_logs')->latest()->first();
        $receiptNo = ((int)$receipt->receipt_no) + 1;

        $newReceipt = ReceiptLog::create([
            'receipt_no' => sprintf("%08s", $receiptNo)
        ]);

        return $newReceipt;
    }

    protected function setOrderNo() {
        $sales = DB::table('sales')->latest()->first();
        $orderNo = ((int)$sales->order_no) + 1;

        return sprintf("%08s", $orderNo);
    }
}
