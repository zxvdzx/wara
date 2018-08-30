@extends('frontend.layout.layout')

@section('title', 'Dashboard')

@section('content')
<!-- banner -->
<div class="about-bottom">
    <div class="col-md-6 w3l_about_bottom_left">
        <div class="video-grid-single-page-agileits">
            <div data-video="tt2k8PGm-TI" id="video"> <img src="{{ asset($pathp.'assets/frontend/images/waratime.png') }}" alt="about" class="img-responsive" /> </div>
        </div>
        <div class="w3l_about_bottom_left_video">
            <!-- <h4>watch our video</h4> -->
        </div>
    </div>
    <div class="col-md-6 w3l_about_bottom_right one">
        <div class="abt-w3l">
            <div class="header-w3l">
                <h2>Admission Form</h2>
                <h4>Enter the Following Details</h4>
                <form action="#" method="post" class="mod2">
                    <div class="col-md-6 col-xs-6 w3l-left-mk">
                        <ul>
                            <li class="text">First Name :  </li>
                            <li class="agileits-main"><i class="fa fa-user-o" aria-hidden="true"></i><input name="firstName" type="text" required=""></li>
                            <li class="text">Last Name :  </li>
                            <li class="agileits-main"><i class="fa fa-user-o" aria-hidden="true"></i><input name="lastName" type="text" required=""></li>
                            <li class="text">Email :  </li>
                            <li class="agileits-main"><i class="fa fa-envelope" aria-hidden="true"></i><input name="email" type="email" required=""></li>
                            <li class="text">Place Of Birth :  </li>
                            <li class="agileits-main"><i class="fa fa-map-marker" aria-hidden="true"></i><input name="placeOfBirth" type="text" required=""></li>
                            <li class="text">Date of Birth :  </li>
                            <li class="agileits-main"><i class="fa fa-calendar" aria-hidden="true"></i><input class="date" id="datepicker" name="dateOfBirth" type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="" /></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-xs-6 w3l-right-mk">
                        <ul>
                            <li class="text">Password  :  </li>
                            <li class="agileits-main"><i class="fa fa-key" aria-hidden="true"></i><input name="password" type="text" required=""></li>
                            <li class="text">Confirm Password  :  </li>
                            <li class="agileits-main"><i class="fa fa-key" aria-hidden="true"></i><input name="passwordConfirm" type="text" required=""></li>
                            <li class="text">mobile no  :  </li>
                            <li class="agileits-main"><i class="fa fa-phone" aria-hidden="true"></i><input name="phone" type="text" required=""></li>
                            <li class="text">Address  :  </li>
                            <li class="agileits-main"><i class="fa fa-home" aria-hidden="true"></i><input name="address" type="text" required=""></li>
                            <li class="text">Gender  :  </li>
                            <li class="agileits-main"><i class="fa fa-user-o" aria-hidden="true"></i><input name="gender" type="text" required=""></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="agile-submit">
                        <input type="submit" value="submit" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- //banner -->

@include('frontend.register')

@include('frontend.about')

@include('frontend.status')

@include('frontend.services')

@include('frontend.gallery')

@include('frontend.team')

@include('frontend.contact')

@endsection
