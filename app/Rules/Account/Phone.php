<?php

namespace App\Rules\Account;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Phone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match_all('/^([+]?)(?![.-])(?>(?>[.-]?[ ]?[\da-zA-Z]+)+|([ ]?((?![.-])(?>[ .-]?[\da-zA-Z]+)+)(?![.])([ -]?[\da-zA-Z]+)?)+)+(?>(?>([,]+)?[;]?[\da-zA-Z]+)+(([#][\da-zA-Z]+)+)?)?[#;]?$/', $value)) {
            $fail("There are invalid phone number");
            return;
        }
    }
}
