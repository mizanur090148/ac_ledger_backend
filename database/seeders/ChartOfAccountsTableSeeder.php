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
                'title' => 'Expense',
                'parent'=> null,
                'child' => [
                    [
                        'title' => 'Direct Expense',
                        'parent'=> 'Expense',
                        'child' => [
                            [
                                'title' => 'Purchase',
                                'parent'=> 'Direct Expense'
                            ],[
                                'title' => 'Wages & Salary',
                                'parent'=> 'Direct Expense'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Administrative Expense',
                        'parent'=> 'Expense',
                        'child' => [
                            [
                                'title' => 'Salary & Allowance',
                                'parent'=> 'Administrative Expense'
                            ],[
                                'title' => 'Utility Expense',
                                'parent'=> 'Administrative Expense'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Selling & Marketing Expense',
                        'parent'=> 'Expense',
                        'child' => [
                            [
                                'title' => 'Sales Commission',
                                'parent'=> 'Selling & Marketing Expense'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Financial Expense',
                        'parent'=> 'Expense',
                        'child' => [
                            [
                                'title' => 'Bank Charge',
                                'parent'=> 'Financial Expense'
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
                'title' => 'Income',
                'parent'=> null,
                'child' => [
                    [
                        'title' => 'Direct Income',
                        'parent'=> 'Income',
                        'child' => [
                            [
                                'title' => 'Sales',
                                'parent'=> 'Direct Income'
                            ],[
                                'title' => 'Service Charge',
                                'parent'=> 'Direct Income'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Indirect Income',
                        'parent'=> 'Income'
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
                'title' => 'Liability',
                'parent'=> null,
                'child' => [
                    [
                        'title' => 'Non-current Liability',
                        'parent'=> 'Liability'
                    ],
                    [
                        'title' => 'Current Liability',
                        'parent'=> 'Liability',
                        'child' => [
                            [
                                'title' => 'Payable',
                                'parent'=> 'Current Liability',
                                'child' => [
                                    [
                                        'title' => 'Account Payable',
                                        'parent'=> 'Payable'
                                    ],[
                                        'title' => 'Others Payable',
                                        'parent'=> 'Payable'
                                    ]
                                ]
                            ],[
                                'title' => 'Tax & Vat Out Standing',
                                'parent'=> 'Current Liability',
                                'child' => [
                                    [
                                        'title' => 'Tax Outstanding',
                                        'parent'=> 'Tax & Vat Out Standing'
                                    ],[
                                        'title' => 'VAT Outstanding',
                                        'parent'=> 'Tax & Vat Out Standing'
                                    ]
                                ]
                            ]
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
                'title' => 'Equity',
                'parent'=> null,
                'child' => [
                    [
                        'title' => 'Share Money',
                        'parent'=> 'Equity'
                    ],
                    [
                        'title' => 'Retaing Earning',
                        'parent'=> 'Equity'
                    ],
                    [
                        'title' => 'Opening Retain Earnings',
                        'parent'=> 'Equity'
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
                'title' => 'Assets',
                'parent'=> null,
                'child' => [
                    [
                        'title' => 'Non-Current Assets',
                        'parent'=> 'Assets',
                    ],
                    [
                        'title' => 'Current Assets',
                        'parent'=> 'Assets',
                        'child' => [
                            [
                                'title' => 'Receivable',
                                'parent'=> 'Current Assets',
                                'child' => [
                                    [
                                        'title' => 'Account Receivable',
                                        'parent'=> 'Receivable'
                                    ],[
                                        'title' => 'Others Receivable',
                                        'parent'=> 'Receivable'
                                    ]
                                ]
                            ],
                            [
                                'title' => 'Cash & Bank Balance',
                                'parent'=> 'Current Assets',
                                'child' => [
                                    [
                                        'title' => 'Cash At hand',
                                        'parent'=> 'Cash & Bank Balance'
                                    ],[
                                        'title' => 'Cash At Bank',
                                        'parent'=> 'Cash & Bank Balance'
                                    ]
                                ]
                            ],
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
            'title' => $node['title'],
            'type'  => $type,
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
