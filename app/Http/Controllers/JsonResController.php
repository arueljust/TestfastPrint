<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;

class JsonResController extends Controller
{
    public function getResponseApi()
    {
        $cookieJar = new CookieJar();
        $setCookie = new SetCookie([
            'Name' => 'ci_session',
            'Value' => 'pjd30ena51cuitj3j6m87uqbtvnkgg7k',
            'Domain' => 'recruitment.fastprint.co.id',
            'Expires' => time() + 3600, //timeout cookie sejam ya
            'Path' => '/',
            'Secure' => true, // agar cuma kirim via https
            'HttpOnly' => true, // cuma bisa diakses dr http tdk bisa dr js
        ]);
        $cookieJar->setcookie($setCookie); // set cookiejar untuk digunakan di web
        $client = new Client();

        try {
            // form data yang direquest
            $formData = [
                'username' => 'tesprogrammer200923C18',
                'password' => 'be00c524423ffcdf8c51f72e332f7dbb',
            ];
            $response = $client->request('POST', 'https://recruitment.fastprint.co.id/tes/api_tes_programmer', [ // url dan method yg diperlukan untuk mangambil data
                'form_params' => $formData,
                'cookies' => true, // aktifin dulu cookinya
                'headers' => [
                    'User-Agent' => 'GuzzleHttp/7', // ini sesuai dengan http client yang sedang digunakan disini saya menggunakan guzzleHttp
                ],
                'cookies' => $cookieJar, // taruh cookie yang td kita set diatas, untuk requset ke server
            ]);
            $data = $response->getBody()->getContents(); //ambil datanya ya
            return $data;
        } catch (\Exception $e) { // kalau ada error masuk sini ya
            return response()->json([
                'msg' => 'error',
                'error' => $e->getMessage()
            ]);
        }
    }
}
