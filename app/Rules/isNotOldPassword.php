<?php

namespace App\Rules;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class isNotOldPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $this->oldpasswordcheck = (!Hash::check( $value, Auth::user()->password ));
        
        return ($this->oldpasswordcheck);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        
            return 'Please choose a new password that is different than the current password.';
        
    }
}
