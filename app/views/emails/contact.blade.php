@extends('emails.email_master')

@section('email_content')
<table style="text-align:center; font-size:13px;">
    <tr>
        <td>
            <h2>FeatherQ just received a message</h2>
        </td>
    </tr>
    <tr>
        <td style="border-top:1px solid #c7c7c7; height:20px; text-align: right;">
            <p style="font-size:13px;padding: 0 20px;">Name:</p>
        </td>
        <td style="border-top:1px solid #c7c7c7; height:20px; text-align: left;">
            <p style="font-size:13px;padding: 0 20px;"><strong>{{ $name }}</strong></p>
        </td>
    </tr>
    <tr>
        <td style="border-top:1px solid #c7c7c7; height:20px; text-align: right;">
            <p style="font-size:13px;padding: 0 20px;">Email:</p>
        </td>
        <td style="border-top:1px solid #c7c7c7; height:20px; text-align: left;">
            <p style="font-size:13px;padding: 0 20px;"><strong>{{ $email }}</strong></p>
        </td>
    </tr>
    <tr>
        <td style="border-top:1px solid #c7c7c7; height:20px; text-align: right;">
            <p style="font-size:13px;padding: 0 20px;">Message:</p>
        </td>
        <td style="border-top:1px solid #c7c7c7; height:20px; text-align: left;">
            <p style="font-size:13px;padding: 0 20px;"><strong>{{ $messageContent }}</strong></p>
        </td>
    </tr>
</table>

@stop