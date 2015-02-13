@extends('master')

@section('scripts')
    {{ HTML::script('js/user/user.js') }}
@stop

@section('body')

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->
<!--
<fb:login-button scope="public_profile,email,user_friends" onlogin="FeatherQ.facebook.checkLoginState();" id="login">
</fb:login-button>
-->

<div class="banner wow fadeIn">
    <div class="container">
        <div class="col-md-4 col-md-offset-8 wow fadeInRight" ng-controller="fbController">
            <h1>Change the wait</h1>
            <p>FeatherQ is the first ever cloud-based queuing system that works perfectly with any browser thus allowing a universal compatibility function. With the processes happening online, users need not wait in line anymore as they can allow their phone to wait in line for them.</p>
            <a href="#" class="btn btn-blue fb" ng-click="login()" id="fb-login"><img src="images/icon-fb.png"> Login with Facebook</a>
        </div>
    </div>
</div>

<div class="container about">
    <div class="col-md-10 col-md-offset-1 text-center">
        <a name="about"></a>
        <img id="attn" src="images/featherq-solo.png">
        <h1 class="wow fadeInDown">Introducing FeatherQ, the first ever cloud-based queuing system that works perfectly with any browser</h1>
    </div>
    <div class="col-md-offset-2 col-md-8 text-center">
        <p class="subhead wow fadeInDown">FeatherQ is the first ever cloud-based queuing system that works perfectly with any browser thus allowing a universal compatibility function. With the processes happening online, users need not wait in line anymore as they can allow their phone to wait in line for them.</p>
    </div>
</div>

<div class="row">
    <div class="container">
        <div class="col-md-2 col-xs-4 col-xs-offset-4 col-md-offset-5 text-center">
            <br>
            <a name="features"></a>
            <hr></hr>
        </div>
    </div>
</div>

<div class="row features">
    <div class="container">
        <div class="col-lg-12 text-center">
            <div class="content">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="wow bounceIn mb30">
                            <img src="images/icon-settings.png" alt="">
                        </div>
                        <h4 class="wow fadeInDown">Easy Setup</h4>
                        <p class="wow fadeInDown text-center mb30">Business Users need only log-in with their accounts and start processing the queues. No more software installation, no more inter-device network cabling. Just connect to the internet and process those queues!</p>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="wow bounceIn mb30">
                            <img src="images/icon-responsive.png" alt="">
                        </div>
                        <h4 class="wow fadeInDown">Responsive</h4>
                        <p class="wow fadeInDown text-center mb30">Design and function is a core principle for FeatherQ thus having a fully responsive site that adjusts to any device. This allows FeatherQ to work not just in desktop computers but even in mobile devices.</p>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="wow bounceIn mb30">
                            <img src="images/icon-universal.png" alt="">
                        </div>
                        <h4 class="wow fadeInDown">Universal</h4>
                        <p class="wow fadeInDown text-center mb30">Design and function is a core principle for FeatherQ thus having a fully responsive site that adjusts to any device. This allows FeatherQ to work not just in desktop computers but even in mobile devices.</p>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="wow bounceIn mb30">
                            <img src="images/icon-clean.png" alt="">
                        </div>
                        <h4 class="wow fadeInDown">Clean & Simple</h4>
                        <p class="wow fadeInDown text-center mb30">Aesthetics form a strong part of FeatherQ as we work hard to keep our designs clean, simple, and beautiful. Business owners can now enjoy a whole new modern look in their systems with FeatherQ’s Earth Theme. </p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div class="row signup">
    <div class="container">
        <div class="col-md-2 col-md-offset-5" style="margin-top:-20px;"><hr></div>
        <div class="content wow fadeInDown">
            <div class="col-lg-4  col-md-4 col-lg-offset-1 text-center">
                <img src="images/img-broadcast.png" alt="">
            </div>
            <div class="col-md-6">
                <div>
                    <h1>Sign-up for FeatherQ Today!</h1>
                    <p>If you have a business that needs a queuing system then FeatherQ is for you! For a limited time FeatherQ Premium will be open for 3 months free trial to a limited number of businesses! Be part of history as We change the way the world waits.</p>
                    <br>
                    <div class="button mb30" ng-controller="fbController">
                        <!-- <a href="" class="btn btn-orange">Sign up for a Free Account</a> CHANGED TO FB LOGIN -->
                        <a href="#" class="btn btn-blue fb" ng-click="login()" id="fb-login-2"><img src="images/icon-fb.png"> Signup through Facebook</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row request">
    <div class="container">
        <div class="col-lg-8 col-md-8 wow fadeInLeft">
            <h3>Find out how your business can excel in innovative <span>technology development</span> and <span>customer service!</span> </h3>
        </div>
        <div class="col-lg-4 col-md-4  wow fadeInRight">
            <div class="button">
                <a href="" class="btn btn-orange">Request a demo</a>
            </div>
        </div>

    </div>
</div>

<div class="row contact">
    <div class="container">
        <div class="col-md-6 wow fadeInDown ">
            <a name="contact"></a>
            <form class="row">
                <div class="col-md-10">
                    <input type="text" id="name" class="form-control col-md-4" placeholder="Name*" name="name">
                </div>
                <div class="col-md-10">
                    <input type="text" id="email" class="form-control col-md-4" placeholder="Email*" name="email">
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" style="background:none; color:#fff;" rows="6" placeholder="Message*"></textarea>
                </div>
                <div class="col-md-10 button">
                    <a href="" class="btn btn-orange mb30">Send</a>
                </div>
            </form>
        </div>
        <div class="col-md-6 wow fadeInDown">
            <p class="mb30">If you have a business that needs a queuing system then FeatherQ is for you! For a limited time FeatherQ Premium will be open for 3 months free trial to a limited number of businesses! Be part of history as We change the way the world waits.</p>
            <table class="table mb30">
                <tr>
                    <td>Address:</td>
                    <td>Reminisense Corp. Office,<br>
                        eNGy Bldg.<br>
                        Hernan Cortes Street,<br>
                        Mandaue City, Philippines
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>contact@featherq.com</td>
                </tr>
                <tr>
                    <td>Telephone:</td>
                    <td>(032) 345-4658</td>
                </tr>
            </table>
            <a href="" target="_blank"><img src="images/social-fb.png" class="socials" /></a>
            <a href="" target="_blank"><img src="images/social-gp.png" class="socials" /></a>
            <a href="" target="_blank"><img src="images/social-tw.png" class="socials"/></a>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="col-md-6">
                <p>Copyright 2014 : FeatherQ</p>
            </div>
            <div class="col-md-6 text-right">
                <p><a href="">Terms and Conditions</a></p>
            </div>
        </div>
    </div>
    <a href="#0" class="cd-top"><span class="glyphicon glyphicon-chevron-up"></span></a>
</div>

@stop