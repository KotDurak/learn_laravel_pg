<?php
use Illuminate\Support\Facades\Storage;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
     <h3>Upload form</h3>

     @if(request()->has('img'))
         <img width="300px" src="<?= Storage::url(request()->get('img')) ?>" alt="">
     @endif

     <h5>Files list current</h5>
     @foreach($files as $file)
         <img width="200px" src="<?= Storage::url($file) ?>" alt="">
     @endforeach
    <div class="upload_form">
        <form
              method="POST" action="<?= route('upload') ?>"
              enctype="multipart/form-data">
            @csrf

            <input type="file" name="auto"/>

            <input type="submit" name="Upload"/>
        </form>
    </div>
</body>
</html>
