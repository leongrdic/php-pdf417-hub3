# php-pdf417-hub3

Small wrapper lib around [php-pdf417](https://github.com/leongrdic/php-pdf417) that helps construct
a payment barcode for Croatian banks, based on [HUB3 specification](https://www.hub.hr/hr/format-zapisa-pdf417-2d-bar-koda-prema-hub3-standardu).

Requires PHP 8.1+

## Usage

```php
$data = new \Le\PaymentBarcodeGenerator\Data(
    payer: new \Le\PaymentBarcodeGenerator\Party(
        name: 'Marko Markić',
        address: 'Zagrebačka cesta 1',
        city: 'Zagreb',
    ),
    payee: new \Le\PaymentBarcodeGenerator\Party(
        name: 'Tvrtka d.o.o.',
        address: 'Zagrebačka avenija 1', 
        city: 'Zagreb',
    ),
    iban: 'HR1234567890123456789',
    currency: 'EUR',
    amount: 999, // 9.99
    model: 'HR00',
    reference: '123-4567',
    code: 'COST',
    description: 'Uplata',
);

$generator = new \Le\PaymentBarcodeGenerator\Generator(
    pdf417: new \Le\PDF417\PDF417(),
    renderer: new \Le\PDF417\Renderer\SvgRenderer([
        'color' => 'black',
        'scale' => 5,
    ]),
);

$generator->render($data);
```