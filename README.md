# Coding Test for 'Made By Sauce'

## How to use

Clone this repository and run

```
composer install
yarn install
yarn run dev
```

*Use `npm` if you must* 🙄

Access the working example at `/currency/exchange`

Using a tool like Insomnia or Postman, call a `GET` method and run `/currency/exchange/{currency}` where `{currency}` if your currency of choice, i.e. `AUD`.

This should produce a `JSON` response

```json
{
  "currency": "AUD",
  "exchangeRate": "1.82661578"
}
```

## Test

You can the test suite by running

```
php artisan test
```