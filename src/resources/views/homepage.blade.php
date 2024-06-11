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
    <main>
        <h1>Hello</h1>

        <div>
            <img src="<?= Storage::url('public/images/anime.jpeg'); ?>" alt="">
        </div>

        <div class="form">

        </div>
    </main>
</body>
</html>
