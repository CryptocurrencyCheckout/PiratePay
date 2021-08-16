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

    'setting_error_not_found' => 'PiratePay Response = PiratePay was unable to find your current store settings, please set the platform option inside the PiratePay Settings Tab.',

    'wallet_error_getbalance_no_response' => 'Wallet Response = No response from wallet while attempting to get wallet balance. Something is wrong with the wallet. Try Restarting the wallet, Resync the Blockchain, or Update Wallet Version.',
    'wallet_error_getinfo_no_response' => 'Wallet Response = No response from wallet while attempting to get wallet info. Something is wrong with the wallet. Try Restarting the wallet, Resync the Blockchain, or Update Wallet Version.',
    'wallet_error_address_no_response' => 'Wallet Response = No response from wallet while attempting to generate an address. Something is wrong with the wallet. Try Restarting the wallet, Resync the Blockchain, or Update Wallet Version.',
    'wallet_error_balance_no_response' => 'Wallet Response = No response from wallet while attempting to get wallet balance. Something is wrong with the wallet. Try Restarting the wallet, Resync the Blockchain, or Update Wallet Version.',

    'explorer_error_getinfo_no_response' => 'Explorer Response = No response from Explorer while attempting to get block info. Something is wrong with the ARRR Explorer. Wait for it to resolve, or contact ARRR team to notify them their block explorer is down.',

    'api_error_missing_fields' => 'API Response = Some required fields were missing during API Call. Required Fields: store_currency, store_order_id, store_order_price, store_buyer_name, store_buyer_email.',
    'api_error_transaction_exists' => 'API Response = Transaction already exists, providing previously generated ARRR address to customer. This will also happen once per order if Email Fallback is enabled inside plugin.',
    
    'queue_error_transaction_paid' => 'Queue Response = Transaction was already found and marked as paid. Additional Wallet Scans Prevented.',
    'queue_error_transaction_pending' => 'Queue Response = Transaction already pending and being scanned. Additional Wallet Scans Prevented.',
    'queue_error_transaction_overpaid' => 'Queue Response = Transaction wal already found to be overpaid. Additional Wallet Scans Prevented.',

    'wallet_check_not_found' => 'Wallet Check Response = Unable to locate the transaction after several attempts.',
    'wallet_check_underpaid' => 'Wallet Check Response = Transaction found, but the amount received was not enough to finalize the order. Will keep scanning wallet for more transactions.',

    'woocommerce_error_bad_orderid' => 'Woocommerce Response = Woocommerce indicated that it could not find the order ID, this error could indicate that the order was deleted, did not go through, or the wrong value was received.',
    'woocommerce_error_bad_client_request' => 'Woocommerce Response = 400 Bad Response. This could be caused by incorrect API link, wrong client credentials, or incorrect/missing Order ID. You may also need to enable HTTP_AUTHORIZATION inside your Wordpress htaccess file to gain access to the wordpress rest API.',
    'woocommerce_error_bad_server_request' => 'Woocommerce Response = 500 Bad Response. This is usually caused when the server does not respond at all. Verify the WooCommerce Server is up, and check the API Link in Settings.',
    'woocommerce_error_settings_missing' => 'Woocommerce Response = Some of the Woocommerce settings inside PiratePay appear to not be set.',
    'woocommerce_error_values_missing' => 'Woocommerce Response = Cannot Update Order, Transaction Values appear to be missing. This could happen if the queue was cleared before completing.',
    'woocommerce_error_note_failed' => 'Woocommerce Response = Cannot Update Woocommerce Order Note, Was unable to find/edit the note attached to the order.',

    'decryption_error_failed' => 'Decryption Response = PiratePay was unable to Decrypt the api keys, this decryption error could be if the platforms encryption keys were updated/changed/deleted, or if they were never created during installation.',



    'whmcs_error_bad_orderid' => 'WHMCS Response = WHMCS indicated that it could not find the order ID, this error could indicate that the order was deleted, did not go through, or the wrong value was received.',
    'whmcs_error_bad_client_request' => 'WHMCS Response = 400 Bad Response. This could be caused by incorrect Callback Key, wrong URL, or client credentials.',
    'whmcs_error_bad_server_request' => 'WHMCS Response = 500 Bad Response. This is usually caused when the server does not respond at all. Verify the WHMCS Server is up, and check the Callback URL.',
    'whmcs_error_settings_missing' => 'WHMCS Response = Some of the WHMCS settings inside PiratePay appear to not be set.',
    'whmcs_error_values_missing' => 'WHMCS Response = Cannot Update Order, Transaction Values appear to be missing. This could happen if the queue was cleared before completing.',

];
