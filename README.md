<p align="center"><img src="https://raw.githubusercontent.com/CryptocurrencyCheckout/PiratePay/master/public/img/PiratePayShipLogo.png" width="450"></p>

## About PiratePay

PiratePay is a free open source web application that makes accepting ARRR (PirateChain) on your store or website easier and more secure.

This is done by putting your ARRR wallet behind a feature rich RESTful API that offers a graphical dashboard, price conversions, transaction records, additional security features, Oauth2 authentication, as well as a job queue manager designed to monitor your wallet transactions and communicate with your stores API to update your order payment statuses.


## More Details.

More details to come.
If you have any questions please contact !Ratstang CryptocurrencyCheckout#4037 on the ARRR Discord, or by the email below.


## Why Publicly Facing Wallet Servers is Bad.

Having a publicly accessible Wallet JSON-RPC Server can have significant security risks when it comes to your coins/funds.
This is because in order for your website/store to communicate with the remote wallet it must pass the RPC Username & Password details to the Wallet Server.
These details can be easily intercepted by an experienced attacker, giving the attacker full access to do as they please with your wallet, Including withdrawing/stealing your coins.

Although this risk can be partially negated with proper server to server encryption, this adds additional complexity, difficulty, and effort on the admins part. (Which costs time/money.)
Even if done perfectly several other attack vectors remain, such as wallet brute force attacks where bots/scripts can make millions, or even billions of attempts to crack your Wallet RPC login details remotely.

DDOS attacks that can cause mass inconvenience if your store loses the ability to communicate with the wallet. Either leaving your customer with no way to pay, or breaking your checkout process entirely.

The same issue remains, if your wallet is publicly accessible, with enough time, effort and skills it can be compromised.
Standard Wallet JSON-RPC Servers simply do not employ enough security features to provide a high level of security to protect your coins.


## So what makes PiratePay more Secure?

The concept behind PiratePay is simple, remove the public facing wallet and all ability to communicate directly with the wallet from the outside world.

PiratePay works by placing a framework in front of the wallet, think of this framework as a protective barrier that is filtering all communication between the outside world and your wallet.
Keeping all communication with the wallet done within the internal private network. (Localhost, ie 127.0.0.1)

This framework implements several of the latest web and security features such as:

- JSON RESTful API.
- OAuth 2.0 grant type and access tokens.
- Protection against XSS (Cross Site Scripting)
- Protection against SQL Injection.
- Protection against CSRF (Cross Site Request Forgery.)
- Login Throttling (Prevents too many login attempts.)
- X-Rate limiting (Limits how many requests an ip address can make to the server in a given time.)
- GET/POST Purification. (Filters out attempts to inject malicious code when communicating with server.)


**What if an attacker gets my Oauth Token/Keys?:**

Although it can cause some annoyance, your coins will not be at risk if your access token gets compromised.
The API is designed to only perform tasks that are vital/necessary for the store checkout process, such as generating an address, receiving coins, and scanning if those coins have arrived.
The API does not allow coins to be moved or withdrawn from the wallet. Meaning the worst thing an attacker with your keys can do, is generate unneeded addresses, or pay funds/coins to your wallet.


**What if an attacker gets my Dashboard Login/Password?:**

Although the admin dashboard does provide some transaction details about your websites/stores orders, access to the dashboard does not pose a security risk to your coins.
This is because the PiratePay dashboard is designed only to provide details necessary to understand which transactions you have and have not received, as well as enough information to monitor PiratePay.
Your Coins cannot be moved/withdrawn from the admin dashboard.


**What if the attacker gains root access to the server backend?:**

Unfortunately this is the one situation where your coins could be at risk, as the attacker will be behind PiratePay and have direct access to the wallet.
However there are many methods you can use to prevent this from happening, such as closing all access to FTP and SSH ports when not accessing/working on the server.
Or even making it so only whitelisted IP Addresses can access the server backend through SSH/FTP. (affectively banning the rest of the world from even attempting to login.)
Other recommended and effective ways to protect your server is using an SSH RSA Key Pair, and Password combination. (Requiring both Keys and a Password to login to the server.) Or other reliable forms of Two-Factor Authentication.


## Security Vulnerabilities

If you discover a security vulnerability within PiratePay, please send an e-mail to CryptocurrencyCheckout via [support@cryptocurrencycheckout.com](mailto:support@cryptocurrencycheckout.com). All security vulnerabilities will be investigated and addressed.


## License

PiratePay is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
