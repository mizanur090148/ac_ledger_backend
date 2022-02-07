<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueCheck implements Rule
{
    private $modelClassName;
    private $uniqueColumnName;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($modelClassName)
    {     
        $this->modelClassName = $modelClassName;
    }

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Don not change because it is common single colimn wise unique validation rule
        $this->uniqueColumnName = $attribute;
        $row = $this->modelClassName::where($attribute, $value);
        if (request('id')) {
            $row = $row->where('id', '!=', request('id'));
        }
        $row = $row->first();
        return $row ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This ' . $this->uniqueColumnName . ' is already exist';
    }
}