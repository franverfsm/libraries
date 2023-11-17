<?php

namespace App\Services;

use App\Third\CorreiosCep;
use App\Third\ViaCep;
use Exception;
use Illuminate\Support\Facades\Redis;

final class CepService
{
    /**
     * @throws Exception
     */
    public static function findByCep(string $cepNumber): array
    {
        $redisClient = Redis::connection()->client();
        $keyCacheDataCep = sprintf('cpf:%s', $cepNumber);

        if ($redisClient->exists($keyCacheDataCep)) {
            return $redisClient->hgetall($keyCacheDataCep);
        }

        $dataCEP = self::find($cepNumber);
        $redisClient->hmset($keyCacheDataCep, $dataCEP);
        $redisClient->expire($keyCacheDataCep, 60 * 60 * 24 * 30);

        return $dataCEP;
    }

    /**
     * @throws Exception
     */
    private static function find(string $cepNumber): array
    {
        $redisClient = Redis::connection()->client();
        if ($redisClient->get(self::getKeyCache())) {
            return ViaCep::findByCep($cepNumber);
        }

        try {
            return CorreiosCep::findByCep($cepNumber);
        } catch (Exception $cepInternalErrorException) {
            $redisClient->set(self::getKeyCache(), true, 60 * 30);

            return ViaCep::findByCep($cepNumber);
        }
    }

    private static function getKeyCache(): string
    {
        return 'cep:availabled:second';
    }
}
