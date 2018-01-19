<?php

namespace App\Http\Requests\Frontend\User;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $id
 * Class UnsubscribeRequest
 * @package App\Http\Requests\Frontend\Subscribe
 */
class UnsubscribeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !\Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                Rule::exists('subscribers', 'user_id')->where('subscriber_id', \Auth::user()->id)
            ],
        ];
    }

}
