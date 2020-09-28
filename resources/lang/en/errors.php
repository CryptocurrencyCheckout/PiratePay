<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Error Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    'wallet_error_address_no_response' => 'Wallet Response = No response from wallet while attempting to generate an address. Something is wrong with the wallet. Try Restarting the wallet, Resync the Blockchain, or Update Wallet Version.',
    'wallet_error_balance_no_response' => 'Wallet Response = No response from wallet while attempting to get wallet balance. Something is wrong with the wallet. Try Restarting the wallet, Resync the Blockchain, or Update Wallet Version.',

    'api_error_missing_fields' => 'API Response = Some required fields were missing during API Call. Required Fields: store_currency, store_order_id, store_order_price, store_buyer_name, store_buyer_email.',

    'wallet_check_not_found' => 'Wallet Check Response = Unable to locate the transaction after several attempts.',

    'woocommerce_error_bad_orderid' => 'Woocommerce Response = Woocommerce indicated that it could not find the order ID, this error could indicate that the order was deleted, did not go through, or the wrong value was received.',
    'woocommerce_error_bad_client_request' => 'Woocommerce Response = 400 Bad Response. This could be caused by incorrect API link, wrong client credentials, or incorrect/missing Order ID.',
    'woocommerce_error_bad_server_request' => 'Woocommerce Response = 500 Bad Response. This is usually caused when the server does not respond at all. Verify the WooCommerce Server is up, and check the API Link in Settings.',
    'woocommerce_error_settings_missing' => 'Woocommerce Response = Some of the Woocommerce settings inside PiratePay appear to not be set.',
    'woocommerce_error_values_missing' => 'Woocommerce Response = Cannot Update Order, Transaction Values appear to be missing. This could happen if the queue was cleared before completing.',
    'woocommerce_error_note_failed' => 'Woocommerce Response = Cannot Update Woocommerce Order Note, Was unable to find/edit the note attached to the order.',

    'decryption_error_failed' => 'Decryption Response = PiratePay was unable to Decrypt the api keys, this decryption error could be if the platforms encryption keys were updated/changed/deleted, or if they were never created during installation.',
];