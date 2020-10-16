<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dashboard Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    'error' => 'Error!',

    'navbar_login' => 'Login',
    'navbar_logout' => 'Logout',
    'navbar_dashboard' => 'Dashboard',
    'navbar_horizon' => 'Queue',

    'navbar_transactions' => 'Transactions',
    'navbar_apikeys' => 'API Keys',
    'navbar_logs' => 'Logs',
    'navbar_wallet' => 'Wallet',
    'navbar_settings' => 'Settings',


    'transmitted' => 'Transmitted:',
    'transmitted_yes' => 'Yes',
    'transmitted_no' => 'No',

    'status' => 'Status:',
    'status_found' => 'Found',
    'status_pending' => 'Pending',
    'status_missing' => 'Missing',
    'status_overpaid' => 'Overpaid',
    'status_underpaid' => 'Underpaid',
    'status_unknown' => 'Unknown',

    'crypto_amount' => 'Expected ARRR:',
    'crypto_received' => 'Received ARRR:',
    'receive_address' => 'Generated Receive Address:',

    'store_order_price' => 'Order Price:',
    'store_order_id' => 'Order ID:',

    'transaction' => 'Transaction:',

    'your_transactions' => 'Your Transactions:',
    'transaction_not_found' => 'No Transactions Found!',
    'transaction_not_found_message' => 'This is where your transactions will display after your payments have been processed.',

    'transaction_store_order_number' => 'Store Order Number:',
    'transaction_store_buyer_name' => 'Store Buyer Name:',
    'transaction_store_buyer_email' => 'Store Buyer Email:',

    'transaction_store_order_price' => 'Store Order Price:',
    'transaction_crypto_market_price' => 'ARRR Market Price:',

    'transaction_expected_crypto' => 'Expected ARRR:',
    'transaction_received_crypto' => 'Received ARRR:',
    'transaction_percent_crypto' => 'Received %:',

    'transaction_status_found' => 'Transaction Found',
    'transaction_status_missing' => 'Transaction Missing',
    'transaction_status_pending' => 'Transaction Pending',
    'transaction_status_unknown' => 'Transaction Unknown',
    'transaction_status_overpaid' => 'Transaction Overpaid',
    'transaction_status_underpaid' => 'Transaction Underpaid',

    'transaction_status_transmitted' => 'Transaction Transmitted',
    'transaction_status_not_transmitted' => 'Transaction Not Transmitted',

    'your_api_keys' => 'Your API Keys:',
    'your_settings' => 'Your Stores Settings:',
    'your_plugin_settings' => 'Settings Required for Plugin:',

    'wallet_header' => 'ARRR Wallet Details:',
    'wallet_status_header' => 'Current Wallet Status:',

    'wallet_blockheight_header' => 'ARRR BlockChain Block Height:',
    'wallet_blockheight_current' => 'Wallet Block Height:',
    'wallet_blockheight_found' => 'Highest Block Found:',
    'wallet_blockheight_explorer' => 'Explorer Block Height:',

    'wallet_blockheight_match' => 'The Blockchain Block-Height appears to match across the board, Therefore the Wallet seems to be running correctly.',
    'wallet_blockheight_mismatch' => 'The Blockchain Block Heights Appear to be mismatch, if they differ by more than a few blocks there may be an issue with the wallet.',
    
    'wallet_blockheight_noresponse' => 'Was not able to get the Block Height from the Wallet. Check error logs for more details.',
    'explorer_blockheight_noresponse' => 'Was not able to get the Block Height from the ARRR Block Explorer. Check error logs for more details.',
    
    'wallet_version_header' => 'Current Wallet Version:',
    'wallet_version_name' => 'Wallet Name:',
    'wallet_version_kmd' => 'KMD Version:',
    'wallet_version_wallet' => 'Wallet Version:',

    'wallet_balance_header' => 'ARRR Wallet Balance:',
    'wallet_balance_transparent' => 'Transparent Wallet Balance:',
    'wallet_balance_private' => 'Private Wallet Balance:',
    'wallet_balance_total' => 'Total Wallet Balance:',

    'wallet_test_button' => 'Test an ARRR Transaction',









];