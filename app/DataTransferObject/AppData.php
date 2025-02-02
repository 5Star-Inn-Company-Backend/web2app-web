<?php

namespace App\DataTransferObject;

class AppData
{
    
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $url = null,
        public readonly ?string $description = null,
        public readonly string|null $plan = null,
        public readonly array|null $branding = [],
        public readonly array|null $link_handling = [],
        public readonly array|null $interface = [],
        public readonly array|null $website_overide = [],
        public readonly array|null $permission = [],
        public readonly array|null $navigation = [],
        public readonly array|null $notification = [],
        public readonly array|null $plugin = [],
        public readonly array|null $build_setting = [],
        public readonly string|null $private_link = null,
        public readonly string|null $public_link = null,
    ) {}

}