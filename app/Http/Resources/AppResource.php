<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::user();
        $member_count = $user->members()->count();

        return [
                'id' => $this->id,
                'name' => $this->name,
                'url' => $this->url,
                'description' => $this->description,
                'plan' => $this->plan,
                'role' => $this->whenLoaded("role"),
                'user' => $this->whenLoaded("user"),
                'branding' => $this->branding = null,
                'link_handling' => $this->link_handling = null,
                'interface' => $this->interface = null,
                'website_override' => $this->website_override = null,
                'permission' => $this->permission = null,
                'navigation' => $this->navigation = null,
                'notification' => $this->notification = null,
                'plugin' => $this->plugin = null,
                'build_setting' => $this->build_setting = null,
                'last_saved' => $this->created_at->diffForHumans(),
                'member_count' => $member_count = 0,
        ];
          }  
    }
                