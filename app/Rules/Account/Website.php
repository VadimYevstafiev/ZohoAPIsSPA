<?php

namespace App\Rules\Account;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Website implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match_all('/^(http:\\/\\/www.|https:\\/\\/www.|ftp:\\/\\/www.|www.|http:\\/\\/|https:\\/\\/|ftp:\\/\\/|){1}[^\\x00-\\x19\\x22-\\x27\\x2A-\\x2C\\x2E-\\x2F\\x3A-\\x3F\\x5B-\\x5E\\x60\\x7B\\x7D-\\x7F]+(\\.[^\\x00-\\x19\\x22\\x24-\\x2C\\x2E-\\x2F\\x3C\\x3E\\x40\\x5B-\\x5E\\x60\\x7B\\x7D-\\x7F]+)+([\\/\\?].*)*$/', $value)) {
            $fail("There are invalid website");
            return;
        }
    }
}
