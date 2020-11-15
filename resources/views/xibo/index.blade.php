<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  Welcome to Xibo
  <br>
  @foreach($xibo as $x)
    <a href="/edit/{{ $x["id"] }}">Edit</a>
    <p>{{ $x["image_name"] }}</p>
    {{-- <img src="{{ 'data:image/jpeg;base64, ' . base64_encode($x['image']) }}" alt="" style="width: 300px;"> --}}
    <img src="{{ 'storage/' . $x["image"] }}" alt="" style="width: 300px">
  @endforeach
  
  <form action="/store" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" id="file">
    <button type="submit">Upload</button>
  </form>
</body>
</html>