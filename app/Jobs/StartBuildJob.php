<?php

namespace App\Jobs;

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
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


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
            CURLOPT_POSTFIELDS => '{
    "appId": "62e4fc24f9c684a19c46b49d",
    "workflowId": "62e4fc24f9c684a19c46b49c",
    "branch": "main",
    "environment": {
        "variables": {
            "APP_CONFIG": "ewogICJwdWJsaWMiOiB7CiAgICAiYXBwTmFtZSI6ICJBUEkgQXBwIiwKICAgICJpbml0aWFsVXJsIjogImh0dHBzOi8vdHJpeHdhbGxldC5jb20vbW9iaWxlYXBwLyIsCiAgICAidXNlckFnZW50IjogIndlYjJhcHAiLAogICAgInByaW1hcnlDb2xvciI6ICJGRkZGMDAiLAogICAgImZ1bGxTY3JlZW4iOiBmYWxzZSwKICAgICJmb3JjZVNjcmVlbk9yaWVudGF0aW9uIjogZmFsc2UKICB9LAogICJuYXZpZ2F0aW9ucyI6IHsKICAgICJ0YWIiOiB7CiAgICAgICJtZW51cyI6IFsKICAgICAgICB7CiAgICAgICAgICAiaWNvbiI6ICJJY29ucy5ob21lIiwKICAgICAgICAgICJsYWJlbCI6ICJNYWluIiwKICAgICAgICAgICJ1cmwiOiAiaHR0cHM6Ly9nb25hdGl2ZS5pbyIKICAgICAgICB9LAogICAgICAgIHsKICAgICAgICAgICJpY29uIjogIkljb25zLmhpc3RvcnkiLAogICAgICAgICAgImxhYmVsIjogIkNyZWF0ZSBBY2NvdW50IiwKICAgICAgICAgICJ1cmwiOiAiaHR0cHM6Ly90cml4d2FsbGV0LmNvbS9tb2JpbGVhcHAvcmVnaXN0ZXIiCiAgICAgICAgfSwKICAgICAgICB7CiAgICAgICAgICAic3ViTGlua3MiOiBbXSwKICAgICAgICAgICJpY29uIjogIkljb25zLmhpc3RvcnkiLAogICAgICAgICAgImxhYmVsIjogIkdvTmF0aXZlIERlbW8iLAogICAgICAgICAgInVybCI6ICJodHRwczovL2dvbmF0aXZlLmlvL2RlbW8iCiAgICAgICAgfQogICAgICBdLAogICAgICAiYWN0aXZlIjogdHJ1ZQogICAgfSwKICAgICJkcmF3ZXIiOiB7CiAgICAgICJpdGVtcyI6IFsKICAgICAgICB7CiAgICAgICAgICAibGFiZWwiOiAiU2FtcGxlIEhvbWUiLAogICAgICAgICAgInVybCI6ICJodHRwczovL2dvbmF0aXZlLmlvIiwKICAgICAgICAgICJpY29uIjogImZhcyBmYS1ob21lIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgImxhYmVsIjogIlNhbXBsZSBBYm91dCIsCiAgICAgICAgICAidXJsIjogImh0dHBzOi8vZ29uYXRpdmUuaW8vYWJvdXQiLAogICAgICAgICAgImljb24iOiAiZmFzIGZhLXVzZXIiCiAgICAgICAgfQogICAgICBdLAogICAgICAiYWN0aXZlIjogdHJ1ZQogICAgfSwKICAgICJhbmRyb2lkUHVsbFRvUmVmcmVzaCI6IGZhbHNlLAogICAgImlvc1B1bGxUb1JlZnJlc2giOiB0cnVlLAogICAgIm5hdmlnYXRpb25UaXRsZXMiOiB7CiAgICAgICJ0aXRsZXMiOiBbCiAgICAgICAge30KICAgICAgXSwKICAgICAgImFjdGl2ZSI6IGZhbHNlCiAgICB9LAogICAgInRvb2xiYXJOYXZpZ2F0aW9uIjogewogICAgICAiaXRlbXMiOiBbCiAgICAgICAgewogICAgICAgICAgInN5c3RlbSI6ICJiYWNrIiwKICAgICAgICAgICJ0aXRsZSI6ICJCYWNrIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgInN5c3RlbSI6ICJmb3J3YXJkIiwKICAgICAgICAgICJ0aXRsZSI6ICJGb3J3YXJkIgogICAgICAgIH0sCiAgICAgICAgewogICAgICAgICAgInN5c3RlbSI6ICJyZWZyZXNoIgogICAgICAgIH0KICAgICAgXQogICAgfSwKICAgICJhbmRyb2lkU2hvd1JlZnJlc2hCdXR0b24iOiBmYWxzZSwKICAgICJkZWVwTGlua0RvbWFpbnMiOiB7CiAgICAgICJkb21haW5zIjogW10sCiAgICAgICJlbmFibGVBbmRyb2lkQXBwbGlua3MiOiBmYWxzZQogICAgfQogIH0sCiAgInN0eWxpbmciOiB7CiAgICAidHJhbnNpdGlvbkludGVyYWN0aXZlRGVsYXlNYXgiOiAwLjIsCiAgICAibWVudUFuaW1hdGlvbkR1cmF0aW9uIjogMC4xNSwKICAgICJhbmRyb2lkU2hvd1NwbGFzaCI6IHRydWUsCiAgICAiZGlzYWJsZUFuaW1hdGlvbnMiOiBmYWxzZSwKICAgICJoaWRlV2Vidmlld0FscGhhIjogMC41LAogICAgInNob3dBY3Rpb25CYXIiOiB0cnVlLAogICAgInNob3dOYXZpZ2F0aW9uQmFyIjogdHJ1ZSwKICAgICJpb3NTaWRlYmFyRm9udCI6ICJEZWZhdWx0IiwKICAgICJhbmRyb2lkSGlkZVRpdGxlSW5BY3Rpb25CYXIiOiB0cnVlLAogICAgIm5hdmlnYXRpb25UaXRsZUltYWdlIjogdHJ1ZSwKICAgICJpb3NUaGVtZSI6ICJkZWZhdWx0IiwKICAgICJhbmRyb2lkVGhlbWUiOiAibGlnaHQiLAogICAgImFuZHJvaWRTaWRlYmFyQmFja2dyb3VuZENvbG9yIjogIiNGRkZGRkYiLAogICAgImFuZHJvaWRTaWRlYmFyRm9yZWdyb3VuZENvbG9yIjogIiMxRTQ5NkUiLAogICAgImFuZHJvaWRBY3Rpb25CYXJCYWNrZ3JvdW5kQ29sb3IiOiAiI0ZGRkZGRiIsCiAgICAiYW5kcm9pZEFjdGlvbkJhckZvcmVncm91bmRDb2xvciI6ICIjMUU0OTZFIiwKICAgICJhbmRyb2lkUHVsbFRvUmVmcmVzaENvbG9yIjogIiMxRTQ5NkUiLAogICAgImFuZHJvaWRBY2NlbnRDb2xvciI6ICIjMUU0OTZFIiwKICAgICJhbmRyb2lkU2lkZWJhclNlcGFyYXRvckNvbG9yIjogIiNDQ0NDQ0MiLAogICAgImFuZHJvaWRUYWJCYXJCYWNrZ3JvdW5kQ29sb3IiOiAiI0ZGRkZGRiIsCiAgICAiYW5kcm9pZFRhYkJhclRleHRDb2xvciI6ICIjOTQ5NDk0IiwKICAgICJhbmRyb2lkVGFiQmFySW5kaWNhdG9yQ29sb3IiOiAiIzFFNDk2RSIsCiAgICAiYW5kcm9pZFN0YXR1c0JhckJhY2tncm91bmRDb2xvciI6ICIjNUM1QzVDIiwKICAgICJpb3NUaW50Q29sb3IiOiAiIzFFNDk2RSIsCiAgICAiaW9zVGl0bGVDb2xvciI6ICIjMUU0OTZFIiwKICAgICJpb3NTaWRlYmFyVGV4dENvbG9yIjogIiMxRTQ5NkUiCiAgfSwKICAicGVybWlzc2lvbnMiOiB7CiAgICAidXNlc0dlb2xvY2F0aW9uIjogZmFsc2UsCiAgICAiYW5kcm9pZERvd25sb2FkVG9QdWJsaWNTdG9yYWdlIjogZmFsc2UsCiAgICAiZW5hYmxlV2ViUlRDIjogZmFsc2UKICB9LAogICJwZXJmb3JtYW5jZSI6IHsKICAgICJ3ZWJ2aWV3UG9vbHMiOiBbCiAgICAgIHsKICAgICAgICAidXJscyI6IFsKICAgICAgICAgIHsKICAgICAgICAgICAgImRpc293biI6ICJyZWxvYWQiCiAgICAgICAgICB9CiAgICAgICAgXQogICAgICB9CiAgICBdCiAgfSwKICAic2VydmljZXMiOiB7CiAgfQp9",
            "APP_NAME": "WEB2APP"
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
        echo $response;

    }
}
