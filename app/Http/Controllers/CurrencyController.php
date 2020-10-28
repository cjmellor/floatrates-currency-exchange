<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use SimpleXMLElement;

class CurrencyController extends Controller
{
    public const ENDPOINT = 'http://www.floatrates.com/daily/gbp.xml';

    /**
     * Handle the incoming request.
     *
     * @param $currency
     * @return string
     */
    public function __invoke($currency)
    {
        $currency = Str::upper($currency);

        return $this->getExchangeRate($currency);
    }

    /**
     * Get the exchange rate from GBP to AUD
     *
     * @param $currency
     * @return JsonResponse|SimpleXMLElement|string
     */
    public function getExchangeRate($currency)
    {
        // Lets get the data from the endpoint
        $currencyData = Http::get(self::ENDPOINT)
            ->body();

        // Now lets turn it into a correctly formatted string
        $currencyDataXml = simplexml_load_string($currencyData);

        // We'll turn the data into an array and then into a collection, for much simpler manipulation
        $targetCurrency = '';
        $exchangeRate = '';

        foreach ($currencyDataXml->children() as $item) {
            if ($item->targetCurrency == $currency) {
                $targetCurrency = (string) $item->targetCurrency;
                $exchangeRate = (string) $item->exchangeRate;
            }
        }

        return response()->json([
            'currency' => $targetCurrency,
            'exchangeRate' => $exchangeRate,
        ], 201);
    }
}
