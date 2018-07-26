<?php

namespace App\Events\Customers;

use Illuminate\Queue\SerializesModels;

/**
 * Class CustomerUpdated.
 */
class CustomerUpdated
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
