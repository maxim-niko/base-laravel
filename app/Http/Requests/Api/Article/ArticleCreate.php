<?php

namespace App\Http\Requests\Api\Article;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $user_id
 * @property string $title
 * @property string $desc
 *
 * Class ArticleCreate
 * @package App\Http\Requests\Api\Article
 */
class ArticleCreate extends FormRequest
{

    protected function validationData()
    {
        $all = parent::validationData();

        $all['user_id'] = \Auth::user()->id;
        return $all;
    }

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
            'user_id' => [
                'required',
                Rule::exists('users', 'id')->where('confirmed', User::STATUS_CONFIRMED)
            ],
            'title' => [
                'required', 'max:120', 'alpha_num', Rule::unique('articles')
            ],
            'desc' => [
                'required', 'max:16777215', 'string',
            ]
        ];
    }

    public function messages()
    {
        return [
            'user_id' => 'User must be confirmed! Please confirm your user and try again'
        ];
    }

}
