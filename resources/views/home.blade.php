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
                        <h1 class="cover-heading">Create a shrt.lu link!</h1>
                        <div class="lead">
                            {!! Form::open(['url' => URL::to('/create', array(), env('APP_SECURE')), 'method' => 'post', 'class' => 'form-inline']) !!}
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
                                {!! Form::open(['url' => URL::to('/', array(), env('APP_SECURE')), 'class' => 'form-inline']) !!}
                                {!! Form::label('link', 'Your link: ') !!}
                                {!! Form::text('link', env('APP_URL').'/'.session()->get('slug'), ['class' => 'form-control', 'autocomplete' => 'off', 'onClick' => 'this.select()']) !!}
                                {!! Form::close() !!}
                                <br>
                                <p>URL Stats: <a href="{{ env('APP_URL').'/stats/'.session()->get('slug') }}">{{ env('APP_URL').'/stats/'.session()->get('slug') }}</a></p>
                            </div>
                        @endif
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
