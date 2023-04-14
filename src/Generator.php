<?php

namespace Le\PaymentBarcodeGenerator;

use Le\PDF417\{PDF417, Renderer\RendererInterface, Renderer\SvgRenderer};

class Generator
{

    public function __construct(
        public PDF417 $pdf417 = new PDF417(),
        public RendererInterface $renderer = new SvgRenderer([ 'color' => 'black' ]),
    )
    {
        // HUB3 spec requirements
        $this->pdf417->setSecurityLevel(4);
        $this->pdf417->setColumns(9);
    }

    public function render(Data $data): string
    {
        $content = $this->generateContent($data);
        $encoded = $this->pdf417->encode($content);
        return $this->renderer->render($encoded);
    }

    private function generateContent(Data $data): string
    {
        $parts = [];
        $parts[] = 'HRVHUB30';

        $parts[] = strtoupper($data->currency);
        $parts[] = str_pad($data->amount, 15, '0', STR_PAD_LEFT);

        $parts[] = mb_strimwidth($data->payer->name, 0, 30);
        $parts[] = mb_strimwidth($data->payer->address, 0, 27);
        $parts[] = mb_strimwidth($data->payer->city, 0, 27);

        $parts[] = mb_strimwidth($data->payee->name, 0, 25);
        $parts[] = mb_strimwidth($data->payee->address, 0, 25);
        $parts[] = mb_strimwidth($data->payee->city, 0, 27);

        $parts[] = $data->iban;
        $parts[] = $data->model;
        $parts[] = $data->reference;

        $parts[] = strtoupper($data->code);
        $parts[] = mb_strimwidth($data->description, 0, 35);
        $parts[] = '';

        return implode("\n", $parts);
    }

}