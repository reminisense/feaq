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
                    <p>Hello{{ ' ' . $name }}!</p>
                    <p>Thank you for using FeatherQ!</p>
                    <p>Your number (# {{ $priority_number }}) will soon be called.</p>
                    @if($numbers_ahead == 1)
                    <p>There is only {{ $numbers_ahead }} person ahead of you </p>
                    @else($numbers_ahead > 1)
                    <p>There are only {{ $numbers_ahead }} people ahead of you </p>
                    @endif
                    <p>To know more about the status of your queue, log on to <a href="http://featherq.com">FeatherQ.com</a></p>
                </strong>
            </p>
        </td>
    </tr>
</table>

@stop