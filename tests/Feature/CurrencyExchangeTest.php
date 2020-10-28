<?php

namespace Tests\Feature;

use Tests\TestCase;

class CurrencyExchangeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_shows_currency_exchange_rate()
    {
        $response = $this->getJson('api/currency/exchange/AUD', [
            'currency' => 'AUD',
        ]);

        $response->assertJson([
            'currency' => 'AUD',
        ])->assertStatus(201);
    }
}
