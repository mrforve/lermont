<?php
return [
    // All endpoints are fixed: credentials cannot be redirected to an arbitrary host.
    'host' => 'https://partner.tlintegration.com',
    // Real reservations require the checkout, payment and reconciliation acceptance tests.
    'reservation_writes_enabled' => false,
];
