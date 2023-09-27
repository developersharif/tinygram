<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Request;


class UpdatePostRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isCreating = Request::is(route('post.store'));
        if ($isCreating && empty($value)) {
            // When creating a new post, the image is required
            $fail('The ' . $attribute . ' field is required.');
        }
    }
}