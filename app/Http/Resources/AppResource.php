<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
                return array_merge([
                    'id' => $this->id,
                    'name' => $this->name,
                    'url' => $this->url,
                    'description' => $this->description,
                    'plan' => $this->plan,
                    'role' => $this->whenLoaded("role"),
                    'user' => $this->whenLoaded("user"),
                    'branding' => $this->branding,
                    'link_handling' => $this->link_handling,
                    'interface' => $this->interface,
                    'website_override' => $this->website_override,
                    'permission' => $this->permission,
                    'navigation' => $this->navigation,
                    'notification' => $this->notification,
                    'plugin' => $this->plugin,
                    'build_setting' => $this->build_setting,
                ]);
            }
    }
