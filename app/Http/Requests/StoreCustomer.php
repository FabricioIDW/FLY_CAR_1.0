<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'discount' => 'required|min:0.01|max:99.99|unique:offers,discount,NULL,id,startDate,' . $this->input('startDate') . ',endDate,' . $this->input('endDate'),
            'name' => 'required|',
            'endDate' => 'required',
        ];
    }
}
