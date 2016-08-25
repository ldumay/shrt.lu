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
                            <li><a href="#">API</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="inner cover">
                <h1 class="cover-heading">Create a shrt.lu link!</h1>
                <div class="lead">
                    {!! Form::open(['route' => 'create', 'method' => 'post', 'class' => 'form-inline']) !!}
                    {!! Form::url('url', null, ['class' => 'form-control', 'placeholder' => 'Paste an URL and press Enter!', 'autocomplete' => 'off']) !!}
                    {!! Form::submit('Shrt now!', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
                @if ($errors->has('url'))
                    <div class="lead">
                        <div class="alert alert-danger">
                            {{ $errors->first('url') }}
                        </div>
                    </div>
                @endif

                @if (Session::has('warning'))
                    <div class="lead">
                        <div class="alert alert-warning">
                            {{ Session::get('warning') }}
                        </div>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="lead">
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        {!! Form::open(['url' => '', 'class' => 'form-inline']) !!}
                        {!! Form::label('link', 'Your link: ') !!}
                        {!! Form::text('link', URL::route('home').'/'.session()->get('slug'), ['class' => 'form-control', 'autocomplete' => 'off', 'onClick' => 'this.select()']) !!}
                        {!! Form::close() !!}
                        <p>Link to the stats for this url: <a href="{{ URL::route('home').'/stats/'.session()->get('slug') }}">{{ URL::route('home').'/stats/'.session()->get('slug') }}</a></p>
                    </div>
                @endif
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
