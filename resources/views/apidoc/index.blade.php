<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API Reference</title>

    <link rel="stylesheet" href="{{ asset('/docs/css/style.css') }}" />
    <script src="{{ asset('/docs/js/all.js') }}"></script>


          <script>
        $(function() {
            setupLanguages(["bash","javascript","php","python"]);
        });
      </script>
      </head>

  <body class="">
    <a href="#" id="nav-button">
      <span>
        NAV
        <img src="/docs/images/navbar.png" />
      </span>
    </a>
    <div class="tocify-wrapper">
        <img src="/docs/images/logo.png" />
                    <div class="lang-selector">
                                  <a href="#" data-language-name="bash">bash</a>
                                  <a href="#" data-language-name="javascript">javascript</a>
                                  <a href="#" data-language-name="php">php</a>
                                  <a href="#" data-language-name="python">python</a>
                            </div>
                            <div class="search">
              <input type="text" class="search" id="input-search" placeholder="Search">
            </div>
            <ul class="search-results"></ul>
              <div id="toc">
      </div>
                    <ul class="toc-footer">
                                  <li><a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a></li>
                            </ul>
            </div>
    <div class="page-wrapper">
      <div class="dark-box"></div>
      <div class="content">
          <!-- START_INFO -->
<h1>Info</h1>
<p>Welcome to the generated API reference.</p>
<!-- END_INFO -->
<h1>Initiate Transaction</h1>
<p>Initiate the Transaction Process by Generating a PirateChain Address, QR Code, and converting Market and Store Prices.</p>
<!-- START_c0f17eb1d224734ed89e104b893a3fe4 -->
<h2>api/v1/initiate</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "{{ url('') }}/api/v1/initiate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"store_order_id":"5","store_order_price":"1.00","store_currency":"USD","store_buyer_name":"John Doe","store_buyer_email":"test@test.com"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    '{{ url('') }}/api/v1/initiate',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {token}',
        ],
        'json' =&gt; [
            'store_order_id' =&gt; '5',
            'store_order_price' =&gt; '1.00',
            'store_currency' =&gt; 'USD',
            'store_buyer_name' =&gt; 'John Doe',
            'store_buyer_email' =&gt; 'test@test.com',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
        "crypto_qr": "https:\/\/chart.googleapis.com\/chart?chs=300x300&amp;chld=L|2&amp;cht=qr&amp;chl=pirate:zs1kmzcd8h22l8u38hnfdqfxegr0ml0nav9wfqcqpj3wapk8gury6gqlg4xf7gz4kakc4cfwq74xjl?amount=0.226401&amp;message=16&amp;label=16",
        "created_at": "2020-11-26 11:36:06",
        "updated_at": "2020-11-26 14:37:27"
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/initiate</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>store_order_id</code></td>
<td>string</td>
<td>required</td>
<td>The Order ID or Order Number.</td>
</tr>
<tr>
<td><code>store_order_price</code></td>
<td>string</td>
<td>required</td>
<td>The Order Grand Total minus currency symbols.</td>
</tr>
<tr>
<td><code>store_currency</code></td>
<td>string</td>
<td>required</td>
<td>The FIAT currency abbreviation.</td>
</tr>
<tr>
<td><code>store_buyer_name</code></td>
<td>string</td>
<td>required</td>
<td>The name of customer.</td>
</tr>
<tr>
<td><code>store_buyer_email</code></td>
<td>string</td>
<td>required</td>
<td>The email address of the Customer.</td>
</tr>
</tbody>
</table>
<!-- END_c0f17eb1d224734ed89e104b893a3fe4 -->
<h1>Transaction Status</h1>
<p>Check the current status of a PiratePay Transaction with a PiratePay ID or a Store ID.</p>
<!-- START_7e987af97c1971c3327e9a8a99b293f2 -->
<h2>api/v1/status</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "{{ url('') }}/api/v1/status" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"type":"store_id","id":"2563"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    '{{ url('') }}/api/v1/status',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Authorization' =&gt; 'Bearer {token}',
        ],
        'json' =&gt; [
            'type' =&gt; 'store_id',
            'id' =&gt; '2563',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "error": "validation error",
    "message": {
        "type": [
            "The type field is required."
        ],
        "id": [
            "The id field is required."
        ]
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/status</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>required</td>
<td>Search for transaction using either PiratePay &quot;id&quot; or store order number with &quot;store_id&quot;.</td>
</tr>
<tr>
<td><code>id</code></td>
<td>string</td>
<td>required</td>
<td>The transaction id or store order id/number.</td>
</tr>
</tbody>
</table>
<!-- END_7e987af97c1971c3327e9a8a99b293f2 -->
      </div>
      <div class="dark-box">
                        <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                                    <a href="#" data-language-name="php">php</a>
                                    <a href="#" data-language-name="python">python</a>
                              </div>
                </div>
    </div>
  </body>
</html>