<?php

namespace App;

use App\Cart\Item;
use App\Cart\ShoppingCart;
use App\Order\Order;
use App\Invoice\TextInvoice;
use App\Invoice\PDFInvoice;
use App\Customer\Customer;
use App\Payments\CashOnDelivery;
use App\Payments\CreditCardPayment;
use App\Payments\PaypalPayment;

class Application
{
    public static function run()
    {
        $shoes = new Item('Nike', 'Travis Scott' , 50000);
        $bags = new Item('Gucci', 'Gucci x Supreme' , 100000);

        $shopping_cart = new ShoppingCart();
        $shopping_cart->addItem($shoes, 3);
        $shopping_cart->addItem($bags, 5);
        $customer = new Customer('Dan Isidrei Musni', 'Angeles City Pampanga', 'musni.danisidrei@auf.edu.ph');
        $order = new Order($customer, $shopping_cart);

        $invoice = new PDFInvoice();
        $order->setInvoiceGenerator($invoice);
        $invoice->generate($order);

        $payment = new PaypalPayment('isidreimusni@gmail.com', '123abc');
        $order->setPaymentMethod($payment);
        $order->payInvoice();
    }
}