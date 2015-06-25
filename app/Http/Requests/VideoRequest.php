<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VideoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'source_url'   => 'required|min:3',
                    'project_url'  => 'required|min:3',
                    'user_id' 	   => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                if (!$this->input('status'))
                {
                    return [
                        'source_url'   => 'required|min:3',
                        'project_url'  => 'required|min:3',
                        'user_id' 	   => 'required'
                    ];
                }
                return [];
            }
            default:break;
        }
    }
}
