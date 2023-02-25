<?php

namespace App\Services;

class SearchCityServer
{
    public static function getCity()
    {
        try {
            $fullInfo = [];

            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'https://www.saveecobot.com/api/v1/cities', [
//                'headers' => ["apikey" => Config::getConfigValue('apiKey')]
                'headers' => ["apikey" => "n2EVjVGgiogykYue1KbtgotZB4JmmYWg"]
            ]);

            $response = json_decode($res->getBody()->getContents());
            foreach ($response->data as $item) {
                $data = [];
                $data['id'] = $item->attributes->region_id;
                $data['city'] = $item->attributes->city_name;
                $data['region'] = $item->attributes->region_name;
                $data['typeName'] = $item->attributes->type_name;
                $data['lat'] = $item->attributes->center_latitude;
                $data['lng'] = $item->attributes->center_longitude;
                if (!empty($data)) {
                    $fullInfo[] = $data;
                }
            }
            if (!empty($fullInfo)) {
                return $fullInfo;
            }
            return [
                'status' => 'error',
                'response' => 'data fetch error ',
            ];
        } catch (\Exception $e) {
            $msg = '';
            $str = explode('response:', $e->getMessage());

            if (!empty($str)) {
                if (isset($str[1])) {
                    $msg = json_decode(trim($str[1]), true);
                } else {
                    $msg = trim($str[0]);
                }
            }

            return [
                'status' => 'error',
                'response' => $msg,
            ];
        }
    }
}
