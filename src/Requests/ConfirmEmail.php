<?php

namespace ITB\LEC\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmEmail extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ( auth()->check() )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'vcode' => [
                'required',
                'string',
                'min:23',
                'max:23',
            ],
        ];
    }
}
