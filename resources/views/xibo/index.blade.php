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
  @foreach($xibo as $x)
    <p>{{ $x["name"] }}</p>
    <img src="{{ 'data:image/jpeg;base64, ' . base64_encode($x['image']) }}" alt="" style="width: 300px;">
  @endforeach
</body>
</html>