@extends('emails.email_master')

@section('email_content')
    <table style="text-align:center; font-size:13px;">
        <tr>
            <td>
                <p style="font-size:13px;line-height:22px;color: #3c3c3c;">You have been successfully added to our mailing list, keeping you up-to-date with our latest news.
                    You'll get all the details on new releases and upcoming events before anyone else.</p>
                <p style="font-size:13px;line-height:22px;color: #3c3c3c;">Thank you once again and please continue to explore
                    <a href="http://featherq.com/" target="_blank"> FeatherQ</a>.</p>
            </td>
        </tr>
    </table>

@stop