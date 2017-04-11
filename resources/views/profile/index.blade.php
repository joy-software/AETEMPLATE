@extends('layouts/app')

@section('css')

    <link href="{{ asset('css/deleteAside.css') }}" rel="stylesheet">

@endsection



@section('content')



    <section class="wrapper">
            <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                                <h4>John Smith</h4>
                                <div class="follow-ava">
                                    <img src="{{ asset('karmanta/img/profile-widget-avatar.jpg') }}" alt="">
                                </div>
                                <h6>Administrator</h6>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p>Hello I’m John Smith, a leading expert in interactive and creative design.</p>
                                <p>@johnsmith</p>
                                <h6>
                                    <span><i class="icon_clock_alt"></i>11:05 AM</span>
                                    <span><i class="icon_calendar"></i>25.10.13</span>
                                    <span><i class="icon_pin_alt"></i>NY</span>
                                </h6>
                            </div>
                            <div class="col-lg-6 col-sm-6 follow-info weather-category">
                                <ul>
                                    <li class="active">
                                        <h4>50</h4>
                                        <i class="icon_close_alt2"></i> Pending Task
                                    </li>
                                    <li>
                                        <h4>550</h4>
                                        <i class="icon_check_alt2"></i> Completed
                                    </li>
                                    <li>
                                        <h4>600</h4>
                                        <i class="icon_plus_alt2"></i> Total Task
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading tab-bg-info">
                            <ul class="nav nav-tabs">

                                <li>
                                    <a data-toggle="tab" href="#profile">
                                        <i class="icon-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#edit-profile">
                                        <i class="icon-envelope"></i>
                                        Edit Profile
                                    </a>
                                </li>
                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">

                                <div id="profile" class="tab-pane active">
                                    <section class="panel">
                                        <div class="bio-graph-heading">
                                            Hello I’m John Smith, a leading expert in interactive and creative design specializing in the mobile medium. My graduation from Massey University with a Bachelor of Design majoring in visual communication.
                                        </div>
                                        <div class="panel-body bio-graph-info">
                                            <h1>Bio Graph</h1>
                                            <div class="row">
                                                <div class="bio-row">
                                                    <p><span>First Name </span>: Jonathan</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Last Name </span>: Smith</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Birthday</span>: 18 June 1990</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Country </span>: Los Angeles</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Occupation </span>: UI Designer</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Email </span>: johnf@karmanta.com</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Mobile </span>: (08) 564 789</p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Phone </span>:  (+91) 90164 18808</p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="row">
                                        </div>
                                    </section>
                                </div>
                                <!-- edit-profile -->
                                <div id="edit-profile" class="tab-pane">
                                    <section class="panel">
                                        <div class="panel-body bio-graph-info">
                                            <h1> Profile Info</h1>
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">First Name</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="f-name" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Last Name</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="l-name" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">About Me</label>
                                                    <div class="col-lg-10">
                                                        <textarea name="" id="" class="form-control" cols="30" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Country</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="c-name" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Birthday</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="b-day" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Occupation</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="occupation" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Email</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="email" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Mobile</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="mobile" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Website URL</label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="url" placeholder="http://www.demowebsite.com ">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                        <button type="button" class="btn btn-danger">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
        </section>

@endsection


<script>

    //knob
    $(".knob").knob();

</script>


</body>
</html>
