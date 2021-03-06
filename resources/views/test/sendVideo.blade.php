
    <!doctype html>

    <html>

        <head>
            <title>Send video</title>
            <link rel="stylesheet" href="{{asset('assets/css/upload.css')}}">
            <link href="{{ asset('assets/css/site.css') }}" rel="stylesheet"/>

            <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
            <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" />
        </head>

        <body>

            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-block col-lg-8">
                    {!! \Illuminate\Support\Facades\Session::get('message')  !!}
                </div>
            @endif

            @if (isset($message))
                <div class="alert alert-block col-lg-8">
                    {!! $message !!}
                </div>
            @endif



            {!! Form::open(
                array(
                    'route' => 'post_tester_upload',
                    'class' => 'form-horizontal',
                    'files' => true)) !!}

            {{ csrf_field() }}

            <div class="form-group ">

                <div class="col-lg-4">
                    {!! Form::file('video', ['class' => 'form-control col-lg-4 inputfile', 'id' => 'video']) !!}
                    <label for="video" class="btn btn-primary disabled"><i class="icon_upload"></i><span id="label-file">Choisissez une video</span></label>
                </div>

                <p class="control-label photo-label">Extensions acceptées : mp4 (2Mo maxi)</p>

                @if ($errors->has('video'))
                    <span class="help-block control-label col-lg-9 col-lg-offset-2 text-danger">
                        <strong>{{ $errors->first('video') }}</strong>
                    </span>
                @endif

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
