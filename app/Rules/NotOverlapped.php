<?php

namespace App\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class NotOverlapped implements Rule
{
    protected $table;
    protected $start;
    protected $end;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $start, $end){
        $this->table = $table;
        $this->start = $start;
        $this->end   = $end;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return DB::table($this->table)
                    ->where($this->start, '<=', request($this->end))
                    ->where($this->end, '>=', request($this->start))->count('id')
                == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(){
        return 'You have overlapped invoices periods. please change the period!';
    }
}
