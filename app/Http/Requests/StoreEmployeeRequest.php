<?php

namespace App\Http\Requests;

use App\Traits\ApiResponses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEmployeeRequest extends FormRequest
{
    use ApiResponses;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'marital_status' =>  ['required', 'in:single,married,divorced,widowed'],
            'address' =>  ['required', 'string'],
            'mobile' => ['required', 'unique:employees,mobile'],
            'emergency_mobile' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'badge_number' => ['required', 'string', 'unique:employees,badge_number'],
            'hiring_date' => ['required', 'date'],
            'department_id' => ['required', 'exists:departments,id'],
            'position_id' => ['required', 'exists:positions,id'],
            'education_grade' => ['required', 'in:none,primary,secondary,high_school,bachelor,master,doctorate,other'],
            'type' => ['required', 'in:permanent,contract,intern'],
            'salary' => ['required', 'numeric'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpeg,png,jpg,gif', 'max:5120'],
        ];
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'image.image' => 'الصورة يجب أن تكون ملف صورة.',
            'image.mimes' => 'نوع الصورة يجب أن يكون jpeg, png, jpg, أو gif.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2MB.',
            'name.required' => 'اسم الموظف مطلوب.',
            'name.string' => 'اسم الموظف يجب أن يكون نصًا صحيحًا.',
            'name.max' => 'اسم الموظف لا يجب أن يتجاوز 255 حرفًا.',
            'birth_date.required' => 'تاريخ الميلاد مطلوب.',
            'birth_date.date' => 'تاريخ الميلاد يجب أن يكون تاريخًا صالحًا.',
            'gender.required' => 'الجنس مطلوب.',
            'gender.in' => 'الجنس يجب أن يكون ذكر أو أنثى.',
            'marital_status.required' => 'الحالة الاجتماعية مطلوبة.',
            'marital_status.in' => 'الحالة الاجتماعية يجب أن تكون أحد الخيارات المتاحة.',
            'address.required' => 'العنوان مطلوب.',
            'address.string' => 'العنوان يجب أن يكون نصًا صحيحًا.',
            'mobile.required' => 'رقم الهاتف مطلوب.',
            'mobile.unique' => 'رقم الهاتف مستخدم بالفعل.',
            'emergency_mobile.string' => 'رقم الطوارئ يجب أن يكون نصًا صحيحًا.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'البريد الإلكتروني يجب أن يكون صالحًا.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'badge_number.required' => 'رقم الهوية مطلوب.',
            'badge_number.unique' => 'رقم الهوية مستخدم بالفعل.',
            'hiring_date.required' => 'تاريخ التعيين مطلوب.',
            'hiring_date.date' => 'تاريخ التعيين يجب أن يكون تاريخًا صالحًا.',
            'department_id.required' => 'القسم مطلوب.',
            'department_id.exists' => 'القسم غير موجود.',
            'position_id.required' => 'الوظيفة مطلوبة.',
            'position_id.exists' => 'الوظيفة غير موجودة.',
            'education_grade.required' => 'المستوى التعليمي مطلوب.',
            'education_grade.in' => 'المستوى التعليمي يجب أن يكون أحد الخيارات المتاحة.',
            'type.required' => 'نوع الوظيفة مطلوب.',
            'type.in' => 'نوع الوظيفة يجب أن يكون أحد الخيارات المتاحة.',
            'salary.required' => 'الراتب مطلوب.',
            'salary.numeric' => 'الراتب يجب أن يكون قيمة رقمية.',
            'file.file' => 'الملف يجب أن يكون مستندًا صالحًا.',
            'file.mimes' => 'الملف يجب أن يكون من نوع pdf, doc, أو docx. او jpeg, png, jpg',
            'file.max' => 'حجم الملف يجب ألا يتجاوز 5MB.',
        ];
    }


    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $message = collect($errors->all())->first();
        $response = $this->unprocessableResponse($errors, $message);
        throw new HttpResponseException($response);
    }
}
