<?php

namespace App\Http\Controllers;

use App\Xibo;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class XiboController extends Controller
{
    public function index()
    {
        $xibo = Xibo::all();

        return view('xibo.index', compact('xibo'));
    }

    public function media()
    {
        $access_token = 'gRfZxVldbAHbWPSDURnBh50tVq05EfboLJARzY3X';

        $client = new Client(['base_uri' => 'http://192.168.1.5']);

        $headers = [
            'Authorization' => 'Bearer ' . $access_token,
            'Accept' => 'application/json'
        ];

        $response = $client->request('GET', '/xibo-cms/web/api/library?length=20', [
            'headers' => $headers
        ]);

        $contents = $response->getBody();
        $content = json_decode($contents, true);
    }

    public function image()
    {
        $access_token = 'gRfZxVldbAHbWPSDURnBh50tVq05EfboLJARzY3X';

        $client = new Client(['base_uri' => 'http://192.168.1.5']);

        $headers = [
            'Authorization' => 'Bearer ' . $access_token,
        ];

        $response = $client->request('GET', '/xibo-cms/web/api/library/download/19/image', [
            'headers' => $headers
        ]);

        $image = $response->getBody()->getContents();

        $form_data = array(
            'name' => 'Jambu',
            'image' => $image
        );

        Xibo::create($form_data);

        echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '"/>';
    }
}