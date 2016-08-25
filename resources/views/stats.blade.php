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
    {!! Html::style('css/bootstrap.min.css') !!}

            <!-- Custom styles for this template -->
    {!! Html::style('css/app.css') !!}

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="cover-container">
            <div class="masthead clearfix">
                <div class="inner">
                    <h3 class="masthead-brand">Shrt.lu</h3>
                    <nav>
                        <ul class="nav masthead-nav">
                            <li class="active"><a href="{{ URL::route('home') }}">Home</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="inner cover">
                <h1 class="cover-heading">Stats for {{ $data['slug'] }}</h1>
                <div class="lead">
                    This URL has been clicked <b style="color: lime">{{ $data['count'] }}</b>.
                </div>
            </div>

            <div class="mastfoot">
                <div class="inner">
                    <p>
                        Copyright <a href="{{ URL::route('home') }}">{{ env('APP_NAME') }}</a> - 2016.
                        Made by <a href="https://twitter.com/_ValpeX" target="_blank">@_ValpeX</a>.
                            <span style="color:#32cd32">
                                v{{ env('APP_VERSION') }}
                            </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{!! Html::script('js/jquery-1.12.3.min.js') !!}
</body>
</html>
