<?php

namespace Le\PaymentBarcodeGenerator;

class Data
{

    public function __construct(
        public readonly Party $payer,
        public readonly Party $payee,
        public readonly string $iban,
        public readonly string $currency,
        public readonly int $amount,
        public readonly string $model,
        public readonly string $reference,
        public readonly string $code,
        public readonly string $description,
    )
    {
        if (!verify_iban($iban, true))
            throw new \UnexpectedValueException('invalid IBAN provided');

        if (strlen($currency) !== 3)
            throw new \UnexpectedValueException('invalid currency');

        if (strlen($model) !== 4)
            throw new \UnexpectedValueException('invalid model');
        
        if (strlen($reference) > 22)
            throw new \UnexpectedValueException('reference too long');

        if (strlen($code) !== 4)
            throw new \UnexpectedValueException('invalid code');
    }

}