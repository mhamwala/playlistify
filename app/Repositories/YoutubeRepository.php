<?php

namespace App\Repositories;

class YoutubeRepository
{
    // PRODUCTION CREDENTIALS
    const base_url = 'https://www.googleapis.com/youtube/v3/';
    protected string $api_key;

    public function __construct()
    {
        $api_key = env('YOUTUBE_API_KEY',null);

        if($api_key)
        {
            $this->api_key = env('YOUTUBE_API_KEY','');
        }
        else
        {
            dd('no api key set');
        }
    }

    public function curl_get_request($url)
    {
        $count = 0;
        $wait = 60;

        while($count <= 3)
        {

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url."&key=".$this->api_key,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if(in_array($httpcode,[200,201,202,203,204,205,206,207]))
            {
                return json_decode($response);
            }

            dump($httpcode);
            dump($response);

            $count = $count + 1;
            sleep($wait*$count);
        }

        return null;
    }

    public function curl_post_request($url,$object,$version = 3,$attempt = 0)
    {
        $count = 0;
        $wait = 60;

        $payload = json_encode($object);

        while($count <= 3)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>$payload,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if(in_array($httpcode,[200,201,202,203,204,205,206,207]))
            {
                return json_decode($response);
            }

            dump($httpcode);
            dump($response);

            $count = $count + 1;
            sleep($wait*$count);
        }

        return null;
    }

    public function curl_patch_request($url,$payload,$properties = true)
    {
        $count = 0;
        $wait = 60;

        $payload = json_encode($payload);

        while($count <= 3)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PATCH",
                CURLOPT_POSTFIELDS =>$payload,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if(in_array($httpcode,[200,201,202,203,204,205,206,207]))
            {
                return json_decode($response);
            }

            dump($httpcode);
            dump($response);

            $count = $count + 1;
            sleep($wait*$count);
        }

        return null;
    }

    public function curl_delete_request($url)
    {
        $count = 0;
        $wait = 60;

        while($count <= 3)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "DELETE",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if(in_array($httpcode,[200,201,202,203,204,205,206,207]))
            {
                return $response;
            }

            dump($httpcode);
            dump($response);

            $count = $count + 1;
            sleep($wait*$count);
        }
        return null;
    }

    public function curl_put_request($url)
    {
        $count = 0;
        $wait = 60;

        while($count <= 3)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PUT",
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if(in_array($httpcode,[200,201,202,203,204,205,206,207]))
            {
                return $response;
            }

            dump($httpcode);
            dump($response);

            $count = $count + 1;
            sleep($wait*$count);
        }
        return null;
    }

    public function get_activities($channelId)
    {
        $url = $this::base_url."activities?channelId=".$channelId;
        return $this->curl_get_request($url);
    }
}