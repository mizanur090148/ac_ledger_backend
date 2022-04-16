<?php

define('ACTIVE', 1);
define('INACTIVE', 0);
define('DEBIT_OR_PAYMENT', 0);
define('CREDIT_OR_RECEIVED', 1);
define('CONTRA', 2);
define('JOURNAL', 3);
define('CASH', 'cash');
define('BANK', 'bank');

$voucherTypes = [
  0 => 'Payment/Debit',
  1 => 'Receive/Credit',
  2 => 'Contra',
  3 => 'Journal'
];
define('VOUCHER_TYPES', $voucherTypes);