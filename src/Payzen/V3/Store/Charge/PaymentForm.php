<?php
namespace Payzen\V3\Store\Charge;

use \Payzen\Base\StoreBase;

class PaymentForm extends StoreBase
{
    
    /**
     * @var string $formToken related formToken
     */
    public $formToken;
    
    /**
     * @var string $redirectUrl Url where to redirect your customer if you want to manage it yourself
     */
    public $redirectUrl;
    
    /**
     * @var string $_type object type name
     */
    public $_type;
    
}