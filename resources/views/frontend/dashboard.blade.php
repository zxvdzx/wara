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
                <div class="alert-info">
                    @include('flash::message')
                </div>
                @if (Session::has('notice'))
                    <div class="alert alert-info">{!! Session::get('notice') !!}</div>
                @endif
                {!! Form::open(['route'=>'user.register', 'files'=>true, 'class' => 'mod2']) !!}
                    <div class="col-md-6 col-xs-6 w3l-left-mk">
                        <ul>
                            <li class="text">First Name :  </li>
                            <li class="text">
                                @if ($errors->has('firstName'))
                                    <div class="error">{{ $errors->first('firstName') }}</div>
                                @endif
                            </li>
                            <li class="agileits-main">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <input name="firstName" type="text" >
                            </li>
                            <li class="text">Last Name :  </li>
                            <li class="agileits-main">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <input name="lastName" type="text">
                            </li>
                            <li class="text">Email :  </li>
                            <li class="text">
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </li>
                            <li class="agileits-main">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <input type="email" name="email" >
                            </li>
                            <li class="text">Birthplace :  </li>
                            <li class="text">
                                @if ($errors->has('birthplace'))
                                    <div class="error">{{ $errors->first('birthplace') }}</div>
                                @endif
                            </li>
                            <li class="agileits-main">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <input name="birthplace" type="text" >
                            </li>
                            <li class="text">Birthdate :  </li>
                            <li class="text">
                                @if ($errors->has('birthdate'))
                                    <div class="error">{{ $errors->first('birthdate') }}</div>
                                @endif
                            </li>
                            <li class="agileits-main">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <input class="date" id="datepicker" name="birthdate" type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" />
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-xs-6 w3l-right-mk">
                        <ul>
                            <li class="text">Password  :  </li>
                            <li class="text">
                                @if ($errors->has('password'))
                                    <div class="error">{{ $errors->first('password') }}</div>
                                @endif
                            </li>
                            <li class="agileits-main">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <input name="password" type="password">
                            </li>
                            <li class="text">Confirm Password  :  </li>
                            <li class="text">
                                @if ($errors->has('password_confirmation'))
                                    <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </li>
                            <li class="agileits-main">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <input name="password_confirmation" type="password">
                            </li>
                            <li class="text">mobile no  :  </li>
                            <li class="text">
                                @if ($errors->has('phone'))
                                    <div class="error">{{ $errors->first('phone') }}</div>
                                @endif
                            </li>
                            <li class="agileits-main">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <input name="phone" type="text">
                            </li>
                            <li class="text">Address  :  </li>
                            <li class="text">
                                @if ($errors->has('address'))
                                    <div class="error">{{ $errors->first('address') }}</div>
                                @endif
                            </li>
                            <li class="agileits-main">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <input name="address" type="text">
                            </li>
                            <li class="text">Gender  :  </li>
                            <li class="text">
                                @if ($errors->has('gender'))
                                    <div class="error">{{ $errors->first('gender') }}</div>
                                @endif
                            </li>
                            <li class="agileits-main">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <select name="gender">
                                    <option value"L">Man</option>
                                    <option value"P">Women</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="agile-submit">
                        <input type="submit" value="submit">
                    </div>
                {!! Form::close() !!}
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
