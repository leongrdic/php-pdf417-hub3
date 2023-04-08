<?php

namespace Le\PaymentBarcodeGenerator;

class Party
{

    public function __construct(
        public readonly string $name,
        public readonly string $address,
        public readonly string $city,
    )
    {   
    }

}