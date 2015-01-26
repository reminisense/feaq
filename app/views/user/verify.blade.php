<div class="form_container">
    {{ Form::open(array('url' => '/user/store', 'method' => 'post')) }}
        First Name: {{ Form::text('first_name', $user['first_name']) }} <br/>
        Last Name: {{ Form::text('last_name', $user['last_name']) }} <br/>
        Email: {{ Form::text('email', $user['email']) }} <br/>
        Mobile: {{ Form::text('mobile', $user['mobile']) }} <br/>
        Location: {{ Form::text('location', $user['location']) }} <br/>
        {{ Form::hidden('gender', $user['gender']) }}
        {{ Form::hidden('fb_id', $user['fb_id']) }}
        {{ Form::hidden('fb_url', $user['fb_url']) }}
        {{ Form::submit('Start Queueing') }}
    {{ Form::close() }}
</div>