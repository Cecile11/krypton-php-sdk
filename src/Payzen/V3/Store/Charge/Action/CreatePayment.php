<?php
namespace Payzen\V3\Store\Charge\Action;

use \Payzen\Base\StoreBase;

class CreatePayment extends StoreBase
{
    
    /**
     * @var object $customer new Customer creation object
     */
    public $customer;
    
    /**
     * @var string $orderId order reference defined by the merchant
     */
    public $orderId;
    
    /**
     * @var string $country country (upper case ISO 3166-1 alpha-2)
     */
    public $country;
    
    /**
     * @var string $strongAuthenticationState true if strong authentication has been used to register the paiement (3DS, ...)
     */
    public $strongAuthenticationState;
    
    /**
     * @var string $currency currency (upper case ISO 4217)
     */
    public $currency;
    
    /**
     * @var integer $amount amount. should be a positive integer (1234 for 12.34 euro)
     */
    public $amount;
    
    /**
     * @var object $paymentMethodOptions Payment method options
     */
    public $paymentMethodOptions;
    
    /**
     * @var string $paymentMethod previously captured payment method token
     */
    public $paymentMethod;
    
    /**
     * @var object $metadata key/value custom metadata defined by the merchant
     */
    public $metadata;
    
}