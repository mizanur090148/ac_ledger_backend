<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use Illuminate\Database\Seeder;

class ChartOfAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChartOfAccount::truncate();
        $this->assets();
        $this->equity();
        $this->liability();
        $this->income();
        $this->expense();
    }

    public function expense()
    {
        $expenses = [
            [
                'title'     => 'Expense',
                'parent'    => null,
                'ac_code'   => null,
                'child'     => [
                    [
                        'title'     => 'Cost Of Good Sold',
                        'parent'    => 'Expense',
                        'ac_code'   => '51-0000',
                        'child'     => [
                            [
                                'title'     => 'Direct Wages',
                                'parent'    => 'Cost Of Good Sold',
                                'ac_code'   => '51-0001'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Administrative Expense',
                        'parent'=> 'Expense',
                        'ac_code'   => '52-0000',
                        'child' => [
                            [
                                'title'     => 'Salary & Wages',
                                'parent'    => 'Administrative Expense',
                                'ac_code'   => '52-0001'
                            ]
                        ]
                    ],
                    [
                        'title'     => 'Selling & Marketing Expenses',
                        'parent'    => 'Expense',
                        'ac_code'   => '53-0000',
                        'child'     => [
                            [
                                'title'     => 'Sales Commission',
                                'parent'    => 'Selling & Marketing Expenses',
                                'ac_code'   => '53-0000'
                            ]
                        ]
                    ],
                    [
                        'title'     => 'Financial Expenses',
                        'parent'    => 'Expense',
                        'ac_code'   => '54-0000',
                        'child'     => [
                            [
                                'title' => 'Bank Charges',
                                'parent'=> 'Financial Expenses',
                                'ac_code'   => '54-0001'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        foreach ($expenses as $key => $expense) {
            $this->levelOrder([$expense], 'expense');
        }
    }

    public function income()
    {
        $incomes = [
            [
                'title'     => 'Income',
                'parent'    => null,
                'ac_code'   => null,
                'child'     => [
                    [
                        'title'     => 'Revenue',
                        'parent'    => 'Income',
                        'ac_code'   => '41-0000',
                        'child'     => [
                            [
                                'title'     => 'Sales Revenue',
                                'parent'    => 'Revenue',
                                'ac_code'   => '41-0001',
                            ],[
                                'title'     => 'Service Income',
                                'parent'    => 'Revenue',
                                'ac_code'   => '41-0002',
                            ]
                        ]
                    ],
                    [
                        'title'     => 'Others income',
                        'parent'    => 'Income',
                        'ac_code'   => '42-0000',
                        'child'     => [
                            [
                                'title'     => 'Foreign Exchange Gain /(Loss)',
                                'parent'    => 'Others income',
                                'ac_code'   => '42-0001',
                            ],
                            [
                                'title'     => 'Unadjusted Gain /(Loss)',
                                'parent'    => 'Others income',
                                'ac_code'   => '42-0002',
                            ],
                            [
                                'title'     => 'Discount Received',
                                'parent'    => 'Others income',
                                'ac_code'   => '42-0003',
                            ]
                        ]
                    ]
                ]
            ]
        ];
        foreach ($incomes as $key => $income) {
            $this->levelOrder([$income], 'income');
        }
    }

    public function liability()
    {
        $liabilities = [
            [
                'title'     => 'Liability',
                'parent'    => null,
                'ac_code'   => null,
                'child'     => [
                    [
                        'title'     => 'Non-Current Liabilities',
                        'parent'    => 'Liability',
                        'ac_code'   => '31-0000',
                        'child'     => [
                            [
                                'title'     => 'Long Term Loan',
                                'parent'    => 'Non-Current Liabilities',
                                'ac_code'   => '31-0001'
                            ],
                        ]
                    ],
                    [
                        'title'     => 'Current Liabilities',
                        'parent'    => 'Liability',
                        'ac_code'   => '32-0000',
                        'child'     => [
                            [
                                'title'     => 'Short Term Loan',
                                'parent'    => 'Current Liabilities',
                                'ac_code'   => '32-0001'
                            ],
                        ]
                    ],
                ]

            ]
        ];
        foreach ($liabilities as $key => $liability) {
            $this->levelOrder([$liability], 'liability');
        }
    }

    public function equity()
    {
        $equities = [
            [
                'title'     => 'Equity',
                'parent'    => null,
                'ac_code'   => null,
                'child'     => [
                    [
                        'title'     => 'Share Capital',
                        'parent'    => 'Equity',
                        'ac_code'   => '21-0000'
                    ],
                    [
                        'title'     => 'Share Money Deposit',
                        'parent'    => 'Equity',
                        'ac_code'   => '21-0001'
                    ],
                    [
                        'title'     => 'Retained Earnings',
                        'parent'    => 'Equity',
                        'ac_code'   => '21-0002',
                        'child'     => [
                            [
                                'title'     => 'Opening Retained Earnings',
                                'parent'    => 'Retained Earnings',
                                'ac_code'   => '21-0003'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        foreach ($equities as $key => $equity) {
            $this->levelOrder([$equity], 'equity');
        }
    }

    public function assets()
    {
        $assets = [
            [
                'title'     => 'Assets',
                'parent'    => null,
                'ac_code'   => null,
                'child'     => [
                    [
                        'title'     => 'Non-Current Assets',
                        'parent'    => 'Assets',
                        'ac_code'   => '11-0000',
                        'child'     => [
                            [
                                'title'     => 'Property Plant & Equipments',
                                'parent'    => 'Non-Current Assets',
                                'ac_code'   => '11-0001'
                            ]
                        ]
                    ],
                    [
                        'title'     => 'Current Assets',
                        'parent'    => 'Assets',
                        'ac_code'   => '12-0000',
                        'child' => [
                            [
                                'title'     => 'Cash & Cash Equivalents',
                                'parent'    => 'Current Assets',
                                'ac_code'   => '12-0001',
                                'child'     => [
                                    [
                                        'title'     => 'Cash In Hand',
                                        'parent'    => 'Cash & Cash Equivalents',
                                        'ac_code'   => '12-0002',
                                    ],[
                                        'title'     => 'Cash At Bank',
                                        'parent'    => 'Cash & Cash Equivalents',
                                        'ac_code'   => '12-0003',
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ];
        foreach ($assets as $key => $asset) {
            $this->levelOrder([$asset], 'assets');
        }
    }

    public function levelOrder(array $queue, $type)
    {
        if (count($queue) === 0) {
            return true;
        }
        $node = array_shift($queue);
        $input = [
            'title'     => $node['title'],
            'ac_code'   => $node['ac_code'],
            'type'      => $type,
            'parent_id' => ChartOfAccount::whereTitle($node['parent'])->first()->id ?? null
        ];
        $chartOfAccount = ChartOfAccount::create($input);
        $childNodes = $node['child'] ?? [];
        foreach ($childNodes as $child) {
            $queue[] = $child;
        }
        if (!count($childNodes)) {
            $chartOfAccount->update(['last_child' => true]);
        }
        return $this->levelOrder($queue, $type);
    }

}
