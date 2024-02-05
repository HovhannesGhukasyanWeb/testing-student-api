<?php

namespace App\Http\Controllers\core;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiCrudValidationTrate
{

    /**
     * @param string $method
     * @param Request $request
     */
    protected function validation(string $action, Request $request)
    {
        switch($action){
            case 'create':
                $rules = $this->create_validation_rules(); break;
            case 'update':
                $rules = $this->update_validation_rules(); break;
            case 'delete':
                $rules = $this->delete_validation_rules(); break;
            default:
                $rules = [];
        }

        $validateor = Validator::make($request->all(), $rules);
    
        if ($validateor->fails()) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'status' => false,
                'errors' => $validateor->errors(),
            ], 422));
        }
    }

    /**
     * @return array
     */
    protected function create_validation_rules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function update_validation_rules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function delete_validation_rules(): array
    {
        return [];
    }
}
