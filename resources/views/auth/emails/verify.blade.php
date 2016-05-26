<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            <p>
            Hellow {{ $name}}
            </p>
            <br/>
            <p>Thanks for creating an account with the verification demo app.
            Please follow the link below to verify your email address :
            <br/>
            -------------
            {{ URL::to('register/verify/' . $confirmation_code) }} OR , 
            <br/>
            -------------
            {{$link}}
            <br/>
            -------------
            </p>
            <br/>

        </div>

    </body>
</html>