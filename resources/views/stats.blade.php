<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Shrt.lu is a fast url shortener service!">
    <meta name="author" content="@_ValpeX">
    <link rel="icon" href="favicon.ico">

    <title>Shrt.lu</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/css/app.css" type="text/css" />
</head>

<body>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="cover-container">
            <div class="masthead clearfix">
                <div class="inner">
                    <h3 class="masthead-brand">{{ env('APP_NAME') }}</h3>
                    <nav>
                        <ul class="nav masthead-nav">
                            <li class="active"><a href="{{ env('APP_URL') }}">Home</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="inner cover">
                <h1 class="cover-heading">Stats for {{ $data['slug'] }}</h1>
                <div class="lead">
                    @if ($data['count'] <= 0)
                        This URL hasn't been clicked yet.
                    @elseif ($data['count'] === 1)
                        This URL has been clicked <b style="color: lime">1</b> time.
                    @else
                        This URL has been clicked <b style="color: lime">{{ $data['count'] }}</b> times.
                    @endif
                </div>
            </div>

            <div class="mastfoot">
                <div class="inner">
                    <p>
                        Copyright <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a> - 2016.
                        Made by <a href="https://twitter.com/_ValpeX" target="_blank">@_ValpeX</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="/js/jquery-1.12.3.min.js"></script>
</body>
</html>
