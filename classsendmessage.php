<?php

class Whatsapp
{

    public $base_url = 'https://api.umarsolution.com/'; // masukan link


    private function connect($x, $n = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($x));
        curl_setopt($ch, CURLOPT_URL, $this->base_url . $n);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    public function sendMessage($phone, $msg)
    {
        return $this->connect([
            'number' => $phone,
            'message' => $msg
        ], 'v2/send-message');
    }

    public function sendPicture($phone, $caption, $url, $filetype)
    {
        return $this->connect([

            'number' => $phone,
            'filetype' => $filetype,
            'caption' => $caption,
            'url' => $url
        ], 'v2/send-media');
    }

    public function sendDocument($phone, $filename, $url, $filetype)
    {
        return $this->connect([

            'number' => $phone,
            'filetype' => $filetype,
            'filename' => $filename,
            'url' => $url
        ], 'v2/send-media');
    }

    public function sendAudio($phone, $voice, $url, $filetype)
    {
        return $this->connect([

            'number' => $phone,
            'filetype' => $filetype,
            'voice' => $voice,
            'url' => $url
        ], 'v2/send-media');
    }
}

$send = new Whatsapp();

