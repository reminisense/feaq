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

    <div class="banner" style="visibility: visible;">
      <div class="row filters">
        <div class="container">
          <div class="col-md-5 col-md-offset-1">
            <div class="filterwrap">
              <span>FILTER:</span>
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Location
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                    <li><a href="#">Dropdown link</a></li>
                    <li><a href="#">Dropdown link</a></li>
                  </ul>
                </div>
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Industry Type
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                    <li><a href="#">Dropdown 2</a></li>
                    <li><a href="#">Dropdown 2</a></li>
                  </ul>
                </div>
                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Time Open
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                    <li><a href="#">Dropdown 3</a></li>
                    <li><a href="#">Dropdown 3</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="searchblock">
              <form>
                <input type="text" placeholder="Search a Business">
                <button type="button" class="btn btn-orange btn-md">SEARCH</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="caption">
          <div class="pull-left">
            <h1>Change the wait</h1>
            <p>No need to wait inline. Focus on things that matter!</p>
          </div>
        </div>
      </div>

      <div class="businesses">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
              @if(count($search_businesses) > 0)
                <div class="col-md-12">
                  <p class="heading">New Businesses</p>
                </div>
                @foreach($search_businesses as $business)
                <div class="col-md-6 col-xs-12">
                  <div class="boxed boxed-single clickable">
                    <a class="business_link" href="{{ URL::to( '/broadcast/business/' . $business['business_id'] ) }}" target="_blank">
                    <div class="wrap">
                      <h3>{{ $business['name'] }}</h3>
                      <small>{{ $business['local_address'] }}</small>
                    </div>
                    </a>
                  </div>
                </div>
                @endforeach
              @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                @if(count($active_businesses) > 0)
                  <div class="col-md-12">
                    <p class="heading">Active Businesses</p>
                  </div>
                  @foreach($active_businesses as $ac_business_id => $actives)
                  <div class="col-md-6 col-xs-12">
                    <div class="boxed boxed-single clickable">
                      <a class="business_link" href="{{ URL::to( '/broadcast/business/' . $ac_business_id ) }}" target="_blank">
                      <div class="wrap">
                        <h3>{{ $actives['name'] }}</h3>
                        <small>{{ $actives['local_address'] }}</small>
                      </div>
                      </a>
                    </div>
                  </div>
                  @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="how" class="how">
      <div class="container">
        <div class="col-md-12">
          <h1>How does it work?</h1>
        </div>
        <div class="col-md-6">
          <h5>FOR BUSINESS</h5>
          <h3>1. Login via Facebook</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
          <h3>2. Setup your Business</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
          <h3>3. Process your Queue</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-6">
          <h5>FOR USERS</h5>
          <h3>1. Login via Facebook</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
          <h3>2. Queue to any Business</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
      </div>
    </div>

    <div id="feats" class="feats">
      <div class="container">
        <div class="col-md-12">
          <h1>FeatherQ Features</h1>
        </div>
        <div class="col-md-3">
          <h3>30-second Business Setup</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Remote Queuing</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Business Analytics</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>its FREE!</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Customisable Broadcast Screens</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Mobile Responsive</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>SMS and Email Notifications</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Featureful Process Queue</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
      </div>
    </div>

    <div class="signup">
      <div class="container">
        <div class="col-md-2 col-md-offset-5" style="margin-top:-20px;"><hr></div>
        <div class="content wow fadeInDown animated" style="visibility: visible;">
          <div class="col-lg-4  col-md-4 col-lg-offset-1 text-center">
            <img src="images/img-broadcast.png" alt="">
          </div>
          <div class="col-md-6">
            <div>
              <h1>Sign-up for FeatherQ Today!</h1>
              <p>If you have a business that needs a queuing system then FeatherQ is for you! For a limited time FeatherQ Premium will be open for 3 months free trial to a limited number of businesses! Be part of history as We change the way the world waits.</p>
              <br>
              <div class="button mb30" ng-controller="fbController">
                <a href="" ng-click="login()" class="btn btn-orange">Sign up for a Free Account</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="contact">
      <div class="container">
          <h1 class="col-md-12">Send us a message</h1>

        <div class="col-md-6 wow fadeInDown  animated" style="visibility: visible;">
          <a name="contact"></a>
          {{ Form::open(array('url' => '/', 'class' => 'row', 'role' => 'form')) }}
            @if(Session::has('message'))
            <div class="alert alert-success col-md-10">
                <p>{{ Session::get('message') }}</p>
            </div>
            @endif
            <div class="col-md-10">
              {{ Form::text('name', null, array('id' => 'name', 'name' => 'name', 'class' => 'form-control col-md-4', 'placeholder' => 'Name*', 'required' => 'required')) }}
            </div>
            <div class="col-md-10">
             {{ Form::email('email', null, array('type' => 'email', 'id' => 'inputEmail3', 'name' => 'email', 'class' => 'form-control col-md-4', 'placeholder' => 'Email*', 'required' => 'required')) }}
            </div>
            <div class="col-md-10">
              {{ Form::textarea('message', null, array('rows' => '6', 'class' => 'form-control', 'placeholder' => 'Message*', 'style' => 'background: none; color: #fff', 'required' => 'required')) }}
            </div>
            <div class="col-md-10 button">
                {{ Form::submit('Send', array('id' => 'contact', 'class' => 'btn btn-orange mb30', 'style' => 'padding: 10px 20px;')) }}
            </div>
          </form>
        </div>
        <div class="col-md-6 wow fadeInDown animated" style="visibility: visible;">
          <p class="mb30">If you have a business that needs a queuing system then FeatherQ is for you! For a limited time FeatherQ Premium will be open for 3 months free trial to a limited number of businesses! Be part of history as We change the way the world waits.</p>
          <table class="table mb30">
            <tbody><tr>
              <td>Address:</td>
              <td>Reminisense Corp. Office,<br>
                eNGy Bldg.<br>
                Hernan Cortes Street,<br>
                Mandaue City, Philippines
              </td>
            </tr>
            <tr>
              <td>Email:</td>
              <td>contact@featherq.net</td>
            </tr>
            <tr>
              <td>Telephone:</td>
              <td>(032) 345-4658</td>
            </tr>
          </tbody></table>
          <a href="https://www.facebook.com/theFeatherQ" target="_blank"><img src="images/social-fb.png" class="socials" /></a>
          <a href="https://plus.google.com/+Featherq/posts" target="_blank"><img src="images/social-gp.png" class="socials" /></a>
          <a href="https://twitter.com/thefeatherq" target="_blank"><img src="images/social-tw.png" class="socials"/></a>
        </div>
      </div>
    </div>

    <div class="footer">
      <div class="container">
        <div class="col-md-12">
          © 2014 : Reminisense Corp.
        </div>
      </div>
    </div>

<script type="text/javascript">
$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
        || location.hostname == this.hostname) {

        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
           if (target.length) {
             $('html,body').animate({
                 scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    }
});
</script>

@stop