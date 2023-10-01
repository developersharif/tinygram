<?php

namespace App\Http\Requests;

use App\Rules\UpdatePostRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'body' => 'max:255',
            'photo' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ];

        if ($this->isMethod('post')) {
            $rules['photo'][] = ['required','image', 'mimes:jpeg,png,jpg,gif,webp', 'max:3072'];
        }

        return $rules;
    }
}