<?php

namespace App\Domain\Address\Integration\VieCep;

use Exception;
use Illuminate\Support\Facades\Http;
use App\Domain\Address\Integration\VieCep\Entity\AddressViaCep;
use App\Domain\Address\Integration\VieCep\Entity\AddressViaCepContract;

class ViaCepApi extends ConfigViaCep
{
    public function getAddress(string $cep): AddressViaCepContract
    {
        try{
            $url = $this->getUrl($cep);

            return $this->createAddressViaCep(
                Http::get($url)->json()
            );
        }catch(Exception){
            throw new Exception('Houve uma falha ao tentar encontrar esse cep, tente novamente.');
        }
    }

    /** @param array<string> $res */
    private function returnValue(array $res, string $key): ?string
    {
        if (array_key_exists($key, $res)) {
            return $res[$key] ?? null;
        }

        return null;
    }

    /** @param array<string> $response */
    private function createAddressViaCep(array $response): AddressViaCep
    {
        return new AddressViaCep(
            $this->returnValue($response, "cep"),
            $this->returnValue($response, "logradouro"),
            $this->returnValue($response, "complemento"),
            $this->returnValue($response, "bairro"),
            $this->returnValue($response, "localidade"),
            $this->returnValue($response, "uf"),
            $this->returnValue($response, "ibge"),
            $this->returnValue($response, "gia"),
            $this->returnValue($response, "ddd"),
            $this->returnValue($response, "siafi")
        );
    }
}
