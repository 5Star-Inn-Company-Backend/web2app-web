<?php

namespace App\Jobs;

use App\Models\Build;
use App\Models\convert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartBuildJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $reference;
    public function __construct($reference)
    {
        $this->reference=$reference;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $reference=$this->reference;

        $conv=convert::where(['reference_code' => $reference, 'status' => 1])->first();

        if($conv){
            $fullscreen=strtolower($conv->fullscreen) == 'no' ? "false" : "true";

            $config='{
  "public": {
    "appName": "'.$conv->appname.'",
    "initialUrl": "'.$conv->url.'",
    "userAgent": "web2app",
    "primaryColor": "'.$conv->primarycolor.'",
    "fullScreen": '.$fullscreen.',
    "forceScreenOrientation": false
  },
  "navigations": {
    "tab": {
      "menus": [
        {
          "icon": "Icons.home",
          "label": "Main",
          "url": "https://gonative.io"
        },
        {
          "icon": "Icons.history",
          "label": "Create Account",
          "url": "https://trixwallet.com/mobileapp/register"
        },
        {
          "subLinks": [],
          "icon": "Icons.history",
          "label": "GoNative Demo",
          "url": "https://gonative.io/demo"
        }
      ],
      "active": false
    },
    "drawer": {
      "items": [
        {
          "label": "Sample Home",
          "url": "https://gonative.io",
          "icon": "fas fa-home"
        },
        {
          "label": "Sample About",
          "url": "https://gonative.io/about",
          "icon": "fas fa-user"
        }
      ],
      "active": false
    },
    "androidPullToRefresh": false,
    "iosPullToRefresh": true,
    "navigationTitles": {
      "titles": [
        {}
      ],
      "active": false
    },
    "toolbarNavigation": {
      "items": [
        {
          "system": "back",
          "title": "Back"
        },
        {
          "system": "forward",
          "title": "Forward"
        },
        {
          "system": "refresh"
        }
      ]
    },
    "androidShowRefreshButton": false,
    "deepLinkDomains": {
      "domains": [],
      "enableAndroidApplinks": false
    }
  },
  "styling": {
    "transitionInteractiveDelayMax": 0.2,
    "menuAnimationDuration": 0.15,
    "androidShowSplash": true,
    "disableAnimations": false,
    "hideWebviewAlpha": 0.5,
    "showActionBar": true,
    "showNavigationBar": true,
    "iosSidebarFont": "Default",
    "androidHideTitleInActionBar": true,
    "navigationTitleImage": true,
    "iosTheme": "default",
    "androidTheme": "light",
    "androidSidebarBackgroundColor": "#FFFFFF",
    "androidSidebarForegroundColor": "#1E496E",
    "androidActionBarBackgroundColor": "#FFFFFF",
    "androidActionBarForegroundColor": "#1E496E",
    "androidPullToRefreshColor": "#1E496E",
    "androidAccentColor": "#1E496E",
    "androidSidebarSeparatorColor": "#CCCCCC",
    "androidTabBarBackgroundColor": "#FFFFFF",
    "androidTabBarTextColor": "#949494",
    "androidTabBarIndicatorColor": "#1E496E",
    "androidStatusBarBackgroundColor": "#5C5C5C",
    "iosTintColor": "#1E496E",
    "iosTitleColor": "#1E496E",
    "iosSidebarTextColor": "#1E496E"
  },
  "permissions": {
    "usesGeolocation": false,
    "androidDownloadToPublicStorage": false,
    "enableWebRTC": false
  },
  "performance": {
    "webviewPools": [
      {
        "urls": [
          {
            "disown": "reload"
          }
        ]
      }
    ]
  },
  "services": {
  }
}';

            $app_config=base64_encode($config);

            $input['reference_code']=$reference;
            $input['config']=$app_config;
            $build=Build::create($input);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.codemagic.io/builds',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => '{
    "appId": "62e4fc24f9c684a19c46b49d",
    "workflowId": "62e4fc24f9c684a19c46b49c",
    "branch": "main",
    "environment": {
        "variables": {
            "APP_CONFIG": "'.$app_config.'",
            "APP_NAME": "'.$conv->appname.'",
            "APP_REFERENCE": "'.$reference.'",
            "APP_LOGO": "'.$conv->icon.'"
        },
        "groups": [
            "variable_group_1",
            "variable_group_2"
        ],
        "softwareVersions": {
            "xcode": "13.4.1",
            "flutter": "default"
        }
    }
}',
                CURLOPT_HTTPHEADER => array(
                    'x-auth-token: '.env('BUILD_APIKEY'),
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            echo $response;

//            dd($response);

//        {"buildId":"5fabc6414c483700143f4f92"}

            $resp=json_decode($response, true);

            $build->build_id=$resp['buildId'];
            $build->save();
        }

    }
}
