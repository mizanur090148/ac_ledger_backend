<?php

define('DEBIT_OR_PAYMENT', 0);
define('CREDIT_OR_RECEIVED', 1);
define('CONTRA', 2);
define('JOURNAL', 3);

$voucherTypes = [
  0 => 'Payment/Debit',
  1 => 'Receive/Credit',
  2 => 'Contra',
  3 => 'Journal'
];
define('VOUCHER_TYPES', $voucherTypes);