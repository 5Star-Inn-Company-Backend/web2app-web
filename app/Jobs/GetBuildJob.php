<?php

namespace App\Jobs;

use App\Mail\AppReadyMail;
use App\Models\Build;
use App\Models\convert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GetBuildJob implements ShouldQueue
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

        if($conv) {

            $build=Build::where(['reference_code' => $reference])->latest()->first();

            if($build){

                if($conv->plan=="premium"){
                    $auth=env('BUILD_APIKEY_PREMIUM');
                }else{
                    $auth=env('BUILD_APIKEY');
                }

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.codemagic.io/builds/'.$build->build_id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_HTTPHEADER => array(
                        'x-auth-token: ' . $auth
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
//                echo $response;

                $resp=json_decode($response, true);

                $build->server_response=$response;

                $android="";
                $aab="";
                $ios="";


                foreach ($resp['build']['artefacts'] as $artefact){
                    if($artefact['type'] == "apk") {
                        $android = $artefact['url'];
                    }

                    if($artefact['type'] == "aab") {
                        $aab = $artefact['url'];
                    }

                    if($artefact['type'] == "app") {
                        $ios = $artefact['url'];
                    }
                }

                $build->android_link=$android;
                $build->ios_link=$ios;
                $build->status=1;
                $build->save();

                if($conv->plan=="basic"){
                    $aab="";
                }

                $this->downloadAndSave($android,$reference,"apk",$auth);
                if($aab!= ""){
                    $this->downloadAndSave($aab,$reference,"aab",$auth);
                }
                if($ios != ""){
                    $this->downloadAndSave($ios,$reference,"zip",$auth);
                }

                $local_url_apk=route('bucket.download',[$reference,"apk"]);
                $local_url_aab=route('bucket.download',[$reference,"aab"]);
                $local_url_ios=route('bucket.download',[$reference,"zip"]);

                Mail::to($conv->email)->send(new AppReadyMail($reference, $local_url_apk, $local_url_aab, $local_url_ios));
            }
        }
    }

    private function downloadAndSave($url,$reference,$type,$auth)
    {

        $filename = "$reference.$type"; // Desired filename for the downloaded file

        $ch = curl_init($url);
        $fp = fopen(storage_path('app/public/artifacts/' . $filename), 'wb');

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);


        curl_setopt_array($ch, array(
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => array(
                'x-auth-token: ' . $auth
            ),
        ));


        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        return 'File downloaded and saved successfully!';
    }
}

