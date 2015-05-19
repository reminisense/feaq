@extends('emails.email_master')

@section('email_content')
    <table style="text-align:center; font-size:13px;">
        <tr>
            <td>
                <h2>{{ $businessName . ' just sent you a message!' }}</h2>
            </td>
        </tr>
        <tr>
            <td style="border-top:1px solid #c7c7c7; height:20px; text-align: left;">
                <p style="font-size:13px;padding: 0 20px;"><strong>{{ str_replace("\n", "<br>", $messageContent) }}</strong></p>
            </td>
        </tr>
    </table>

@stop