<?php

namespace App\Third;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

final class CorreiosCep
{
    private const BASE_URI = 'https://webservice.correios.com.br/DNECWService/rest/';

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

            $requestCEP = $clientGuzzle->request('GET', sprintf('cep/%s', $cepNumber));

            if ($requestCEP->getStatusCode() >= 500 && $requestCEP->getStatusCode() <= 599) {
                throw new Exception(sprintf('O serviço de busca nos correios do CEP: %s, está temporariamente indisponível', $cepNumber), 500);
            }

            $responseCep = json_decode($requestCEP->getBody(), true);

            $responseCeps = $responseCep['ceps'] ?? [];
            if ('OK' !== $responseCep['STATUS'] || count($responseCeps) <= 0) {
                throw new Exception(sprintf('O CEP %s não foi encontrado', $cepNumber), 404);
            }

            $cep = $responseCeps[0] ?? null;
            if (!$cep) {
                throw new Exception(sprintf('O CEP %s não foi encontrado', $cepNumber), 404);
            }

            return array_merge(
                self::splitAddress($cep['ENDERECO'] ?? ''),
                [
                    'address_postal_code' => $cep['CEP'] ?? $cepNumber,
                    'uf' => $cep['UF'] ?? '',
                    'district' => $cep['BAIRRO'] ?? '',
                    'city' => $cep['LOCAL'] ?? '',
                ],
            );
        } catch (GuzzleException $guzzleException) {
            throw new Exception(sprintf('O serviço de busca do CEP: %s, está temporariamente indisponível', $cepNumber), 500, $guzzleException);
        }
    }

    private static function splitAddress(string $address): array
    {
        if (str_contains($address, ' - ')) {
            $newAddress = explode(' - ', $address);

            return [
                'address' => trim(array_shift($newAddress)),
                'address_complement' => trim(implode(' - ', $newAddress)),
            ];
        }

        if (preg_match('/(.*)\((.*)\)+/', $address, $newAddress)) {
            return [
                'address' => trim($newAddress[1] ?? ''),
                'address_complement' => trim($newAddress[2] ?? ''),
            ];
        }

        if (preg_match('/(.*), ([0-9])+/', $address, $newAddress)) {
            return [
                'address' => trim($newAddress[1] ?? ''),
            ];
        }

        return [
            'address' => $address,
        ];
    }
}
