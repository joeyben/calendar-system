<?php

namespace App\Events\Customers;

use Illuminate\Queue\SerializesModels;

/**
 * Class CustomerCreated.
 */
class CustomerCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $customer;

    /**
     * @param $customer
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
    }
}
