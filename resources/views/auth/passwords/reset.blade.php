@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="javascript:;">Pages</a></li>
                <li class="active">Login</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN SIDEBAR -->
                <div class="sidebar col-md-3 col-sm-3">
                    <ul class="list-group margin-bottom-25 sidebar-menu">
                        <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Login/Register</a></li>
                        <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Restore Password</a></li>
                        <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> My account</a></li>
                        <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Address book</a></li>
                        <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Wish list</a></li>
                        <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Returns</a></li>
                        <li class="list-group-item clearfix"><a href="javascript:;"><i class="fa fa-angle-right"></i> Newsletter</a></li>
                    </ul>
                </div>
                <!-- END SIDEBAR -->

                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-9">
                    <h1>Reset Password</h1>
                    <div class="content-form-page">
                        <div class="row">
                            <div class="col-md-7 col-sm-7">
                                <div class="login-box-body">
                                    <div class="login-box-body">


                                        @if ($errors->has('email'))
                                            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                                        @endif

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
                                        @endif

                                        @if ($errors->has('status'))
                                            <span class="help-block">
                <strong>{{ $errors->first('status') }}</strong>
            </span>
                                        @endif



                                        <form class="form-horizontal" method="POST" action="{{ url('password/reset') }}">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password" class="col-md-4 control-label">Password</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Reset Password
                                                    </button>
                                                </div>
                                            </div>
                                        </form>


                                        <!-- /.social-auth-links -->

                                        <a href="{{ url('password/reset') }}">I forgot my password</a><br>
                                        <a href="{{ route('register') }}" class="text-center">Register</a>

                                    </div>




                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 pull-right">
                                <div class="form-info">
                                    <h2><em>Important</em> Information</h2>
                                    <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>

                                    <button type="button" class="btn btn-default">More details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@endsection
