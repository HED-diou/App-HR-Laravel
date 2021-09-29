<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsValidHireDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        
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
        $hiredate = Carbon::create(2015, 4, 20, 0);
        $now = Carbon::now();

        $this->hireDateLPasses = ($value > $hiredate);
        $this->hireDateHPasses = ($value <= $now);

        return ( $this->hireDateHPasses && $this->hireDateLPasses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->hireDateHPasses)
        {
            return "The Hire Date can't be higher than today .";
        }

        elseif($this->hireDateLPasses)
        {
            return "The Hire Date Date can't be lower than 20 Apr 2015 .";
        }
        
    }
}
