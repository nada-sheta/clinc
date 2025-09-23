@extends('dashboard.app')
@section('title','Preview & Edit Email Message')
@section('content')

<form action="{{ route('dashboard.send.mail.accept',session('id_doctor')) }}" method="POST">
    @csrf

    <input type="hidden" name="name" id="name">
    <input type="hidden" name="email" id="email">
    <input type="hidden" name="password" id="password">
    <input type="hidden" name="message" id="message">
    <input type="hidden" name="footer" id="footer">

    <div class="container" style="background-color: white; padding: 30px; border-radius: 8px; max-width: 700px; margin: auto;">
        <h2 contenteditable="true" id="edit_name">Welcome Dr. {{ session('name') }} 👨‍⚕️</h2>

        <p contenteditable="true" id="edit_message">
            We are pleased to inform you that your account has been approved and you are now officially part of our platform.
        </p>

        <div class="info" style="margin-top: 20px;">
            <p><strong>Email:</strong> <span contenteditable="true" id="edit_email">{{ session('email') }}</span></p>
            <p><strong>Password:</strong> <span contenteditable="true" id="edit_password">{{ session('password') }}</span></p>
        </div>

        <p contenteditable="true" id="edit_footer">You can now log in using the above credentials and start managing your appointments.</p>

        <div class="footer" style="margin-top: 30px; font-size: 14px; color: #777;">
            <p contenteditable="true" id="edit_thankyou">Thank you for joining us!</p>
            <p contenteditable="true" id="edit_team">— The Website Team</p>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary" onclick="prepareAndSend()">Send Email</button>
        </div>
    </div>
</form>

<script>
    function prepareAndSend() {
        document.getElementById('name').value = document.getElementById('edit_name').innerText;
        document.getElementById('email').value = document.getElementById('edit_email').innerText;
        document.getElementById('password').value = document.getElementById('edit_password').innerText;
        document.getElementById('message').value = document.getElementById('edit_message').innerText;

        let footerText = document.getElementById('edit_footer').innerText + "\n\n" +
                         document.getElementById('edit_thankyou').innerText + "\n" +
                         document.getElementById('edit_team').innerText;

        document.getElementById('footer').value = footerText;
    }
</script>

@endsection
