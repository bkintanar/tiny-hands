<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'display_name' => "{$this->first_name} {$this->middle_name} {$this->last_name}",
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'last_saved_locale' => $this->last_saved_locale,
            'roles' => $this->roles->pluck('name'),
        ];
    }
}
