<?php

namespace App\Http\Requests\Api\User;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property $id
 *
 * Class SubscribeRequest
 * @package App\Http\Requests\Api\Subscribe
 */
class SubscribeRequest extends FormRequest
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
                'not_in:' . \Auth::user()->id,
                Rule::exists('articles', 'user_id'),
                Rule::unique('subscribers', 'user_id')->where('subscriber_id', \Auth::user()->id),
            ],
        ];
    }

}
