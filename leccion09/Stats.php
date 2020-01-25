<?php

use \Stripe;

class Stats
{
    protected $stripeApiKey;

    public function __construct($stripeApiKey)
    {
        $this->stripeApiKey = $stripeApiKey;
    }

    public function getChargeList($limit = 100)
    {
        Stripe\Stripe::setApiKey($this->stripeApiKey);
        $charges = Stripe\Charge::all(['limit' => $limit]);
        return $charges;
    }

    public function getCustomerList($limit = 100)
    {
        Stripe\Stripe::setApiKey($this->stripeApiKey);
        $customers = Stripe\Customer::all(['limit' => $limit]);
        return $customers;
    }

    public function getSubscriptionList($limit = 100)
    {
        Stripe\Stripe::setApiKey($this->stripeApiKey);
        $subscriptions = Stripe\Subscription::all(['limit' => $limit]);
        return $subscriptions;
    }

    public function getTotalCustomers($list = [])
    {
        if (!$list) {
            $list = $this->getCustomerList();
        }

        $totalCustomers = 0;

        foreach ($list->autoPagingIterator() as $customer) {
            $totalCustomers += 1;
        }

        return $totalCustomers;
    }

    public function getTotalSubscriptions($list = [])
    {
        if (!$list) {
            $list = $this->getSubscriptionList();
        }

        $totalSubscriptions = [
            'active' => 0,
            'inactive' => 0
        ];

        foreach ($list->autoPagingIterator() as $sub) {
            if ($sub->active) {
                $totalSubscriptions['active'] += 1;
            } else {
                $totalSubscriptions['inactive'] += 1;
            }
        }

        return $totalSubscriptions;
    }

    public function getTotalAmount($list = [])
    {
        if (!$list) {
            $list = $this->getChargeList();
        }

        $totalAmount = [
            'paid' => 0,
            'failed' => 0
        ];

        foreach ($list->autoPagingIterator() as $charge) {
            if ($charge->paid) {
                $amount = $charge->amount-$charge->amount_refunded;
                $totalAmount['paid'] += $amount;
            } else {
                $totalAmount['failed'] += $charge->amount;
            }
        }

        if ($totalAmount['paid'] > 0) {
            $totalAmount['paid'] = $totalAmount['paid']/100;
        }

        if ($totalAmount['failed'] > 0) {
            $totalAmount['failed'] = $totalAmount['failed']/100;
        }

        return $totalAmount;
    }
}
?>
