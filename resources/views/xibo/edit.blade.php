<?php
  $imageName = explode('.', $xibo->image_name)
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <a href="/">Balik</a>
  Edit
  <img src="{{ $xibo->xiboImage() }}" alt="">
  <p>{{ $xibo->image_name }}</p>

  <form action="/edit/store" method="post">
    @csrf
    <input type="text" value="{{ $imageName[0] }}" name="image_name">
    <input type="hidden" name="image_type" value="{{ $imageName[1] }}">
    <button type="submit">Edit</button>
  </form>
</body>
</html>