<?php

return [
    'available_roles' => [
        'admin',
        'staff',
        'customer',
    ],

    // Role assigned to new users upon sign-up
    'default_role' => 'customer',

    'order_status' => [
        'pending', 'completed', 'cancelled',
    ],

    'invoice_status' => [
        'paid', 'unpaid',
    ],

    'payment_methods' => [
        'cash', 'online',
    ],

    'payment_status' => [
        'pending', 'verified', 'rejected'
    ]
];
