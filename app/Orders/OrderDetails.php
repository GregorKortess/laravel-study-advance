<?php

namespace App\Orders;

use App\Billing\PaymentGatewayContract;

class OrderDetails
{
    private $paymentGateway;

    public function __construct(PaymentGatewayContract $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;

    }


    public function all()
    {
        $this->paymentGateway->setDiscount(5);

        return [
            'name' => 'Gregor',
            'address' => 'Test street 220',
        ];
    }
}