<html>
<head>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/signup/signup.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
</head>
<body>


<section id="signup-header">
        <div class="">
            <div class="container">
                <div class="text-center col-md-12">
                    <a class="logo" href="/"><img src="/images/homepage/landing/FeatherQ-logo.png" alt="FeatherQ" /></a>
                    <h3 class="mt40">Create New Password</h3>
                </div>
            </div>
            <div class="tri text-center" style="position: relative;bottom: -28px;"><img src="/images/homepage/tri.png"></div>
        </div>
    </section>
<section id="signup-body">
            <div class="">
                <div class="container">
                    <div class="col-md-offset-3 col-md-6 text-center" ng-controller="emailAuthController">
                        <div class="clearfix col-md-12">
                            <div>
                                @if(isset($error) && $error != '')
                                <div>
                                    <div class="alert alert-warning"> {{ $error  }}</div>
                                </div>
                                @endif
                                @if(isset($success) && $success != '')
                                <div>
                                    <div class="alert alert-success"> {{ $success  }}</div>
                                </div>
                                @endif
                            </div>
                        </div>


                        <form id="login" class="col-md-12" method="post" action="{{url('/user/password-reset')}}">
                            <input type="hidden" name="user_id" value="{{ $user_id }}"/>
                            <div class="clearfix">
                                <label>Password</label>
                                <div class="rel">
                                    <i class="abs glyphicon glyphicon-lock"></i>
                                    <input class="abs form-control" type="password" name="password" />
                                </div>
                            </div>

                            <div class="clearfix">
                                <label>Confirm Password</label>
                                <div class="rel">
                                    <i class="abs glyphicon glyphicon-lock"></i>
                                    <input class="abs form-control" type="password" name="password_confirm" />
                                </div>
                            </div>

                            <div class="row mt30">
                                <div class="col-md-6 col-xs-12 text-left">

                                </div>
                                <div class="col-md-6 col-xs-12 text-right ">
                                    <button class="btn btn-teal" type="submit">Submit</button>
                                </div>
                             </div>

                        </form>





                    </div>


                </div>
            </div>
    </section>



</body>
</html>