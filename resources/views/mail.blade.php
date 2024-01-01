<h2>Dear {{ $employe['name'] }}</h2>
<p>
    Greetings and a warm welcome to Highsense! We are absolutely delighted to extend our heartfelt welcome as you step on board and become an integral part of our dynamic team. Your decision to join us is a source of immense joy, and we eagerly anticipate the positive energy and valuable contributions you will bring to our workplace.
</p>
<br/>
<h5>
    *Your Login Information:*
</h5>
    <p>   Username :  {{ $employe['emp_email'] }} </p>
    <p>   Password : {{ $employe['raw_password'] }}</p>
    <br/>
    <p>Please use the following link to log in to your work report account.</p>
    <a href="{{ route('employe.dashboard' ) }}"><p>Login Url</p></a>
   
    <br/>
    <p>We look forward to working together and wish you a successful and rewarding career at Highsense.
    </p>
    <br/>
    <p>Best regards,</p>
    <p>HR Dept. </p>
    <p>Highsense</p>
