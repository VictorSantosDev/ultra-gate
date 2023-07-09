<?php

namespace App\Domain\Address\Integration\VieCep;

use Exception;

abstract class ConfigViaCep
{
    private const CEP_MODE = '01001000';

    protected $url = null;

    public function __construct()
    {
        $this->url = $this->checkViaCep(config('viaCep.url'));
    }

    private function checkViaCep($url): string
    {
        if(!$url){
            throw new Exception('A conexão com ViaCep não foi estabeleciada.');
        }

        $this->testingViaCep($url);

        return $url;
    }

    private function testingViaCep(string $url): void
    {
        $result = str_replace('{{cep}}',  self::CEP_MODE, $url);
        return;
    }

    public function getUrl(string $cep): mixed
    {
        return str_replace('{{cep}}', $cep, $this->url);
    }
}
