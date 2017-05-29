
<!doctype html>

<html>

<head>
    <title>Create live</title>
    <link rel="stylesheet" href="{{asset('assets/css/upload.css')}}">
    <link href="{{ asset('assets/css/site.css') }}" rel="stylesheet"/>

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" />
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
        <label for="video" class="btn btn-primary disabled"><i class="icon_upload"></i><span id="label-file">Choisissez une </span></label>
    </div>

</div>


<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <button id="profileButton" type="submit" class="btn btn-primary disabled">Enregistrer</button>

    </div>
</div>

</form>

<script src="{{asset('assets/js/upload.js')}}"></script>

</body>
</html>