//{
//    "application": {
//    "_id": "6309bcab44a74208bbd23469",
//    "appEnvironmentVariables": {
//        "groups": [],
//      "variables": []
//    },
//    "appName": "webtoapp",
//    "archived": false,
//    "branches": [
//        "main"
//    ],
//    "buildSchedule": [],
//    "createdAt": "2022-08-27T06:41:47.755+0000",
//    "customerInstance": null,
//    "fileWorkflowIds": [],
//    "iconUrl": null,
//    "isConfigured": true,
//    "lastBuildId": "6309dc8b44a7423e1ca0f9a4",
//    "ownerTeam": "6309bc6c32dfe1169cb1b222",
//    "preferUISettings": true,
//    "projectFiles": [
//        "."
//    ],
//    "projectType": "flutter-app",
//    "repository": {
//        "defaultBranch": "main",
//      "htmlUrl": "https://github.com/5star-company/webtoapp",
//      "id": 519475214,
//      "isAuthenticationEnabled": false,
//      "language": "Dart",
//      "owner": {
//            "name": "5star-company"
//      },
//      "provider": "github",
//      "publicSshKey": null,
//      "username": null
//    },
//    "settingsSource": "ui",
//    "tags": [],
//    "userRights": [
//        "delete"
//    ],
//    "workflowIds": [
//        "6309bcab44a74208bbd23468"
//    ],
//    "workflows": {
//        "6309bcab44a74208bbd23468": {
//            "_id": "6309bcab44a74208bbd23468",
//        "branchPatterns": [],
//        "buildSettings": {
//                "androidBuildOutputFormat": "aab+apk",
//          "automaticBuilds": false,
//          "buildOnPrUpdate": false,
//          "cancelPending": true,
//          "cancelPreviousBuilds": false,
//          "cocoapodsVersion": "default",
//          "flutterBuildSnap": false,
//          "flutterMode": "release",
//          "flutterPackageWindows": false,
//          "flutterVerbose": false,
//          "flutterVersion": "default",
//          "platforms": [
//                    "android",
//                    "ios"
//                ],
//          "projectFile": ".",
//          "tagBuilds": false,
//          "target": "debug",
//          "xcodeVersion": "latest"
//        },
//        "codeSigning": {
//                "android": {
//                    "enabled": true,
//            "keyAlias": "samji",
//            "keyPassword": "********",
//            "keystore": {
//                        "fileName": "samji-keystore.jks",
//              "filePath": "637fabe9-172d-4788-bfad-40eb5c72eeac/fd292eda-4a6f-4bd7-8ce8-c1895a48e578"
//            },
//            "keystorePassword": "********"
//          },
//          "ios": {
//                    "appStoreConnectKeyId": null,
//            "certificatePassword": null,
//            "developerCertificate": null,
//            "developerPortalBundleIdentifier": null,
//            "developerPortalPassword": null,
//            "developerPortalProfileType": null,
//            "developerPortalTeamId": null,
//            "developerPortalUsername": null,
//            "enabled": false,
//            "encryptedKey": null,
//            "provisioningProfiles": [],
//            "signingMethod": "none"
//          },
//          "macos": {
//                    "appCertificate": null,
//            "appCertificateEncryptedKey": null,
//            "appCertificatePassword": null,
//            "appStoreConnectKeyId": null,
//            "developerPortalBundleIdentifier": null,
//            "developerPortalPassword": null,
//            "developerPortalProfileType": null,
//            "developerPortalTeamId": null,
//            "enabled": null,
//            "installerCertificate": null,
//            "installerCertificateEncryptedKey": null,
//            "installerCertificatePassword": null,
//            "isMacCatalyst": false,
//            "provisioningProfiles": [],
//            "signingMethod": null
//          }
//        },
//        "customScripts": {
//                "postBuild": "curl https://web2app.5starcompany.com.ng/api/build/$APP_REFERENCE\nset -x",
//          "postClone": "",
//          "postPublish": "",
//          "postTest": "",
//          "preBuild": "# Write out the environment variable as a json file\necho $APP_CONFIG | base64 --decode > $FCI_BUILD_DIR/asset/appConfig.json\nwget -cO - $APP_LOGO > $FCI_BUILD_DIR/asset/logo.png\nflutter pub run rename --appname $APP_NAME\nflutter pub run rename --bundleId $APP_PACKAGE_NAME\nflutter pub run flutter_launcher_icons:main\nflutter pub run flutter_native_splash:create\ncat $FCI_BUILD_DIR/asset/appConfig.json\nset -x",
//          "prePublish": "",
//          "preTest": ""
//        },
//        "dependencyCache": {
//                "cachePaths": [],
//          "enabled": false
//        },
//        "environmentVariables": [
//          {
//              "id": "6309be9044a742cf068e3b53",
//            "name": "APP_NAME",
//            "secure": false,
//            "value": "WEB2APP"
//          },
//          {
//              "id": "6309be9044a742cf068e3b54",
//            "name": "APP_CONFIG",
//            "secure": false,
//            "value": "ewogICJwdWJsaWMiOiB7CiAgICAiYXBwTmFtZSI6ICJWaWRleCBBcHAiLAogICAgImluaXRpYWxVcmwiOiAiaHR0cHM6Ly90cml4d2FsbGV0LmNvbS9tb2JpbGVhcHAvIiwKICAgICJ1c2VyQWdlbnQiOiAid2ViMmFwcCIsCiAgICAicHJpbWFyeUNvbG9yIjogIkZGMDAwMCIsCiAgICAiZnVsbFNjcmVlbiI6IGZhbHNlLAogICAgImZvcmNlU2NyZWVuT3JpZW50YXRpb24iOiBmYWxzZQogIH0sCiAgIm5hdmlnYXRpb25zIjogewogICAgInRhYiI6IHsKICAgICAgIm1lbnVzIjogWwogICAgICAgIHsKICAgICAgICAgICJpY29uIjogIkljb25zLmhvbWUiLAogICAgICAgICAgImxhYmVsIjogIk1haW4iLAogICAgICAgICAgInVybCI6ICJodHRwczovL2dvbmF0aXZlLmlvIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgImljb24iOiAiSWNvbnMuaGlzdG9yeSIsCiAgICAgICAgICAibGFiZWwiOiAiQ3JlYXRlIEFjY291bnQiLAogICAgICAgICAgInVybCI6ICJodHRwczovL3RyaXh3YWxsZXQuY29tL21vYmlsZWFwcC9yZWdpc3RlciIKICAgICAgICB9LAogICAgICAgIHsKICAgICAgICAgICJzdWJMaW5rcyI6IFtdLAogICAgICAgICAgImljb24iOiAiSWNvbnMuaGlzdG9yeSIsCiAgICAgICAgICAibGFiZWwiOiAiR29OYXRpdmUgRGVtbyIsCiAgICAgICAgICAidXJsIjogImh0dHBzOi8vZ29uYXRpdmUuaW8vZGVtbyIKICAgICAgICB9CiAgICAgIF0sCiAgICAgICJhY3RpdmUiOiB0cnVlCiAgICB9LAogICAgImRyYXdlciI6IHsKICAgICAgIml0ZW1zIjogWwogICAgICAgIHsKICAgICAgICAgICJsYWJlbCI6ICJTYW1wbGUgSG9tZSIsCiAgICAgICAgICAidXJsIjogImh0dHBzOi8vZ29uYXRpdmUuaW8iLAogICAgICAgICAgImljb24iOiAiZmFzIGZhLWhvbWUiCiAgICAgICAgfSwKICAgICAgICB7CiAgICAgICAgICAibGFiZWwiOiAiU2FtcGxlIEFib3V0IiwKICAgICAgICAgICJ1cmwiOiAiaHR0cHM6Ly9nb25hdGl2ZS5pby9hYm91dCIsCiAgICAgICAgICAiaWNvbiI6ICJmYXMgZmEtdXNlciIKICAgICAgICB9CiAgICAgIF0sCiAgICAgICJhY3RpdmUiOiB0cnVlCiAgICB9LAogICAgImFuZHJvaWRQdWxsVG9SZWZyZXNoIjogZmFsc2UsCiAgICAiaW9zUHVsbFRvUmVmcmVzaCI6IHRydWUsCiAgICAibmF2aWdhdGlvblRpdGxlcyI6IHsKICAgICAgInRpdGxlcyI6IFsKICAgICAgICB7fQogICAgICBdLAogICAgICAiYWN0aXZlIjogZmFsc2UKICAgIH0sCiAgICAidG9vbGJhck5hdmlnYXRpb24iOiB7CiAgICAgICJpdGVtcyI6IFsKICAgICAgICB7CiAgICAgICAgICAic3lzdGVtIjogImJhY2siLAogICAgICAgICAgInRpdGxlIjogIkJhY2siCiAgICAgICAgfSwKICAgICAgICB7CiAgICAgICAgICAic3lzdGVtIjogImZvcndhcmQiLAogICAgICAgICAgInRpdGxlIjogIkZvcndhcmQiCiAgICAgICAgfSwKICAgICAgICB7CiAgICAgICAgICAic3lzdGVtIjogInJlZnJlc2giCiAgICAgICAgfQogICAgICBdCiAgICB9LAogICAgImFuZHJvaWRTaG93UmVmcmVzaEJ1dHRvbiI6IGZhbHNlLAogICAgImRlZXBMaW5rRG9tYWlucyI6IHsKICAgICAgImRvbWFpbnMiOiBbXSwKICAgICAgImVuYWJsZUFuZHJvaWRBcHBsaW5rcyI6IGZhbHNlCiAgICB9CiAgfSwKICAic3R5bGluZyI6IHsKICAgICJ0cmFuc2l0aW9uSW50ZXJhY3RpdmVEZWxheU1heCI6IDAuMiwKICAgICJtZW51QW5pbWF0aW9uRHVyYXRpb24iOiAwLjE1LAogICAgImFuZHJvaWRTaG93U3BsYXNoIjogdHJ1ZSwKICAgICJkaXNhYmxlQW5pbWF0aW9ucyI6IGZhbHNlLAogICAgImhpZGVXZWJ2aWV3QWxwaGEiOiAwLjUsCiAgICAic2hvd0FjdGlvbkJhciI6IHRydWUsCiAgICAic2hvd05hdmlnYXRpb25CYXIiOiB0cnVlLAogICAgImlvc1NpZGViYXJGb250IjogIkRlZmF1bHQiLAogICAgImFuZHJvaWRIaWRlVGl0bGVJbkFjdGlvbkJhciI6IHRydWUsCiAgICAibmF2aWdhdGlvblRpdGxlSW1hZ2UiOiB0cnVlLAogICAgImlvc1RoZW1lIjogImRlZmF1bHQiLAogICAgImFuZHJvaWRUaGVtZSI6ICJsaWdodCIsCiAgICAiYW5kcm9pZFNpZGViYXJCYWNrZ3JvdW5kQ29sb3IiOiAiI0ZGRkZGRiIsCiAgICAiYW5kcm9pZFNpZGViYXJGb3JlZ3JvdW5kQ29sb3IiOiAiIzFFNDk2RSIsCiAgICAiYW5kcm9pZEFjdGlvbkJhckJhY2tncm91bmRDb2xvciI6ICIjRkZGRkZGIiwKICAgICJhbmRyb2lkQWN0aW9uQmFyRm9yZWdyb3VuZENvbG9yIjogIiMxRTQ5NkUiLAogICAgImFuZHJvaWRQdWxsVG9SZWZyZXNoQ29sb3IiOiAiIzFFNDk2RSIsCiAgICAiYW5kcm9pZEFjY2VudENvbG9yIjogIiMxRTQ5NkUiLAogICAgImFuZHJvaWRTaWRlYmFyU2VwYXJhdG9yQ29sb3IiOiAiI0NDQ0NDQyIsCiAgICAiYW5kcm9pZFRhYkJhckJhY2tncm91bmRDb2xvciI6ICIjRkZGRkZGIiwKICAgICJhbmRyb2lkVGFiQmFyVGV4dENvbG9yIjogIiM5NDk0OTQiLAogICAgImFuZHJvaWRUYWJCYXJJbmRpY2F0b3JDb2xvciI6ICIjMUU0OTZFIiwKICAgICJhbmRyb2lkU3RhdHVzQmFyQmFja2dyb3VuZENvbG9yIjogIiM1QzVDNUMiLAogICAgImlvc1RpbnRDb2xvciI6ICIjMUU0OTZFIiwKICAgICJpb3NUaXRsZUNvbG9yIjogIiMxRTQ5NkUiLAogICAgImlvc1NpZGViYXJUZXh0Q29sb3IiOiAiIzFFNDk2RSIKICB9LAogICJwZXJtaXNzaW9ucyI6IHsKICAgICJ1c2VzR2VvbG9jYXRpb24iOiBmYWxzZSwKICAgICJhbmRyb2lkRG93bmxvYWRUb1B1YmxpY1N0b3JhZ2UiOiBmYWxzZSwKICAgICJlbmFibGVXZWJSVEMiOiBmYWxzZQogIH0sCiAgInBlcmZvcm1hbmNlIjogewogICAgIndlYnZpZXdQb29scyI6IFsKICAgICAgewogICAgICAgICJ1cmxzIjogWwogICAgICAgICAgewogICAgICAgICAgICAiZGlzb3duIjogInJlbG9hZCIKICAgICAgICAgIH0KICAgICAgICBdCiAgICAgIH0KICAgIF0KICB9LAogICJzZXJ2aWNlcyI6IHsKICB9Cn0="
//          },
//          {
//              "id": "6309be9044a742cf068e3b55",
//            "name": "APP_REFERENCE",
//            "secure": false,
//            "value": "1234"
//          },
//          {
//              "id": "6309be9044a742cf068e3b56",
//            "name": "APP_LOGO",
//            "secure": false,
//            "value": "https://5starcompany.com.ng/images/logo.png"
//          },
//          {
//              "id": "6309be9044a742cf068e3b57",
//            "name": "APP_PACKAGE_NAME",
//            "secure": false,
//            "value": "com.web2app"
//          }
//        ],
//        "instanceType": "mac_mini",
//        "isPublic": false,
//        "lastUpdated": {
//                "date": "2022-08-27T08:46:56.717+0000",
//          "user": {
//                    "email": "samjidiamond@gmail.com",
//            "name": "Samji Diamond"
//          }
//        },
//        "maxBuildDuration": 3600,
//        "name": "Default Workflow",
//        "publishers": {
//                "appStoreConnect": {
//                    "appStoreConnectKeyId": null,
//            "betaGroups": [],
//            "copyright": null,
//            "earliestReleaseDate": null,
//            "enabled": null,
//            "publishWhenFail": null,
//            "releaseType": null,
//            "submitToAppStore": false,
//            "submitToBetaGroups": false,
//            "submitToTestflight": false
//          },
//          "email": {
//                    "enabled": true,
//            "recipients": [
//                        "samjidiamond@gmail.com"
//                    ]
//          },
//          "firebase": {
//                    "android": {
//                        "appId": null,
//              "groups": []
//            },
//            "artifactType": "auto",
//            "authenticationMethod": "firebase_token",
//            "enabled": false,
//            "firebaseServiceAccount": null,
//            "firebaseToken": null,
//            "ios": {
//                        "appId": null,
//              "groups": []
//            },
//            "publishWhenFail": false
//          },
//          "googlePlay": {
//                    "changesNotSentForReview": false,
//            "credentials": {},
//            "customTrack": null,
//            "enabled": null,
//            "inAppUpdatePriority": null,
//            "publishWhenFail": null,
//            "rolloutFraction": null,
//            "submitAsDraft": null,
//            "track": null
//          },
//          "partnerCenter": {
//                    "clientId": null,
//            "clientSecret": null,
//            "enabled": null,
//            "msixArguments": {
//                        "name": null,
//              "publisher": null,
//              "publisherDisplayName": null,
//              "version": null
//            },
//            "partnerCenterTenantName": null,
//            "publishWhenFail": null,
//            "storeId": null,
//            "tenantId": null
//          },
//          "s3StaticPages": {},
//          "slack": {},
//          "snapcraft": {
//                    "channel": null,
//            "credentials": null,
//            "enabled": false,
//            "snapTitle": null
//          },
//          "staticPages": {}
//        },
//        "tagPatterns": [],
//        "testRunners": {
//                "dartCodeMetrics": {},
//          "flutterAnalyze": {},
//          "flutterDrive": {
//                    "frameworkType": "flutter_driver"
//          },
//          "flutterTest": {
//                    "frameworkType": "flutter_test"
//          },
//          "stopBuildIfTestsFail": true
//        }
//      }
//    }
//  },
//  "build": {
//    "_id": "6309dc8b44a7423e1ca0f9a4",
//    "appId": "6309bcab44a74208bbd23469",
//    "appStoreConnectTasks": [],
//    "artefacts": [
//      {
//          "name": "app-release.aab",
//        "size": 21699382,
//        "type": "aab",
//        "url": "https://static.codemagic.io/files/46d04291-1fd8-4559-8945-9c0159ed9c78/5394cf0f-8525-401c-a074-1b9898f8b73c/app-release.aab",
//        "version": "1.0.0",
//        "versionName": "1.0.0",
//        "version_code": "1"
//      },
//      {
//          "name": "app-release-universal.apk",
//        "size": 21558108,
//        "type": "apk",
//        "url": "https://static.codemagic.io/files/2c6215cc-6d2b-40a0-9804-e1011f67b0a5/32f0cafe-f873-4f0d-b322-8dba58ad299d/app-release-universal.apk",
//        "version": "1.0.0",
//        "versionName": "1.0.0",
//        "version_code": "1"
//      },
//      {
//          "name": "mapping.txt",
//        "size": 2093263,
//        "type": "proguard_map",
//        "url": "https://static.codemagic.io/files/487d6ea0-8f49-414c-9751-6ee52f5fe100/f668fc8b-962b-4442-a019-eb91ed3c2ea0/mapping.txt",
//        "version": null,
//        "versionName": null,
//        "version_code": null
//      },
//      {
//          "name": "Runner.app.zip",
//        "size": 84416538,
//        "type": "app",
//        "url": "https://static.codemagic.io/files/0d904c9f-9e07-48bf-9542-6e5267c0e2ae/408bf74c-20b2-4e32-89b5-d99966d7c2e2/Runner.app.zip",
//        "version": null,
//        "versionName": null,
//        "version_code": null
//      }
//    ],
//    "branch": "main",
//    "buildActions": [
//      {
//          "finishedAt": "2022-08-27T08:58:26.263+0000",
//        "logUrl": "https://static.codemagic.io/logs/17c05915-678c-4d4c-bfbc-905ca3c8fb2e/09435e88-8371-40a6-919c-d1112f6f5e8d",
//        "name": "Preparing build machine",
//        "results": [],
//        "startedAt": "2022-08-27T08:57:50.839+0000",
//        "status": "success",
//        "subactions": [],
//        "type": "preparing"
//      },
//      {
//          "finishedAt": "2022-08-27T08:58:31.868+0000",
//        "logUrl": "https://static.codemagic.io/logs/81d699f6-7cfa-480d-86ee-85d14e212c70/d7ae61fe-d536-43dc-8d9b-9882df887c03",
//        "name": "Fetching app sources",
//        "results": [],
//        "startedAt": "2022-08-27T08:58:26.263+0000",
//        "status": "success",
//        "subactions": [],
//        "type": "fetching"
//      },
//      {
//          "finishedAt": "2022-08-27T08:58:31.991+0000",
//        "logUrl": "https://static.codemagic.io/logs/f411c1fd-faba-4127-a1f5-334a53994e1a/33050329-b21b-45dd-b86c-2a59c19e584c",
//        "name": "Set up code signing identities",
//        "results": [],
//        "startedAt": "2022-08-27T08:58:31.868+0000",
//        "status": "success",
//        "subactions": [],
//        "type": "setupCodeSigning"
//      },
//      {
//          "finishedAt": "2022-08-27T09:00:19.037+0000",
//        "logUrl": "https://static.codemagic.io/logs/bb57d576-29b1-4fd4-bbf6-c265fe118fa3/37fc33fc-b76e-48bd-bbb6-3cefd195c447",
//        "name": "Installing dependencies",
//        "results": [],
//        "startedAt": "2022-08-27T08:58:31.991+0000",
//        "status": "success",
//        "subactions": [],
//        "type": "installing"
//      },
//      {
//          "finishedAt": "2022-08-27T09:00:42.282+0000",
//        "logUrl": null,
//        "name": "Pre-build script",
//        "results": [],
//        "startedAt": "2022-08-27T09:00:19.037+0000",
//        "status": "success",
//        "subactions": [
//          {
//              "command": "#!/usr/bin/env bash\n\n# Write out the environment variable as a json file\necho $APP_CONFIG | base64 --decode > $FCI_BUILD_DIR/asset/appConfig.json\nwget -cO - $APP_LOGO > $FCI_BUILD_DIR/asset/logo.png\nflutter pub run rename --appname $APP_NAME\nflutter pub run rename --bundleId $APP_PACKAGE_NAME\nflutter pub run flutter_launcher_icons:main\nflutter pub run flutter_native_splash:create\ncat $FCI_BUILD_DIR/asset/appConfig.json\nset -x",
//            "finishedAt": "2022-08-27T09:00:42.279+0000",
//            "logUrl": "https://static.codemagic.io/logs/f0b28db7-0ab1-4eba-aec3-6fab5049d389/d9a867fd-1b95-4815-92a4-05d105ed2472",
//            "startedAt": "2022-08-27T09:00:19.037+0000",
//            "status": "success"
//          }
//        ],
//        "type": "preBuild"
//      },
//      {
//          "finishedAt": "2022-08-27T09:05:39.585+0000",
//        "logUrl": "https://static.codemagic.io/logs/29f1a961-f7f7-479a-bba5-a554867fcbc5/b173b469-f736-4c67-a40f-906a19068478",
//        "name": "Building Android",
//        "results": [],
//        "startedAt": "2022-08-27T09:00:42.282+0000",
//        "status": "success",
//        "subactions": [],
//        "type": "buildingAndroid"
//      },
//      {
//          "finishedAt": "2022-08-27T09:09:02.138+0000",
//        "logUrl": "https://static.codemagic.io/logs/12ee58b7-81c0-4834-b98b-b64f739a784d/c045afc9-a9ac-4390-91b3-f0b0aed4c81b",
//        "name": "Building iOS",
//        "results": [],
//        "startedAt": "2022-08-27T09:05:39.585+0000",
//        "status": "success",
//        "subactions": [],
//        "type": "buildingIOS"
//      },
//      {
//          "finishedAt": "2022-08-27T09:09:03.615+0000",
//        "logUrl": null,
//        "name": "Post-build script",
//        "results": [],
//        "startedAt": "2022-08-27T09:09:02.138+0000",
//        "status": "success",
//        "subactions": [
//          {
//              "command": "#!/usr/bin/env bash\n\ncurl https://web2app.5starcompany.com.ng/api/build/$APP_REFERENCE\nset -x",
//            "finishedAt": "2022-08-27T09:09:03.610+0000",
//            "logUrl": "https://static.codemagic.io/logs/641da480-68f9-4dc4-8919-c8df6efd7bf8/8d595cfe-ee97-4f32-bd8c-19d0cd42b106",
//            "startedAt": "2022-08-27T09:09:02.138+0000",
//            "status": "success"
//          }
//        ],
//        "type": "postBuild"
//      },
//      {
//          "finishedAt": "2022-08-27T09:09:12.752+0000",
//        "logUrl": "https://static.codemagic.io/logs/aeb9dcb2-df27-48d8-a158-aa3bc2fe6889/6e3928cb-2be0-452e-b09d-4379e3a9a9c3",
//        "name": "Publishing",
//        "results": [],
//        "startedAt": "2022-08-27T09:09:03.615+0000",
//        "status": "success",
//        "subactions": [],
//        "type": "publishing"
//      },
//      {
//          "finishedAt": "2022-08-27T09:09:19.049+0000",
//        "logUrl": "https://static.codemagic.io/logs/2ddb6f58-b3eb-4d13-a9d1-9c6765a0c86f/9c768829-02f7-418a-abb9-4410174da47f",
//        "name": "Cleaning up",
//        "results": [],
//        "startedAt": "2022-08-27T09:09:12.752+0000",
//        "status": "success",
//        "subactions": [],
//        "type": "finishing"
//      }
//    ],
//    "commit": {
//        "authorAvatarUrl": "https://avatars.githubusercontent.com/u/62740154?v=4",
//      "authorEmail": "odejinmisa@newwavesecosystem.com",
//      "authorName": "odejinmisa",
//      "branch": "main",
//      "commitMessage": "push changes",
//      "hash": "5549a2362f1bc1361137cfe2c869e90cd94fa4c1",
//      "tag": null,
//      "url": "https://github.com/5star-company/webtoapp/commit/5549a2362f1bc1361137cfe2c869e90cd94fa4c1"
//    },
//    "config": {
//        "buildSettings": {
//            "flutterMode": "release",
//        "flutterPackageWindows": false,
//        "flutterVersion": "default",
//        "platforms": [
//                "android",
//                "ios"
//            ],
//        "stopBuildIfTestsFail": true,
//        "xcodeVersion": "13.4.1"
//      },
//      "name": "Default Workflow"
//    },
//    "createdAt": "2022-08-27T08:57:47.582+0000",
//    "dynamicConfig": {
//        "environment": {
//            "groups": [
//                "variable_group_1",
//                "variable_group_2"
//            ],
//        "softwareVersions": {
//                "flutter": "default",
//          "xcode": "13.4.1"
//        },
//        "variables": {
//                "APP_CONFIG": "ewogICJwdWJsaWMiOiB7CiAgICAiYXBwTmFtZSI6ICJSZW5vIE1vYmlsZSBNb25leSIsCiAgICAiaW5pdGlhbFVybCI6ICJodHRwczovL3Jlbm9tb2JpbGVtb25leS5jb20iLAogICAgInVzZXJBZ2VudCI6ICJ3ZWIyYXBwIiwKICAgICJwcmltYXJ5Q29sb3IiOiAiIzEwNDYwYyIsCiAgICAiZnVsbFNjcmVlbiI6IGZhbHNlLAogICAgImZvcmNlU2NyZWVuT3JpZW50YXRpb24iOiBmYWxzZQogIH0sCiAgIm5hdmlnYXRpb25zIjogewogICAgInRhYiI6IHsKICAgICAgIm1lbnVzIjogWwogICAgICAgIHsKICAgICAgICAgICJpY29uIjogIkljb25zLmhvbWUiLAogICAgICAgICAgImxhYmVsIjogIk1haW4iLAogICAgICAgICAgInVybCI6ICJodHRwczovL2dvbmF0aXZlLmlvIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgImljb24iOiAiSWNvbnMuaGlzdG9yeSIsCiAgICAgICAgICAibGFiZWwiOiAiQ3JlYXRlIEFjY291bnQiLAogICAgICAgICAgInVybCI6ICJodHRwczovL3RyaXh3YWxsZXQuY29tL21vYmlsZWFwcC9yZWdpc3RlciIKICAgICAgICB9LAogICAgICAgIHsKICAgICAgICAgICJzdWJMaW5rcyI6IFtdLAogICAgICAgICAgImljb24iOiAiSWNvbnMuaGlzdG9yeSIsCiAgICAgICAgICAibGFiZWwiOiAiR29OYXRpdmUgRGVtbyIsCiAgICAgICAgICAidXJsIjogImh0dHBzOi8vZ29uYXRpdmUuaW8vZGVtbyIKICAgICAgICB9CiAgICAgIF0sCiAgICAgICJhY3RpdmUiOiBmYWxzZQogICAgfSwKICAgICJkcmF3ZXIiOiB7CiAgICAgICJpdGVtcyI6IFsKICAgICAgICB7CiAgICAgICAgICAibGFiZWwiOiAiU2FtcGxlIEhvbWUiLAogICAgICAgICAgInVybCI6ICJodHRwczovL2dvbmF0aXZlLmlvIiwKICAgICAgICAgICJpY29uIjogImZhcyBmYS1ob21lIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgImxhYmVsIjogIlNhbXBsZSBBYm91dCIsCiAgICAgICAgICAidXJsIjogImh0dHBzOi8vZ29uYXRpdmUuaW8vYWJvdXQiLAogICAgICAgICAgImljb24iOiAiZmFzIGZhLXVzZXIiCiAgICAgICAgfQogICAgICBdLAogICAgICAiYWN0aXZlIjogZmFsc2UKICAgIH0sCiAgICAiYW5kcm9pZFB1bGxUb1JlZnJlc2giOiBmYWxzZSwKICAgICJpb3NQdWxsVG9SZWZyZXNoIjogdHJ1ZSwKICAgICJuYXZpZ2F0aW9uVGl0bGVzIjogewogICAgICAidGl0bGVzIjogWwogICAgICAgIHt9CiAgICAgIF0sCiAgICAgICJhY3RpdmUiOiBmYWxzZQogICAgfSwKICAgICJ0b29sYmFyTmF2aWdhdGlvbiI6IHsKICAgICAgIml0ZW1zIjogWwogICAgICAgIHsKICAgICAgICAgICJzeXN0ZW0iOiAiYmFjayIsCiAgICAgICAgICAidGl0bGUiOiAiQmFjayIKICAgICAgICB9LAogICAgICAgIHsKICAgICAgICAgICJzeXN0ZW0iOiAiZm9yd2FyZCIsCiAgICAgICAgICAidGl0bGUiOiAiRm9yd2FyZCIKICAgICAgICB9LAogICAgICAgIHsKICAgICAgICAgICJzeXN0ZW0iOiAicmVmcmVzaCIKICAgICAgICB9CiAgICAgIF0KICAgIH0sCiAgICAiYW5kcm9pZFNob3dSZWZyZXNoQnV0dG9uIjogZmFsc2UsCiAgICAiZGVlcExpbmtEb21haW5zIjogewogICAgICAiZG9tYWlucyI6IFtdLAogICAgICAiZW5hYmxlQW5kcm9pZEFwcGxpbmtzIjogZmFsc2UKICAgIH0KICB9LAogICJzdHlsaW5nIjogewogICAgInRyYW5zaXRpb25JbnRlcmFjdGl2ZURlbGF5TWF4IjogMC4yLAogICAgIm1lbnVBbmltYXRpb25EdXJhdGlvbiI6IDAuMTUsCiAgICAiYW5kcm9pZFNob3dTcGxhc2giOiB0cnVlLAogICAgImRpc2FibGVBbmltYXRpb25zIjogZmFsc2UsCiAgICAiaGlkZVdlYnZpZXdBbHBoYSI6IDAuNSwKICAgICJzaG93QWN0aW9uQmFyIjogdHJ1ZSwKICAgICJzaG93TmF2aWdhdGlvbkJhciI6IHRydWUsCiAgICAiaW9zU2lkZWJhckZvbnQiOiAiRGVmYXVsdCIsCiAgICAiYW5kcm9pZEhpZGVUaXRsZUluQWN0aW9uQmFyIjogdHJ1ZSwKICAgICJuYXZpZ2F0aW9uVGl0bGVJbWFnZSI6IHRydWUsCiAgICAiaW9zVGhlbWUiOiAiZGVmYXVsdCIsCiAgICAiYW5kcm9pZFRoZW1lIjogImxpZ2h0IiwKICAgICJhbmRyb2lkU2lkZWJhckJhY2tncm91bmRDb2xvciI6ICIjRkZGRkZGIiwKICAgICJhbmRyb2lkU2lkZWJhckZvcmVncm91bmRDb2xvciI6ICIjMUU0OTZFIiwKICAgICJhbmRyb2lkQWN0aW9uQmFyQmFja2dyb3VuZENvbG9yIjogIiNGRkZGRkYiLAogICAgImFuZHJvaWRBY3Rpb25CYXJGb3JlZ3JvdW5kQ29sb3IiOiAiIzFFNDk2RSIsCiAgICAiYW5kcm9pZFB1bGxUb1JlZnJlc2hDb2xvciI6ICIjMUU0OTZFIiwKICAgICJhbmRyb2lkQWNjZW50Q29sb3IiOiAiIzFFNDk2RSIsCiAgICAiYW5kcm9pZFNpZGViYXJTZXBhcmF0b3JDb2xvciI6ICIjQ0NDQ0NDIiwKICAgICJhbmRyb2lkVGFiQmFyQmFja2dyb3VuZENvbG9yIjogIiNGRkZGRkYiLAogICAgImFuZHJvaWRUYWJCYXJUZXh0Q29sb3IiOiAiIzk0OTQ5NCIsCiAgICAiYW5kcm9pZFRhYkJhckluZGljYXRvckNvbG9yIjogIiMxRTQ5NkUiLAogICAgImFuZHJvaWRTdGF0dXNCYXJCYWNrZ3JvdW5kQ29sb3IiOiAiIzVDNUM1QyIsCiAgICAiaW9zVGludENvbG9yIjogIiMxRTQ5NkUiLAogICAgImlvc1RpdGxlQ29sb3IiOiAiIzFFNDk2RSIsCiAgICAiaW9zU2lkZWJhclRleHRDb2xvciI6ICIjMUU0OTZFIgogIH0sCiAgInBlcm1pc3Npb25zIjogewogICAgInVzZXNHZW9sb2NhdGlvbiI6IGZhbHNlLAogICAgImFuZHJvaWREb3dubG9hZFRvUHVibGljU3RvcmFnZSI6IGZhbHNlLAogICAgImVuYWJsZVdlYlJUQyI6IGZhbHNlCiAgfSwKICAicGVyZm9ybWFuY2UiOiB7CiAgICAid2Vidmlld1Bvb2xzIjogWwogICAgICB7CiAgICAgICAgInVybHMiOiBbCiAgICAgICAgICB7CiAgICAgICAgICAgICJkaXNvd24iOiAicmVsb2FkIgogICAgICAgICAgfQogICAgICAgIF0KICAgICAgfQogICAgXQogIH0sCiAgInNlcnZpY2VzIjogewogIH0KfQ==",
//          "APP_LOGO": "https://renomobilemoney.com/land/assets/img/logo.png",
//          "APP_NAME": "Reno Mobile Money",
//          "APP_PACKAGE_NAME": "com.renomoney.test",
//          "APP_REFERENCE": "web2app_6309dc68a82771258966489"
//        }
//      }
//    },
//    "feedback": null,
//    "fileWorkflowId": null,
//    "finishedAt": "2022-08-27T09:09:19.049+0000",
//    "index": 3,
//    "instanceType": "mac_mini",
//    "labels": [],
//    "message": null,
//    "pullRequest": null,
//    "scheduledBuildId": null,
//    "screenshots": null,
//    "sshAccess": null,
//    "sshAccessEnabled": false,
//    "startedAt": "2022-08-27T08:57:50.839+0000",
//    "status": "finished",
//    "tag": null,
//    "version": "1.0.0",
//    "vncAccess": null,
//    "workflowId": "6309bcab44a74208bbd23468"
//  }
//}
