<?php

namespace App\Rules;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Rule;

class IsStrongPassword implements Rule
{
    /**
     * Determine if the Length Validation Rule passes.
     *
     * @var boolean
     */
    public $lengthPasses = true;

    /**
     * Determine if the Uppercase Validation Rule passes.
     *
     * @var boolean
     */
    public $uppercasePasses = true;

    /**
     * Determine if the Numeric Validation Rule passes.
     *
     * @var boolean
     */
    public $numericPasses = false;

    /**
     * Determine if the Special Character Validation Rule passes.
     *
     * @var boolean
     */
    public $specialCharacterPasses = true;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->lengthPasses = (Str::length($value) >= 6);
        $this->uppercasePasses = (Str::lower($value) !== $value);
        $this->numericPasses = ((bool)preg_match('/[0-9]/', $value));
        $this->specialCharacterPasses = ((bool)preg_match('/[^A-Za-z0-9]/', $value));

        return ($this->lengthPasses && $this->uppercasePasses && $this->specialCharacterPasses);
    }

    public function message()
    {
        switch (true) {
            case !$this->uppercasePasses
                && $this->lengthPasses
                && $this->specialCharacterPasses:
                return 'The :attribute must  contain at least 1 uppercase character.';

            case !$this->specialCharacterPasses
                && $this->uppercasePasses
                && $this->lengthPasses:
                return 'The :attribute must  contain at least 1 special character.';

            case !$this->lengthPasses
                && $this->uppercasePasses
                && $this->specialCharacterPasses:
                return 'The :attribute must be at least 6 characters.';
            
            case $this->lengthPasses
                && !$this->uppercasePasses
                && !$this->specialCharacterPasses:
                return 'The :attribute must  contain at least 1 special character and 1 uppercase character. ';

            case !$this->uppercasePasses
                && !$this->lengthPasses
                && !$this->specialCharacterPasses:
                return 'The :attribute must be at least 6 characters and contain at least 1 uppercase character and 1 special character.';

            default:
                return 'The :attribute must be at least 6 characters.';
        }
    }



}
