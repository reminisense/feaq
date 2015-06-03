@extends('emails.email_master')

@section('email_content')
<table style="text-align:center; font-size:13px;">
    <tr>
        <td>
            <h2>Hello{{ ' ' . $name }}!</h2>
            <h2>Welcome to FeatherQ!</h2>
            <p style="font-size:13px;line-height:22px;color: #3c3c3c;">This message implies that you have signed up for <a href="{{ url('/') }}">FeatherQ.com</a> using your Facebook account.</p>
            <p>To know more about our features, log in to <a href="{{ url('/') }}">FeatherQ.com</a>.</p>
            <h3>Start using FeatherQ and #ChangeTheWait</h3><br>
        </td>
    </tr>
</table>

@stop