---
title: API Reference

language_tabs:
- bash
- javascript
- php
- python

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Initiate Transaction


Initiate the Transaction Process by Generating a PirateChain Address, QR Code, and converting Market and Store Prices.
<!-- START_c0f17eb1d224734ed89e104b893a3fe4 -->
## api/v1/initiate
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/initiate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"store_order_id":"9","store_order_price":"1.00","store_currency":"USD","store_buyer_name":"John Doe","store_buyer_email":"test@test.com"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/initiate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "store_order_id": "9",
    "store_order_price": "1.00",
    "store_currency": "USD",
    "store_buyer_name": "John Doe",
    "store_buyer_email": "test@test.com"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/v1/initiate',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'store_order_id' => '9',
            'store_order_price' => '1.00',
            'store_currency' => 'USD',
            'store_buyer_name' => 'John Doe',
            'store_buyer_email' => 'test@test.com',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/initiate'
payload = {
    "store_order_id": "9",
    "store_order_price": "1.00",
    "store_currency": "USD",
    "store_buyer_name": "John Doe",
    "store_buyer_email": "test@test.com"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (200):

```json
{
    "data": {
        "id": 10,
        "store_order_id": "5",
        "store_order_price": "0.01",
        "store_buyer_name": "John Doe",
        "store_buyer_email": "test@test.com",
        "crypto_address": "zs1kmzcd8h22l8u38hnfdqfxegr0ml0nav9wfqcqpj3wapk8gury6gqlg4xf7gz4kakc4cfwq74xjl",
        "crypto_market_price": "0.088339",
        "crypto_price": "0.226401",
        "start_balance": "0",
        "crypto_qr": "https:\/\/chart.googleapis.com\/chart?chs=300x300&chld=L|2&cht=qr&chl=pirate:zs1kmzcd8h22l8u38hnfdqfxegr0ml0nav9wfqcqpj3wapk8gury6gqlg4xf7gz4kakc4cfwq74xjl?amount=0.226401&message=16&label=16",
        "created_at": "2020-11-26 11:36:06",
        "updated_at": "2020-11-26 14:37:27"
    }
}
```

### HTTP Request
`POST api/v1/initiate`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `store_order_id` | string |  required  | The Order ID or Order Number.
        `store_order_price` | string |  required  | The Order Grand Total minus currency symbols.
        `store_currency` | string |  required  | The FIAT currency abbreviation.
        `store_buyer_name` | string |  required  | The name of customer.
        `store_buyer_email` | string |  required  | The email address of the Customer.
    
<!-- END_c0f17eb1d224734ed89e104b893a3fe4 -->

