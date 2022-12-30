<?php

namespace App\Http\Requests;

use Exception;
use App\Http\Requests\Request as FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($user = $this->user()) {
            try {
                return $user->hasRole('admin') || $user->hasPermissionTo($this->route()->getName(), 'api');
            } catch (Exception $e) {
                return false;
            }
        }

        return true;
    }
}
