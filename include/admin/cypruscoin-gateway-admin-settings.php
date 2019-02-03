<?php

defined( 'ABSPATH' ) || exit;

return array(
    'enabled' => array(
        'title' => __('Enable / Disable', 'cypruscoin_gateway'),
        'label' => __('Enable this payment gateway', 'cypruscoin_gateway'),
        'type' => 'checkbox',
        'default' => 'no'
    ),
    'title' => array(
        'title' => __('Title', 'cypruscoin_gateway'),
        'type' => 'text',
        'desc_tip' => __('Payment title the customer will see during the checkout process.', 'cypruscoin_gateway'),
        'default' => __('CyprusCoin Gateway', 'cypruscoin_gateway')
    ),
    'description' => array(
        'title' => __('Description', 'cypruscoin_gateway'),
        'type' => 'textarea',
        'desc_tip' => __('Payment description the customer will see during the checkout process.', 'cypruscoin_gateway'),
        'default' => __('Pay securely using CyprusCoin. You will be provided payment details after checkout.', 'cypruscoin_gateway')
    ),
    'discount' => array(
        'title' => __('Discount for using CyprusCoin', 'cypruscoin_gateway'),
        'desc_tip' => __('Provide a discount to your customers for making a private payment with CyprusCoin', 'cypruscoin_gateway'),
        'description' => __('Enter a percentage discount (i.e. 5 for 5%) or leave this empty if you do not wish to provide a discount', 'cypruscoin_gateway'),
        'type' => __('number'),
        'default' => '0'
    ),
    'valid_time' => array(
        'title' => __('Order valid time', 'cypruscoin_gateway'),
        'desc_tip' => __('Amount of time order is valid before expiring', 'cypruscoin_gateway'),
        'description' => __('Enter the number of seconds that the funds must be received in after order is placed. 3600 seconds = 1 hour', 'cypruscoin_gateway'),
        'type' => __('number'),
        'default' => '3600'
    ),
    'confirms' => array(
        'title' => __('Number of confirmations', 'cypruscoin_gateway'),
        'desc_tip' => __('Number of confirms a transaction must have to be valid', 'cypruscoin_gateway'),
        'description' => __('Enter the number of confirms that transactions must have. Enter 0 to zero-confim. Each confirm will take approximately four minutes', 'cypruscoin_gateway'),
        'type' => __('number'),
        'default' => '10'
    ),
    'cypruscoin_address' => array(
        'title' => __('CyprusCoin Address', 'cypruscoin_gateway'),
        'label' => __('Public CyprusCoin Address'),
        'type' => 'text',
        'desc_tip' => __('CyprusCoin Wallet Address (XCY)', 'cypruscoin_gateway')
    ),
    'daemon_host' => array(
        'title' => __('Turtle-Service Host/IP', 'cypruscoin_gateway'),
        'type' => 'text',
        'desc_tip' => __('This is the turtle-service Host/IP to authorize the payment with', 'cypruscoin_gateway'),
        'default' => '127.0.0.1',
    ),
    'daemon_port' => array(
        'title' => __('Turtle-Service Port', 'cypruscoin_gateway'),
        'type' => __('number'),
        'desc_tip' => __('This is the turtle-service port to authorize the payment with', 'cypruscoin_gateway'),
        'default' => '8070',
    ),
    'daemon_password' => array(
        'title' => __('Turtle-Service Password', 'cypruscoin_gateway'),
        'type' => 'text',
        'desc_tip' => __('This is the turtle-service password to authorize the payment with', 'cypruscoin_gateway'),
        'default' => '',
    ),
    'show_qr' => array(
        'title' => __('Show QR Code', 'cypruscoin_gateway'),
        'label' => __('Show QR Code', 'cypruscoin_gateway'),
        'type' => 'checkbox',
        'description' => __('Enable this to show a QR code after checkout with payment details.'),
        'default' => 'no'
    ),
    'use_cypruscoin_price' => array(
        'title' => __('Show Prices in CyprusCoin', 'cypruscoin_gateway'),
        'label' => __('Show Prices in CyprusCoin', 'cypruscoin_gateway'),
        'type' => 'checkbox',
        'description' => __('Enable this to convert ALL prices on the frontend to CyprusCoin (experimental)'),
        'default' => 'no'
    ),
    'use_cypruscoin_price_decimals' => array(
        'title' => __('Display Decimals', 'cypruscoin_gateway'),
        'type' => __('number'),
        'description' => __('Number of decimal places to display on frontend. Upon checkout exact price will be displayed.'),
        'default' => 2,
    ),
);
