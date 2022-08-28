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

                Mail::to($conv->email)->send(new AppReadyMail($reference, $android, $aab, $ios));
            }
        }
    }
}

//{
//    "application": {
//    "_id": "62e4fc24f9c684a19c46b49d",
//        "appEnvironmentVariables": {
//        "groups": [],
//            "variables": []
//        },
//        "appName": "webtoapp",
//        "archived": false,
//        "branches": [
//        "main"
//    ],
//        "buildSchedule": [],
//        "createdAt": "2022-07-30T09:38:44.217+0000",
//        "customerInstance": null,
//        "fileWorkflowIds": [],
//        "iconUrl": null,
//        "isConfigured": true,
//        "lastBuildId": "62e52825f9c684b54923d1ec",
//        "ownerTeam": "62e4f312f9c684a769aed529",
//        "preferUISettings": true,
//        "projectFiles": [
//        "."
//    ],
//        "projectType": "flutter-app",
//        "repository": {
//        "defaultBranch": "main",
//            "htmlUrl": "https://github.com/5star-company/webtoapp",
//            "id": 519475214,
//            "isAuthenticationEnabled": false,
//            "language": null,
//            "owner": {
//            "name": "5star-company"
//            },
//            "provider": "github",
//            "publicSshKey": null,
//            "username": null
//        },
//        "settingsSource": "ui",
//        "tags": [],
//        "userRights": [
//        "delete"
//    ],
//        "workflowIds": [
//        "62e4fc24f9c684a19c46b49c"
//    ],
//        "workflows": {
//        "62e4fc24f9c684a19c46b49c": {
//            "_id": "62e4fc24f9c684a19c46b49c",
//                "branchPatterns": [],
//                "buildSettings": {
//                "androidBuildOutputFormat": "aab+apk",
//                    "automaticBuilds": false,
//                    "buildOnPrUpdate": false,
//                    "cancelPending": true,
//                    "cancelPreviousBuilds": false,
//                    "flutterBuildSnap": false,
//                    "flutterMode": "release",
//                    "flutterPackageWindows": false,
//                    "flutterVerbose": false,
//                    "flutterVersion": "default",
//                    "platforms": [
//                    "android"
//                ],
//                    "projectFile": ".",
//                    "tagBuilds": false,
//                    "target": "debug",
//                    "xcodeVersion": "latest"
//                },
//                "codeSigning": {
//                "android": {
//                    "enabled": true,
//                        "keyAlias": "samji",
//                        "keyPassword": "********",
//                        "keystore": {
//                        "fileName": "samji-keystore.jks",
//                            "filePath": "66300dc7-68dd-4912-b89d-1ef28041059a/5ded424a-d153-4a80-aabc-3b234260789e"
//                        },
//                        "keystorePassword": "********"
//                    },
//                    "ios": {
//                    "appStoreConnectKeyId": null,
//                        "certificatePassword": null,
//                        "developerCertificate": null,
//                        "developerPortalBundleIdentifier": null,
//                        "developerPortalPassword": null,
//                        "developerPortalProfileType": null,
//                        "developerPortalTeamId": null,
//                        "developerPortalUsername": null,
//                        "enabled": null,
//                        "encryptedKey": null,
//                        "provisioningProfiles": [],
//                        "signingMethod": null
//                    },
//                    "macos": {
//                    "appCertificate": null,
//                        "appCertificateEncryptedKey": null,
//                        "appCertificatePassword": null,
//                        "appStoreConnectKeyId": null,
//                        "developerPortalBundleIdentifier": null,
//                        "developerPortalPassword": null,
//                        "developerPortalProfileType": null,
//                        "developerPortalTeamId": null,
//                        "enabled": null,
//                        "installerCertificate": null,
//                        "installerCertificateEncryptedKey": null,
//                        "installerCertificatePassword": null,
//                        "isMacCatalyst": false,
//                        "provisioningProfiles": [],
//                        "signingMethod": null
//                    }
//                },
//                "customScripts": {
//                "postBuild": "curl https://web2app.5starcompany.com.ng/api/build/$APP_REFERENCE\nset -x",
//                    "postClone": "",
//                    "postPublish": "",
//                    "postTest": "",
//                    "preBuild": "# Write out the environment variable as a json file\necho $APP_CONFIG | base64 --decode > $FCI_BUILD_DIR/asset/appConfig.json\ncat $FCI_BUILD_DIR/asset/appConfig.json\nset -x",
//                    "prePublish": "",
//                    "preTest": ""
//                },
//                "dependencyCache": {
//                "cachePaths": [],
//                    "enabled": false
//                },
//                "environmentVariables": [
//                    {
//                        "id": "630725e6fd736ae8d743b633",
//                        "name": "APP_REFERENCE",
//                        "secure": false,
//                        "value": "1234"
//                    },
//                    {
//                        "id": "62e51483245e61dbd4875094",
//                        "name": "APP_CONFIG",
//                        "secure": false,
//                        "value": "ewogICJwdWJsaWMiOiB7CiAgICAiYXBwTmFtZSI6ICJWaWRleCBBcHAiLAogICAgImluaXRpYWxVcmwiOiAiaHR0cHM6Ly90cml4d2FsbGV0LmNvbS9tb2JpbGVhcHAvIiwKICAgICJ1c2VyQWdlbnQiOiAid2ViMmFwcCIsCiAgICAicHJpbWFyeUNvbG9yIjogIkZGMDAwMCIsCiAgICAiZnVsbFNjcmVlbiI6IGZhbHNlLAogICAgImZvcmNlU2NyZWVuT3JpZW50YXRpb24iOiBmYWxzZQogIH0sCiAgIm5hdmlnYXRpb25zIjogewogICAgInRhYiI6IHsKICAgICAgIm1lbnVzIjogWwogICAgICAgIHsKICAgICAgICAgICJpY29uIjogIkljb25zLmhvbWUiLAogICAgICAgICAgImxhYmVsIjogIk1haW4iLAogICAgICAgICAgInVybCI6ICJodHRwczovL2dvbmF0aXZlLmlvIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgImljb24iOiAiSWNvbnMuaGlzdG9yeSIsCiAgICAgICAgICAibGFiZWwiOiAiQ3JlYXRlIEFjY291bnQiLAogICAgICAgICAgInVybCI6ICJodHRwczovL3RyaXh3YWxsZXQuY29tL21vYmlsZWFwcC9yZWdpc3RlciIKICAgICAgICB9LAogICAgICAgIHsKICAgICAgICAgICJzdWJMaW5rcyI6IFtdLAogICAgICAgICAgImljb24iOiAiSWNvbnMuaGlzdG9yeSIsCiAgICAgICAgICAibGFiZWwiOiAiR29OYXRpdmUgRGVtbyIsCiAgICAgICAgICAidXJsIjogImh0dHBzOi8vZ29uYXRpdmUuaW8vZGVtbyIKICAgICAgICB9CiAgICAgIF0sCiAgICAgICJhY3RpdmUiOiB0cnVlCiAgICB9LAogICAgImRyYXdlciI6IHsKICAgICAgIml0ZW1zIjogWwogICAgICAgIHsKICAgICAgICAgICJsYWJlbCI6ICJTYW1wbGUgSG9tZSIsCiAgICAgICAgICAidXJsIjogImh0dHBzOi8vZ29uYXRpdmUuaW8iLAogICAgICAgICAgImljb24iOiAiZmFzIGZhLWhvbWUiCiAgICAgICAgfSwKICAgICAgICB7CiAgICAgICAgICAibGFiZWwiOiAiU2FtcGxlIEFib3V0IiwKICAgICAgICAgICJ1cmwiOiAiaHR0cHM6Ly9nb25hdGl2ZS5pby9hYm91dCIsCiAgICAgICAgICAiaWNvbiI6ICJmYXMgZmEtdXNlciIKICAgICAgICB9CiAgICAgIF0sCiAgICAgICJhY3RpdmUiOiB0cnVlCiAgICB9LAogICAgImFuZHJvaWRQdWxsVG9SZWZyZXNoIjogZmFsc2UsCiAgICAiaW9zUHVsbFRvUmVmcmVzaCI6IHRydWUsCiAgICAibmF2aWdhdGlvblRpdGxlcyI6IHsKICAgICAgInRpdGxlcyI6IFsKICAgICAgICB7fQogICAgICBdLAogICAgICAiYWN0aXZlIjogZmFsc2UKICAgIH0sCiAgICAidG9vbGJhck5hdmlnYXRpb24iOiB7CiAgICAgICJpdGVtcyI6IFsKICAgICAgICB7CiAgICAgICAgICAic3lzdGVtIjogImJhY2siLAogICAgICAgICAgInRpdGxlIjogIkJhY2siCiAgICAgICAgfSwKICAgICAgICB7CiAgICAgICAgICAic3lzdGVtIjogImZvcndhcmQiLAogICAgICAgICAgInRpdGxlIjogIkZvcndhcmQiCiAgICAgICAgfSwKICAgICAgICB7CiAgICAgICAgICAic3lzdGVtIjogInJlZnJlc2giCiAgICAgICAgfQogICAgICBdCiAgICB9LAogICAgImFuZHJvaWRTaG93UmVmcmVzaEJ1dHRvbiI6IGZhbHNlLAogICAgImRlZXBMaW5rRG9tYWlucyI6IHsKICAgICAgImRvbWFpbnMiOiBbXSwKICAgICAgImVuYWJsZUFuZHJvaWRBcHBsaW5rcyI6IGZhbHNlCiAgICB9CiAgfSwKICAic3R5bGluZyI6IHsKICAgICJ0cmFuc2l0aW9uSW50ZXJhY3RpdmVEZWxheU1heCI6IDAuMiwKICAgICJtZW51QW5pbWF0aW9uRHVyYXRpb24iOiAwLjE1LAogICAgImFuZHJvaWRTaG93U3BsYXNoIjogdHJ1ZSwKICAgICJkaXNhYmxlQW5pbWF0aW9ucyI6IGZhbHNlLAogICAgImhpZGVXZWJ2aWV3QWxwaGEiOiAwLjUsCiAgICAic2hvd0FjdGlvbkJhciI6IHRydWUsCiAgICAic2hvd05hdmlnYXRpb25CYXIiOiB0cnVlLAogICAgImlvc1NpZGViYXJGb250IjogIkRlZmF1bHQiLAogICAgImFuZHJvaWRIaWRlVGl0bGVJbkFjdGlvbkJhciI6IHRydWUsCiAgICAibmF2aWdhdGlvblRpdGxlSW1hZ2UiOiB0cnVlLAogICAgImlvc1RoZW1lIjogImRlZmF1bHQiLAogICAgImFuZHJvaWRUaGVtZSI6ICJsaWdodCIsCiAgICAiYW5kcm9pZFNpZGViYXJCYWNrZ3JvdW5kQ29sb3IiOiAiI0ZGRkZGRiIsCiAgICAiYW5kcm9pZFNpZGViYXJGb3JlZ3JvdW5kQ29sb3IiOiAiIzFFNDk2RSIsCiAgICAiYW5kcm9pZEFjdGlvbkJhckJhY2tncm91bmRDb2xvciI6ICIjRkZGRkZGIiwKICAgICJhbmRyb2lkQWN0aW9uQmFyRm9yZWdyb3VuZENvbG9yIjogIiMxRTQ5NkUiLAogICAgImFuZHJvaWRQdWxsVG9SZWZyZXNoQ29sb3IiOiAiIzFFNDk2RSIsCiAgICAiYW5kcm9pZEFjY2VudENvbG9yIjogIiMxRTQ5NkUiLAogICAgImFuZHJvaWRTaWRlYmFyU2VwYXJhdG9yQ29sb3IiOiAiI0NDQ0NDQyIsCiAgICAiYW5kcm9pZFRhYkJhckJhY2tncm91bmRDb2xvciI6ICIjRkZGRkZGIiwKICAgICJhbmRyb2lkVGFiQmFyVGV4dENvbG9yIjogIiM5NDk0OTQiLAogICAgImFuZHJvaWRUYWJCYXJJbmRpY2F0b3JDb2xvciI6ICIjMUU0OTZFIiwKICAgICJhbmRyb2lkU3RhdHVzQmFyQmFja2dyb3VuZENvbG9yIjogIiM1QzVDNUMiLAogICAgImlvc1RpbnRDb2xvciI6ICIjMUU0OTZFIiwKICAgICJpb3NUaXRsZUNvbG9yIjogIiMxRTQ5NkUiLAogICAgImlvc1NpZGViYXJUZXh0Q29sb3IiOiAiIzFFNDk2RSIKICB9LAogICJwZXJtaXNzaW9ucyI6IHsKICAgICJ1c2VzR2VvbG9jYXRpb24iOiBmYWxzZSwKICAgICJhbmRyb2lkRG93bmxvYWRUb1B1YmxpY1N0b3JhZ2UiOiBmYWxzZSwKICAgICJlbmFibGVXZWJSVEMiOiBmYWxzZQogIH0sCiAgInBlcmZvcm1hbmNlIjogewogICAgIndlYnZpZXdQb29scyI6IFsKICAgICAgewogICAgICAgICJ1cmxzIjogWwogICAgICAgICAgewogICAgICAgICAgICAiZGlzb3duIjogInJlbG9hZCIKICAgICAgICAgIH0KICAgICAgICBdCiAgICAgIH0KICAgIF0KICB9LAogICJzZXJ2aWNlcyI6IHsKICB9Cn0="
//                    },
//                    {
//                        "id": "62e4fdddf9c684f39e0077b3",
//                        "name": "APP_NAME",
//                        "secure": false,
//                        "value": "WEB2APP"
//                    }
//                ],
//                "instanceType": "mac_mini",
//                "isPublic": false,
//                "lastUpdated": {
//                "date": "2022-08-25T08:19:36.027+0000",
//                    "user": {
//                    "email": "odejinmisamuel@gmail.com",
//                        "name": "Odejinmi Samuel"
//                    }
//                },
//                "maxBuildDuration": 3600,
//                "name": "Default Workflow",
//                "publishers": {
//                "appStoreConnect": {
//                    "appStoreConnectKeyId": null,
//                        "betaGroups": [],
//                        "copyright": null,
//                        "earliestReleaseDate": null,
//                        "enabled": null,
//                        "publishWhenFail": null,
//                        "releaseType": null,
//                        "submitToAppStore": false,
//                        "submitToBetaGroups": false,
//                        "submitToTestflight": false
//                    },
//                    "email": {
//                    "enabled": true,
//                        "recipients": [
//                        "odejinmisamuel@gmail.com"
//                    ]
//                    },
//                    "firebase": {
//                    "android": {
//                        "appId": null,
//                            "groups": []
//                        },
//                        "artifactType": "auto",
//                        "authenticationMethod": "firebase_token",
//                        "enabled": false,
//                        "firebaseServiceAccount": null,
//                        "firebaseToken": null,
//                        "ios": {
//                        "appId": null,
//                            "groups": []
//                        },
//                        "publishWhenFail": false
//                    },
//                    "googlePlay": {
//                    "changesNotSentForReview": false,
//                        "credentials": {},
//                        "customTrack": null,
//                        "enabled": null,
//                        "inAppUpdatePriority": null,
//                        "publishWhenFail": null,
//                        "rolloutFraction": null,
//                        "submitAsDraft": null,
//                        "track": null
//                    },
//                    "partnerCenter": {
//                    "clientId": null,
//                        "clientSecret": null,
//                        "enabled": null,
//                        "msixArguments": {
//                        "name": null,
//                            "publisher": null,
//                            "publisherDisplayName": null,
//                            "version": null
//                        },
//                        "partnerCenterTenantName": null,
//                        "publishWhenFail": null,
//                        "storeId": null,
//                        "tenantId": null
//                    },
//                    "s3StaticPages": {},
//                    "slack": {},
//                    "snapcraft": {
//                    "channel": null,
//                        "credentials": null,
//                        "enabled": false,
//                        "snapTitle": null
//                    },
//                    "staticPages": {}
//                },
//                "tagPatterns": [],
//                "testRunners": {
//                "dartCodeMetrics": {},
//                    "flutterAnalyze": {},
//                    "flutterDrive": {
//                    "frameworkType": "flutter_driver"
//                    },
//                    "flutterTest": {
//                    "frameworkType": "flutter_test"
//                    },
//                    "stopBuildIfTestsFail": true
//                }
//            }
//        }
//    },
//    "build": {
//    "_id": "62e52825f9c684b54923d1ec",
//        "appId": "62e4fc24f9c684a19c46b49d",
//        "appStoreConnectTasks": [],
//        "artefacts": [
//            {
//                "name": "app-debug.apk",
//                "size": 74976687,
//                "type": "apk",
//                "url": "https://static.codemagic.io/files/18b4f50d-a7ba-4d35-9257-31694583373d/e8386cc8-d2ff-4f5c-ac3c-7464685e3203/app-debug.apk",
//                "version": "1.0.0",
//                "versionName": "1.0.0",
//                "version_code": "1"
//            },
//            {
//                "name": "webview_flutter_android-debug.aar",
//                "size": 34456,
//                "type": "aar",
//                "url": "https://static.codemagic.io/files/e9f8e222-6237-48c7-a0b5-1d13482aac97/a3be8088-7c31-47dd-a6d6-f4eb5f3aee7c/webview_flutter_android-debug.aar",
//                "version": null,
//                "versionName": null,
//                "version_code": null
//            },
//            {
//                "name": "google_mobile_ads-debug.aar",
//                "size": 75267,
//                "type": "aar",
//                "url": "https://static.codemagic.io/files/e2ac6018-1591-4018-8095-c69effa513c3/fff4a415-133b-491e-b21f-c70d939b8383/google_mobile_ads-debug.aar",
//                "version": null,
//                "versionName": null,
//                "version_code": null
//            },
//            {
//                "name": "path_provider_android-debug.aar",
//                "size": 13235,
//                "type": "aar",
//                "url": "https://static.codemagic.io/files/124f948a-8c20-4f99-b336-c4e78f1cb53e/4bae3f07-4aa4-4419-aba2-0f511b7470cd/path_provider_android-debug.aar",
//                "version": null,
//                "versionName": null,
//                "version_code": null
//            }
//        ],
//        "branch": "main",
//        "buildActions": [
//            {
//                "finishedAt": "2022-07-30T12:47:07.772+0000",
//                "logUrl": "https://static.codemagic.io/logs/983c6553-f29f-4f82-bb16-46379e2dd02d/1c0398de-e0bd-419c-99bb-29225bccae7f",
//                "name": "Preparing build machine",
//                "results": [],
//                "startedAt": "2022-07-30T12:46:31.290+0000",
//                "status": "success",
//                "subactions": [],
//                "type": "preparing"
//            },
//            {
//                "finishedAt": "2022-07-30T12:47:12.643+0000",
//                "logUrl": "https://static.codemagic.io/logs/36ea1127-3694-4cf7-99ee-11693438f25b/8f26268e-d221-445f-8be6-c5e0c69745ee",
//                "name": "Fetching app sources",
//                "results": [],
//                "startedAt": "2022-07-30T12:47:07.772+0000",
//                "status": "success",
//                "subactions": [],
//                "type": "fetching"
//            },
//            {
//                "finishedAt": "2022-07-30T12:47:12.773+0000",
//                "logUrl": "https://static.codemagic.io/logs/41e763eb-ff76-4f12-a33b-19cb00e309f1/755ea7f4-84b3-4b86-8d56-940abfc83d3a",
//                "name": "Set up code signing identities",
//                "results": [],
//                "startedAt": "2022-07-30T12:47:12.643+0000",
//                "status": "success",
//                "subactions": [],
//                "type": "setupCodeSigning"
//            },
//            {
//                "finishedAt": "2022-07-30T12:48:22.824+0000",
//                "logUrl": "https://static.codemagic.io/logs/cf5e0ea5-7bc6-487a-8dde-55520088e782/93a75f69-2722-4233-9576-1df246412990",
//                "name": "Installing dependencies",
//                "results": [],
//                "startedAt": "2022-07-30T12:47:12.773+0000",
//                "status": "success",
//                "subactions": [],
//                "type": "installing"
//            },
//            {
//                "finishedAt": "2022-07-30T12:48:22.964+0000",
//                "logUrl": null,
//                "name": "Pre-build script",
//                "results": [],
//                "startedAt": "2022-07-30T12:48:22.824+0000",
//                "status": "success",
//                "subactions": [
//                    {
//                        "command": "#!/usr/bin/env bash\n\n# Write out the environment variable as a json file\necho $APP_CONFIG | base64 --decode > $FCI_BUILD_DIR/asset/appConfig.json\ncat $FCI_BUILD_DIR/asset/appConfig.json\nset -x",
//                        "finishedAt": "2022-07-30T12:48:22.961+0000",
//                        "logUrl": "https://static.codemagic.io/logs/bcc1fb5b-853c-42d0-8d7c-94e17bdf94ad/90e1ff3e-6430-447f-9cb7-7f86325ee03d",
//                        "startedAt": "2022-07-30T12:48:22.824+0000",
//                        "status": "success"
//                    }
//                ],
//                "type": "preBuild"
//            },
//            {
//                "finishedAt": "2022-07-30T12:51:42.165+0000",
//                "logUrl": "https://static.codemagic.io/logs/2d3b5ffb-3143-4048-9d5e-37e7c6c33986/711ab77d-e59e-417b-93e6-69753392d689",
//                "name": "Building Android",
//                "results": [],
//                "startedAt": "2022-07-30T12:48:22.964+0000",
//                "status": "success",
//                "subactions": [],
//                "type": "buildingAndroid"
//            },
//            {
//                "finishedAt": "2022-07-30T12:51:44.557+0000",
//                "logUrl": "https://static.codemagic.io/logs/e84c6a22-9521-43a4-ae0c-bf411db688ee/fdc93fa8-c0f7-45de-b61f-cc32bbe7cb22",
//                "name": "Publishing",
//                "results": [],
//                "startedAt": "2022-07-30T12:51:42.165+0000",
//                "status": "success",
//                "subactions": [],
//                "type": "publishing"
//            },
//            {
//                "finishedAt": "2022-07-30T12:51:50.765+0000",
//                "logUrl": "https://static.codemagic.io/logs/97c71613-d586-4c24-8d42-1c5198c254f3/e177e4a2-f330-49c7-aaf1-b31b951fc560",
//                "name": "Cleaning up",
//                "results": [],
//                "startedAt": "2022-07-30T12:51:44.557+0000",
//                "status": "success",
//                "subactions": [],
//                "type": "finishing"
//            }
//        ],
//        "commit": {
//        "authorAvatarUrl": "https://avatars.githubusercontent.com/u/62740154?v=4",
//            "authorEmail": "odejinmisa@newwavesecosystem.com",
//            "authorName": "odejinmisa",
//            "branch": "main",
//            "commitMessage": "Merge remote-tracking branch 'origin/main' into main",
//            "hash": "c8379ab76e4c4b28f581a605e41b56b46188aa52",
//            "tag": null,
//            "url": "https://github.com/5star-company/webtoapp/commit/c8379ab76e4c4b28f581a605e41b56b46188aa52"
//        },
//        "config": {
//        "buildSettings": {
//            "flutterMode": "debug",
//                "flutterPackageWindows": false,
//                "flutterVersion": "default",
//                "platforms": [
//                "android"
//            ],
//                "stopBuildIfTestsFail": true,
//                "xcodeVersion": "13.4.1"
//            },
//            "name": "Default Workflow"
//        },
//        "createdAt": "2022-07-30T12:46:29.383+0000",
//        "dynamicConfig": {
//        "environment": {
//            "groups": [
//                "variable_group_1",
//                "variable_group_2"
//            ],
//                "softwareVersions": {
//                "flutter": "default",
//                    "xcode": "13.4.1"
//                },
//                "variables": {
//                "APP_CONFIG": "ewogICJwdWJsaWMiOiB7CiAgICAiYXBwTmFtZSI6ICJBUEkgQXBwIiwKICAgICJpbml0aWFsVXJsIjogImh0dHBzOi8vdHJpeHdhbGxldC5jb20vbW9iaWxlYXBwLyIsCiAgICAidXNlckFnZW50IjogIndlYjJhcHAiLAogICAgInByaW1hcnlDb2xvciI6ICJGRkZGMDAiLAogICAgImZ1bGxTY3JlZW4iOiBmYWxzZSwKICAgICJmb3JjZVNjcmVlbk9yaWVudGF0aW9uIjogZmFsc2UKICB9LAogICJuYXZpZ2F0aW9ucyI6IHsKICAgICJ0YWIiOiB7CiAgICAgICJtZW51cyI6IFsKICAgICAgICB7CiAgICAgICAgICAiaWNvbiI6ICJJY29ucy5ob21lIiwKICAgICAgICAgICJsYWJlbCI6ICJNYWluIiwKICAgICAgICAgICJ1cmwiOiAiaHR0cHM6Ly9nb25hdGl2ZS5pbyIKICAgICAgICB9LAogICAgICAgIHsKICAgICAgICAgICJpY29uIjogIkljb25zLmhpc3RvcnkiLAogICAgICAgICAgImxhYmVsIjogIkNyZWF0ZSBBY2NvdW50IiwKICAgICAgICAgICJ1cmwiOiAiaHR0cHM6Ly90cml4d2FsbGV0LmNvbS9tb2JpbGVhcHAvcmVnaXN0ZXIiCiAgICAgICAgfSwKICAgICAgICB7CiAgICAgICAgICAic3ViTGlua3MiOiBbXSwKICAgICAgICAgICJpY29uIjogIkljb25zLmhpc3RvcnkiLAogICAgICAgICAgImxhYmVsIjogIkdvTmF0aXZlIERlbW8iLAogICAgICAgICAgInVybCI6ICJodHRwczovL2dvbmF0aXZlLmlvL2RlbW8iCiAgICAgICAgfQogICAgICBdLAogICAgICAiYWN0aXZlIjogdHJ1ZQogICAgfSwKICAgICJkcmF3ZXIiOiB7CiAgICAgICJpdGVtcyI6IFsKICAgICAgICB7CiAgICAgICAgICAibGFiZWwiOiAiU2FtcGxlIEhvbWUiLAogICAgICAgICAgInVybCI6ICJodHRwczovL2dvbmF0aXZlLmlvIiwKICAgICAgICAgICJpY29uIjogImZhcyBmYS1ob21lIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgImxhYmVsIjogIlNhbXBsZSBBYm91dCIsCiAgICAgICAgICAidXJsIjogImh0dHBzOi8vZ29uYXRpdmUuaW8vYWJvdXQiLAogICAgICAgICAgImljb24iOiAiZmFzIGZhLXVzZXIiCiAgICAgICAgfQogICAgICBdLAogICAgICAiYWN0aXZlIjogdHJ1ZQogICAgfSwKICAgICJhbmRyb2lkUHVsbFRvUmVmcmVzaCI6IGZhbHNlLAogICAgImlvc1B1bGxUb1JlZnJlc2giOiB0cnVlLAogICAgIm5hdmlnYXRpb25UaXRsZXMiOiB7CiAgICAgICJ0aXRsZXMiOiBbCiAgICAgICAge30KICAgICAgXSwKICAgICAgImFjdGl2ZSI6IGZhbHNlCiAgICB9LAogICAgInRvb2xiYXJOYXZpZ2F0aW9uIjogewogICAgICAiaXRlbXMiOiBbCiAgICAgICAgewogICAgICAgICAgInN5c3RlbSI6ICJiYWNrIiwKICAgICAgICAgICJ0aXRsZSI6ICJCYWNrIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgInN5c3RlbSI6ICJmb3J3YXJkIiwKICAgICAgICAgICJ0aXRsZSI6ICJGb3J3YXJkIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgInN5c3RlbSI6ICJyZWZyZXNoIgogICAgICAgIH0KICAgICAgXQogICAgfSwKICAgICJhbmRyb2lkU2hvd1JlZnJlc2hCdXR0b24iOiBmYWxzZSwKICAgICJkZWVwTGlua0RvbWFpbnMiOiB7CiAgICAgICJkb21haW5zIjogW10sCiAgICAgICJlbmFibGVBbmRyb2lkQXBwbGlua3MiOiBmYWxzZQogICAgfQogIH0sCiAgInN0eWxpbmciOiB7CiAgICAidHJhbnNpdGlvbkludGVyYWN0aXZlRGVsYXlNYXgiOiAwLjIsCiAgICAibWVudUFuaW1hdGlvbkR1cmF0aW9uIjogMC4xNSwKICAgICJhbmRyb2lkU2hvd1NwbGFzaCI6IHRydWUsCiAgICAiZGlzYWJsZUFuaW1hdGlvbnMiOiBmYWxzZSwKICAgICJoaWRlV2Vidmlld0FscGhhIjogMC41LAogICAgInNob3dBY3Rpb25CYXIiOiB0cnVlLAogICAgInNob3dOYXZpZ2F0aW9uQmFyIjogdHJ1ZSwKICAgICJpb3NTaWRlYmFyRm9udCI6ICJEZWZhdWx0IiwKICAgICJhbmRyb2lkSGlkZVRpdGxlSW5BY3Rpb25CYXIiOiB0cnVlLAogICAgIm5hdmlnYXRpb25UaXRsZUltYWdlIjogdHJ1ZSwKICAgICJpb3NUaGVtZSI6ICJkZWZhdWx0IiwKICAgICJhbmRyb2lkVGhlbWUiOiAibGlnaHQiLAogICAgImFuZHJvaWRTaWRlYmFyQmFja2dyb3VuZENvbG9yIjogIiNGRkZGRkYiLAogICAgImFuZHJvaWRTaWRlYmFyRm9yZWdyb3VuZENvbG9yIjogIiMxRTQ5NkUiLAogICAgImFuZHJvaWRBY3Rpb25CYXJCYWNrZ3JvdW5kQ29sb3IiOiAiI0ZGRkZGRiIsCiAgICAiYW5kcm9pZEFjdGlvbkJhckZvcmVncm91bmRDb2xvciI6ICIjMUU0OTZFIiwKICAgICJhbmRyb2lkUHVsbFRvUmVmcmVzaENvbG9yIjogIiMxRTQ5NkUiLAogICAgImFuZHJvaWRBY2NlbnRDb2xvciI6ICIjMUU0OTZFIiwKICAgICJhbmRyb2lkU2lkZWJhclNlcGFyYXRvckNvbG9yIjogIiNDQ0NDQ0MiLAogICAgImFuZHJvaWRUYWJCYXJCYWNrZ3JvdW5kQ29sb3IiOiAiI0ZGRkZGRiIsCiAgICAiYW5kcm9pZFRhYkJhclRleHRDb2xvciI6ICIjOTQ5NDk0IiwKICAgICJhbmRyb2lkVGFiQmFySW5kaWNhdG9yQ29sb3IiOiAiIzFFNDk2RSIsCiAgICAiYW5kcm9pZFN0YXR1c0JhckJhY2tncm91bmRDb2xvciI6ICIjNUM1QzVDIiwKICAgICJpb3NUaW50Q29sb3IiOiAiIzFFNDk2RSIsCiAgICAiaW9zVGl0bGVDb2xvciI6ICIjMUU0OTZFIiwKICAgICJpb3NTaWRlYmFyVGV4dENvbG9yIjogIiMxRTQ5NkUiCiAgfSwKICAicGVybWlzc2lvbnMiOiB7CiAgICAidXNlc0dlb2xvY2F0aW9uIjogZmFsc2UsCiAgICAiYW5kcm9pZERvd25sb2FkVG9QdWJsaWNTdG9yYWdlIjogZmFsc2UsCiAgICAiZW5hYmxlV2ViUlRDIjogZmFsc2UKICB9LAogICJwZXJmb3JtYW5jZSI6IHsKICAgICJ3ZWJ2aWV3UG9vbHMiOiBbCiAgICAgIHsKICAgICAgICAidXJscyI6IFsKICAgICAgICAgIHsKICAgICAgICAgICAgImRpc293biI6ICJyZWxvYWQiCiAgICAgICAgICB9CiAgICAgICAgXQogICAgICB9CiAgICBdCiAgfSwKICAic2VydmljZXMiOiB7CiAgfQp9",
//                    "APP_NAME": "WEB2APP"
//                }
//            }
//        },
//        "feedback": null,
//        "fileWorkflowId": null,
//        "finishedAt": "2022-07-30T12:51:50.765+0000",
//        "index": 8,
//        "instanceType": "mac_mini",
//        "labels": [],
//        "message": null,
//        "pullRequest": null,
//        "scheduledBuildId": null,
//        "screenshots": null,
//        "sshAccess": null,
//        "sshAccessEnabled": false,
//        "startedAt": "2022-07-30T12:46:31.290+0000",
//        "status": "finished",
//        "tag": null,
//        "version": "1.0.0",
//        "vncAccess": null,
//        "workflowId": "62e4fc24f9c684a19c46b49c"
//    }
//}
