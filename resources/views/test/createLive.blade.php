
<!doctype html>

<html>

<head>
    <title>Create live</title>
    <link rel="stylesheet" href="{{asset('css/upload.css')}}">
    <link href="{{ asset('karmanta/css/bootstrap.min.css') }}" rel="stylesheet"/>

    <link href="{{ asset('karmanta/css/bootstrap-theme.css') }}" rel="stylesheet"/>
    <link href="{{ asset('karmanta/css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="../wamp64/www/assovogt.org/resources/assets/karmanta/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <link href="{{ asset('karmanta/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('karmanta/css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" />
</head>

<body>

@if(\Illuminate\Support\Facades\Session::has('result'))
    <div class="alert alert-block col-lg-8">
        {!! dump(\Illuminate\Support\Facades\Session::get('result'))  !!}
    </div>
@endif

@if (isset($result))
    <div class="alert alert-block col-lg-8">
        {!! dump($result) !!}
    </div>
@endif



{!! Form::open(
    array(
        'route' => 'video_live',
        'class' => 'form-horizontal',
        )) !!}

{{ csrf_field() }}

<div class="form-group ">

    <div class="col-lg-4">
        {!! Form::file('video', ['class' => 'form-control col-lg-4 inputfile', 'id' => 'video']) !!}
        <label for="video" class="btn btn-primary"><i class="icon_upload"></i><span id="label-file">Choisissez une </span></label>
    </div>

</div>


<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <button id="profileButton" type="submit" class="btn btn-primary">Enregistrer</button>

    </div>
</div>

</form>

<script src="{{asset('js/upload.js')}}"></script>

</body>
</html>
