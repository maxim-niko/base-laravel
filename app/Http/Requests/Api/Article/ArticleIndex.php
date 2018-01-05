<?php

namespace App\Http\Requests\Api\Article;


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
class ArticleIndex extends FormRequest
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
            'sort' => [
                'string',
                Rule::in(['comments_count']),
            ],
        ];
    }

}
