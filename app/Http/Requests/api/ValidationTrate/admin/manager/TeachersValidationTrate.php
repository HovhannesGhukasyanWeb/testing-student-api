<?php

namespace App\Http\Requests\api\ValidationTrate\admin\manager;
use App\Rules\UnknownProperties;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

trait TeachersValidationTrate
{
    /**
     * @return array
     * @inheritDoc
     */
    protected function store_validation_rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string'],
            'role_id' => [new UnknownProperties()],
            'user_profile.first_name' => ['sometimes', 'string'],
            'user_profile.last_name' => ['sometimes', 'string'],
            'user_profile.middle_name' => ['sometimes', 'string'],
            'user_profile.age' => ['sometimes', 'integer'],
            'user_profile.courses' => [new UnknownProperties()],
        ];
    }

    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    protected function store_after_validation(Request $request): void
    {
        parent::store_after_validation($request);
        $this->after_validate($request);
    }
    
    /**
     * @return array
     * @inheritDoc
     */
    protected function update_validation_rules() : array
    {
        return [
            'username' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string', 'unique:users,email'],
            'password' => ['sometimes', 'string'],
            'role_id' => [new UnknownProperties()],
            'user_profile.first_name' => ['sometimes', 'string'],
            'user_profile.last_name' => ['sometimes', 'string'],
            'user_profile.middle_name' => ['sometimes', 'string'],
            'user_profile.age' => ['sometimes', 'integer'],
            'user_profile.courses' => [new UnknownProperties()],
        ];        
    }

    /**
     * @param Request $request
     * @param int|null $id
     * @return void
     * @throws HttpResponseException
     */
    protected function update_after_validation(Request $request, int|null $id): void
    {
        parent::update_after_validation($request, $id);
        $this->after_validate($request);
    }


    /**
     * @param Request $request
     * @return void
     * @throws HttpResponseException
     */
    private function after_validate(Request $request): void
    {
        if($request->has('subject_ids')){
            $request->merge(['subject_ids' => array_unique($request->input('subject_ids'))]);
        }   
    }
}
