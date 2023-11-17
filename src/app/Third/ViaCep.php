<?php

namespace App\Third;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

final class ViaCep
{
    private const BASE_URI = 'https://viacep.com.br/ws/';

    /**
     * @throws Exception
     */
    public static function findByCep(string $cepNumber): array
    {
        try {
            $cepNumber = preg_replace('/\D/', '', $cepNumber);
            $clientGuzzle = new Client([
                'timeout' => 15,
                'http_errors' => false,
                'base_uri' => self::BASE_URI,
            ]);

            $requestCEP = $clientGuzzle->request('GET', sprintf('%s/json/', $cepNumber));
            $responseCEP = json_decode($requestCEP->getBody(), true);

            if ($responseCEP['erro'] ?? false) {
                throw new Exception(sprintf('O CEP %s não foi encontrado', $cepNumber), 404);
            }

            return [
                'address' => $responseCEP['logradouro'] ?? '',
                'address_complement' => $responseCEP['complemento'] ?? '',
                'address_postal_code' => $responseCEP['cep'] ?? $cepNumber,
                'uf' => $responseCEP['uf'] ?? '',
                'district' => $responseCEP['bairro'] ?? '',
                'city' => $responseCEP['localidade'] ?? '',
            ];
        } catch (GuzzleException $guzzleException) {
            throw new Exception(sprintf('O serviço de busca do CEP: %s, está temporariamente indisponível', $cepNumber), 500, $guzzleException);
        }
    }
}
