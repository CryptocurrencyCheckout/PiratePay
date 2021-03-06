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

<!-- END_INFO -->

#Initiate Transaction


Initiate the Transaction Process by Generating a PirateChain Address, QR Code, and converting Market and Store Prices.
<!-- START_c0f17eb1d224734ed89e104b893a3fe4 -->
## api/v1/initiate
> Example request:

```bash
curl -X POST \
    "{{ url('') }}/api/v1/initiate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"store_order_id":"5","store_order_price":"1.00","store_currency":"USD","store_buyer_name":"John Doe","store_buyer_email":"test@test.com"}'

```

```javascript
const url = new URL(
    "{{ url('') }}/api/v1/initiate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "store_order_id": "5",
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
    '{{ url('') }}/api/v1/initiate',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'store_order_id' => '5',
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

url = '{{ url('') }}/api/v1/initiate'
payload = {
    "store_order_id": "5",
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
        "store_order_price": "1.00",
        "store_currency": "USD",
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

#Transaction Status


Check the current status of a PiratePay Transaction with a PiratePay ID or a Store ID.
<!-- START_7e987af97c1971c3327e9a8a99b293f2 -->
## api/v1/status
> Example request:

```bash
curl -X POST \
    "{{ url('') }}/api/v1/status" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"type":"store_id","id":"2563"}'

```

```javascript
const url = new URL(
    "{{ url('') }}/api/v1/status"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "type": "store_id",
    "id": "2563"
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
    '{{ url('') }}/api/v1/status',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'type' => 'store_id',
            'id' => '2563',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = '{{ url('') }}/api/v1/status'
payload = {
    "type": "store_id",
    "id": "2563"
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
        "id": 1,
        "store_order_id": "2563",
        "store_order_price": "0.02",
        "store_currency": "USD",
        "store_buyer_name": "John Doe",
        "store_buyer_email": "test@test.com",
        "crypto_address": "zs1yu96c2uz8g0k04qcprj2ssg2rmkuvzgfa2ug8u0rrrysmh2sjzwksx780j78n9qwu9v0ynnjhqk",
        "crypto_market_price": "0.097645",
        "crypto_price": "0.204824",
        "start_balance": "0",
        "expected_balance": "0.204824",
        "end_balance": null,
        "status_detailed": "pending",
        "status_basic": "false",
        "created_at": "2021-01-04 18:21:17",
        "updated_at": "2020-01-04 18:21:17"
    }
}
```
> Example response (422):

```json
{
    "error": "validation error",
    "message": {
        "type": [
            "The type field is required."
        ],
        "id": [
            "The id field is required."
        ]
    }
}
```

### HTTP Request
`POST api/v1/status`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `type` | string |  required  | Search for transaction using either PiratePay "id" or store order number with "store_id".
        `id` | string |  required  | The transaction id or store order id/number.
    
<!-- END_7e987af97c1971c3327e9a8a99b293f2 -->


