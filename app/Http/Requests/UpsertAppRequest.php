<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertAppRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique("apps", 'name')->ignore($this->app)],
            'url' => ['required', 'url', Rule::unique("apps", 'url')->ignore($this->app)],
            'plan' => ['required', 'string'],
            'description' => ['required', 'string'],
            'branding' => ['nullable', 'sometimes', 'array'],
            'branding.app_icon' => ['nullable', 'sometimes', 'url'],
            'branding.splash_screen' => ['nullable', 'sometimes', 'string'],
            'branding.theme_color' => ['nullable', 'sometimes', 'string', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'branding.status_bar' => ['nullable', 'sometimes', 'string'],
            'link_handling' => ['nullable', 'sometimes', 'array'],
            'link_handling.link_behaviour' => ['nullable', 'sometimes', 'boolean'],
            'link_handling.new_window' => ['nullable', 'sometimes', 'string'],
            'link_handling.universal_link' => ['nullable', 'sometimes', 'string'],
            'link_handling.url_scheme' => ['nullable', 'sometimes', 'string'],
            'interface' => ['nullable', 'sometimes', 'array'],
            'interface.screen_on' => ['nullable', 'sometimes', 'boolean'],
            'interface.full_screen' => ['nullable', 'sometimes', 'boolean'],
            'interface.dark_mode' => ['nullable', 'sometimes', 'string'],
            'interface.scree_orientation' => ['nullable', 'sometimes', 'string'],
            'interface.pull_to_refresh' => ['nullable', 'sometimes', 'boolean'],
            'interface.swipe_gesture' => ['nullable', 'sometimes', 'boolean'],
            'interface.pitch_to_zoom' => ['nullable', 'sometimes', 'boolean'],
            'interface.accessibility' => ['nullable', 'sometimes', 'boolean'],
            'interface.front_scaling' => ['nullable', 'sometimes', 'boolean'],
            'interface.maximum_window' => ['nullable', 'sometimes', 'boolean'],
            'interface.view_port_width' => ['nullable', 'sometimes', 'boolean'],
            'interface.localization' => ['nullable', 'sometimes', 'array', 'min:1'],
            'website_override' => ['nullable', 'sometimes', 'array'],
            'permission' => ['nullable', 'sometimes', 'array'],
            'permission.javascript_bridge' => ['nullable', 'sometimes', 'array'],
            'permission.app_tracking_transparency' => ['nullable', 'sometimes', 'boolean'],
            'permission.location_service' => ['nullable', 'sometimes', 'boolean'],
            'permission.media' => ['nullable', 'sometimes', 'boolean'],
            'permission.downloads_directory' => ['nullable', 'sometimes', 'string'],
            'permission.background_audio' => ['nullable', 'sometimes', 'boolean'],
            'permission.permission' => ['nullable', 'sometimes', 'array'],
            'navigation' => ['nullable', 'sometimes', 'array'],
            'navigation.display_mode' => ['nullable', 'sometimes', 'string'],
            'navigation.styling' => ['nullable', 'sometimes', 'array'],
            'navigation.navigation_bar' => ['nullable', 'sometimes', 'array'],
            'notification' => ['nullable', 'sometimes', 'array'],
            'notification.signal' => ['nullable', 'sometimes', 'boolean'],
            'notification.lagacy_mode' => ['nullable', 'sometimes', 'boolean'],
            'notification.app_id' => ['nullable', 'sometimes', 'string'],
            'notification.automatic_registration' => ['nullable', 'sometimes', 'boolean'],
            'notification.automatic_data_transmission' => ['nullable', 'sometimes', 'boolean'],
            'notification.foreground_notification' => ['nullable', 'sometimes', 'boolean'],
            'notification.notification_sound' => ['nullable', 'sometimes', 'array'],
            'plugin' => ['nullable', 'sometimes', 'array'],
            'plugin.social_login' => ['nullable', 'sometimes', 'boolean'],
            'build_setting' => ['nullable', 'sometimes', 'array'],
            'build_setting.google_service' => ['nullable', 'sometimes', 'array'],
            'build_setting.development_tools' => ['nullable', 'sometimes', 'boolean'],
            'build_setting.app_config' => ['nullable', 'sometimes', 'array'],
        ];
    }
}
