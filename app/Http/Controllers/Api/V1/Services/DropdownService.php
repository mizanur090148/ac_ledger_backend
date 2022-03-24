<?php

namespace App\Http\Controllers\Api\V1\Services;

use App\Models\ChartOfAccount;

class DropdownService
{
    /**
     * @param $modelName
     * @param array $where
     * @param array $select
     * @return mixed
     */
    public function dropdownData($modelName, $where = [], $select = [])
    {
        // Load model class object
        $model = new $modelName();
        // select column
        if (count($select)) {
            $model = $model->select($select);
        } else {
            $model = $model->select('*');
        }
        // where
        if (count($where)) {
            $model = $model->where($where);
        }
        $model = $model->orderBy('id', 'desc');

        return $model->get();
    }

    /**
     * @param $modelName
     * @param array $where
     * @param array $select
     * @return mixed
     */
    public function chartOfAccountDropdownData($modelName, $payMode)
    {
        if ($payMode == 'cash') {
            $title = 'Cash At Hand';
        } elseif ($payMode == 'bank') {
            $title = 'Cash At Bank';
        }
        $cashAtHandOrBankId = (new $modelName)->where('title', $title)->first()->id ?? null;

        // dropdown down data
        $model = new $modelName();
        $model = $model->select('id','title');
        $model = $model->where('parent_id', $cashAtHandOrBankId);
        $model = $model->orderBy('id', 'desc');

        return $model->get();
    }

    /**
     * @param $modelName
     * @return mixed
     */
    public function debitOrCreditToDropdownData($modelName)
    {
        $result = $this->getData($modelName, 'debit_or_credit');
        // dropdown down data
        $model = new $modelName();
        $model = $model->select('id','title');
        $model = $model->whereNotIn('id', $this->levelOrder($result));
        $model = $model->where('last_child', true);
        $model = $model->orderBy('id', 'desc');
        return $model->get();
    }

    /**
     * @param $queue
     * @param array $output
     * @return array
     */
    public function levelOrder($queue, array $output = [])
    {
        if (count($queue) === 0) {
            return $output;
        }
        $node = array_shift($queue);
        $childNodeData = $node['nodes'] ?? null;
        if ($childNodeData) {
            foreach ($childNodeData as $child) {
                $queue[] = $child;
            }
        } else {
            $output[] = $node['id'];
        }

        return $this->levelOrder($queue, $output);
    }

    /**
     * @param $modelName
     * @param $type
     * @return array
     */
    public function getData($modelName, $type)
    {
        $cashAtHandOrBankIds = (new $modelName)->whereIn('title', ['Cash At Hand','Cash At Bank'])->pluck('id')->all();

        return ChartOfAccount::with('nodes')
            ->select('id','parent_id','type','last_child','title as text')
            ->when($type != 'all_child_node', function($query) use ($cashAtHandOrBankIds) {
                $query->whereIn('parent_id', $cashAtHandOrBankIds);
            })
            ->get()
            ->toArray();
    }

    /**
     * @param $modelName
     * @return mixed
     */
    public function allChildNodeDropdownData($modelName)
    {
        $result = $this->getData($modelName, 'all_child_node');
        // dropdown down data
        $model = new $modelName();
        $model = $model->select('id','title');
        $model = $model->whereIn('id', $this->levelOrder($result));
        $model = $model->where('last_child', true);
        $model = $model->orderBy('id', 'desc');
        return $model->get();
    }
}