<?php

namespace Ayvazyan10\Models;

use Illuminate\Database\Eloquent\Model;

class AmeriaBankTransaction extends Model
{
    protected $table = 'ameriabank_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'payment_id',
        'user_id',
        'Amount',
        'ApprovedAmount',
        'ApprovalCode',
        'CardNumber',
        'ClientName',
        'ExpDate',
        'Currency',
        'DateTime',
        'DepositedAmount',
        'Description',
        'MDOrderID',
        'MerchantId',
        'TerminalId',
        'PaymentState',
        'ResponseCode',
        'ProcessingIP',
        'Provider',
    ];

}
