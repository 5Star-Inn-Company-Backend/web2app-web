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

        $conv=convert::where(['reference_code' => $reference, 'status' => 1])->latest()->first();

        if($conv){
            $fullscreen=strtolower($conv->fullscreen) == 'no' ? "false" : "true";
            $enableAdvt=strtolower($conv->plan) == 'free' ? "true" : "false";

            $tabLinks=json_decode($conv->tabLinks, true);
            $tabNames=json_decode($conv->tabNames, true);
            $tabIcons=json_decode($conv->tabIcons, true);

            $menus=[];
            $enableMenu="false";

            for($i=0;$i<count($tabLinks);$i++){
                if($tabIcons[$i] != null && $tabNames[$i] != null) {
                    $tab['icon'] = $tabIcons[$i];
                    $tab['label'] = $tabNames[$i];
                    $tab['url'] = $tabLinks[$i];
                    array_push($menus, $tab);
                    $enableMenu="true";
                }
            }


            $config='{
  "public": {
    "appName": "'.$conv->appname.'",
    "initialUrl": "'.$conv->url.'",
    "userAgent": "web2app",
    "primaryColor": "'.$conv->primarycolor.'",
    "fullScreen": '.$fullscreen.',
    "forceScreenOrientation": false,
    "enableAdvt": '.$enableAdvt.'
  },
  "navigations": {
    "tab": {
      "menus": '.json_encode($menus).',
      "active": '.$enableMenu.'
    },
    "drawer": {
      "items": [
        {
          "label": "Sample Home",
          "url": "https://trixwallet.com",
          "icon": "fas fa-home"
        },
        {
          "label": "Sample About",
          "url": "https://trixwallet.com/about",
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
    },
    "dynamicLink": {
      "enableDynamicLink": true,
      "uriPrefix": "https://web2app.page.link",
      "linkPrefix": "https://web2app.app/link",
      "android" : {
        "enable": true,
        "packageName": "'.$conv->packagename.'",
        "minimumVersion": "1"
      },
      "ios" : {
        "enable": true,
        "bundleId": "'.$conv->packagename.'",
        "minimumVersion": "1"
      }
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
            $packageName=strtolower($conv->plan) == 'free' ? "com.web2app" : $conv->packagename;
            $build=Build::create($input);
            $firebase=base64_encode($conv->firebase);

            if($conv->plan=="premium"){
                $appId=env('BUILD_APPID_PREMIUM');
                $workflowId=env('BUILD_WORKFLOWID_PREMIUM');
                $auth=env('BUILD_APIKEY_PREMIUM');
            }else{
                $appId=env('BUILD_APPID');
                $workflowId=env('BUILD_WORKFLOWID');
                $auth=env('BUILD_APIKEY');
            }
            $xcode_version=env('BUILD_XCODE_VERSION', "latest");
            $branch=env('BUILD_BRANCH', "main");

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
    "appId": "'.$appId.'",
    "workflowId": "'.$workflowId.'",
    "branch": "'.$branch.'",
    "environment": {
        "variables": {
            "APP_CONFIG": "'.$app_config.'",
            "APP_NAME": "'.$conv->appname.'",
            "APP_PACKAGE_NAME": "'.$packageName.'",
            "APP_REFERENCE": "'.$reference.'",
            "APP_LOGO": "'.$conv->icon.'",
            "APP_FIREBASE": "'.$firebase.'"
        },
        "groups": [
            "variable_group_1",
            "variable_group_2"
        ]
    }
}',
                CURLOPT_HTTPHEADER => array(
                    'x-auth-token: '.$auth,
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
