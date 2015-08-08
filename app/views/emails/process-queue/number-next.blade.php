@extends('emails.email_master')

@section('email_content')
<table style="text-align:center; font-size:13px;">
    <tr>
        <td>
            <h2>Your number will be called soon!</h2>
        </td>
    </tr>
    <tr>
        <td style="border-top:1px solid #c7c7c7; height:20px; text-align: left;">
            <p style="font-size:13px;padding: 0 20px;">
                <strong>
                    <p>Hello{{ ' ' . $name }},</p>
                    <p>Your number ({{ $priority_number }}) will be called in about {{ $estimated_time }}. You are currently lined up at {{ $business_name }}. </p>
                    <p>To know more about the status of your queue, please log on to <a href="http://featherq.com">FeatherQ.com</a></p>
                </strong>
            </p>
        </td>
    </tr>
</table>

@stop