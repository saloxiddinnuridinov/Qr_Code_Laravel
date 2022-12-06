<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Qr Code</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" placeholder="iamge" name="image">
            <input type="submit" name="ok">
        </form>
        <div >
            
        </div>

    </body>
</html>
