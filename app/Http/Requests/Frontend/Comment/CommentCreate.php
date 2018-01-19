<?php

namespace App\Http\Requests\Frontend\Comment;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $article_id
 * @property int $user_id
 * @property int $parent_id
 * @property string $title
 * @property string $desc
 *
 * Class CommentCreate
 * @package App\Http\Requests\Frontend\Comment
 */
class CommentCreate extends FormRequest
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
            'article_id' => [
                'required',
                Rule::exists('articles', 'id')
            ],
            'parent_id' => [
                Rule::unique('comments', 'parent_id'),
                Rule::exists('comments', 'id')->whereNull('parent_id'),
            ],
            'title' => [
                'required', 'max:100', 'alpha_num'
            ],
            'desc' => [
                'required', 'max:65535', 'string',
            ]
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'User must be confirmed! Please confirm your user and try again',
            'parent_id.exists' => 'Comment not exist',
            'parent_id.unique' => 'Only one answer can be left for the comment',
        ];
    }

}
