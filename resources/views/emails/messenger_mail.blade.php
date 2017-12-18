@extends('frontend.email_main')
@section('content')

    <table style="font-weight:normal;border-collapse:collapse;border:0;padding:0;margin-top:0;width:640px; margin:0 auto;">
        <tbody>
        <tr>
            <td style="border-collapse:collapse;border:0;margin:0;padding:18px;color:#333;font-family:Arial,sans-serif;font-size:16px;line-height:24px;background-color:#fff;">
                <h1 style="color:#333;font-size:16px;font-weight:bold;line-height:24px">Hi, {{ $recv_name }}<br />
                </h1>

                <div>You've received messages from <strong>{{ $sender_name }}</strong>.</div>
                <p>Subject: {{ $subject }}</p>
                <p>Message: {{ $comments }}</p>
                <p>Email: {{ $sender_email }}</p>
                <a href="{{ $message_btn }}" class="btn btn-warning">View and Reply</a>
            </td>
        </tr>
        </tbody>
    </table>

@endsection