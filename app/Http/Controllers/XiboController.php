<?php

namespace App\Http\Controllers;

use App\Xibo;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class XiboController extends Controller
{
    public $access_token = 'NKIM1mYfspiKX2H2qqXB6ncAvqbeKiXwo3w5XRys';

    public function index()
    {
        $xibo = Xibo::all();

        return view('xibo.index', compact('xibo'));
    }

    public function media()
    {
        $client = new Client(['base_uri' => 'http://192.168.1.5']);

        $headers = [
            'Authorization' => 'Bearer ' . $this->access_token,
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
        $client = new Client(['base_uri' => 'http://192.168.1.5']);

        $headers = [
            'Authorization' => 'Bearer ' . $this->access_token,
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

    public function store(Request $request)
    {
        $file = $request->files->get('file');

        $fileName = $file->getClientOriginalName();

        $imagePath = request('file')->store('uploads', 'public');

        $imageName = explode("/", $imagePath);

        $form_data = array(
            'name' => $imageName[1],
            'image' => $imagePath
        );

        Xibo::create($form_data);

        // $fileBlob = file_get_contents($file->getRealPath());

        // dd($fileBlob);

        // echo '<img src="data:image/jpeg;base64,' . base64_encode($fileBlob) . '"/>';

        // $image = 'data:image/jpeg;base64, ' . base64_encode($fileBlob);

        // dd($image);

        $client = new Client(['base_uri' => 'http://192.168.1.5']);

        $headers = [
            'Authorization' => 'Bearer ' . $this->access_token,
            'Accept' => 'application/json'
        ];

        $multipart = [
            [
                'name' => 'name',
                'contents' => $fileName
            ],
            [
                'name' => 'files',
                'contents' => fopen('C:/Users/thena/Desktop/laravelblob/storage/app/public/' . $imagePath, 'r')
            ]
        ];

        $response = $client->request('POST', '/xibo-cms/web/api/library', [
            'headers' => $headers,
            'multipart' => $multipart
        ]);

        // $contents = $response->getBody();
        // $content = json_decode($contents, true);

        return redirect('/');
    }

    public function edit($id)
    {
        $xibo = Xibo::findOrFail($id);

        return view('xibo.edit', compact('xibo'));
    }
}