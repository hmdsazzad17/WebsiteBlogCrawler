<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="http://192.168.1.134/erp9/sazzad_bkash/public/css/bootstrap.css">
        <!-- Styles -->

    </head>
    <body class="antialiased">
        @foreach ($articles as $index => $article)
        @if ($index % 3 == 0)
            <div class="row mb-4">
        @endif
        @php
            $articleLink = explode("/",$article['link']);

        @endphp

        <div class="col-md-4">
            <div class="card">
                <img src="{{ $article['image_link'] }}" class="card-img-top" alt="Article Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $article['title'] }}</h5>
                    <p class="card-text">{{ $article['description'] }}</p>
                    <a href="{{ url('/blogDetails'.'/'. $articleLink[2]) }}" class="btn btn-primary">Read more</a>
                </div>
            </div>
        </div>

        @if (($index + 1) % 3 == 0 || $loop->last)
            </div>
        @endif
    @endforeach

    </body>

</html>
