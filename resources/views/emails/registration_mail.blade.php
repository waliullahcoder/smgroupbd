<html>

<head>
    <title>Registration Completed</title>
</head>

<body style="background-color: #E1EACD; font-family: sans-serif;">
    <div
        style="padding: 15px; background-color: #fff; text-align-center;border-radius: 10px; padding: 30px; background-color: #fff; text-align: center; box-shadow: 0 0 10px rgb(102 97 97 / 10%); width: 100%; max-width: 600px; margin: 0 auto; overflow: hidden;">
        <div>
            <div style="margin-bottom: 25px;">
                <img src="{{ !is_null($setting) ? asset($setting->logo) : asset('frontend/assets/images/logo/logo.png') }}"
                    height="50" alt="Logo">
            </div>
            <div style="margin-bottom: 25px; font-size: 14px; color: #777; text-align: center;">
                <div>Congratulations, Your are Successfully Registered Bonton Foods Account</div>
            </div>
            <div style="margin-bottom: 25px;">
                <h2 style="margin: 0; text-align: center;">Dear {{ $mailData['name'] }}, <br> Registration Completed</h2>
                <div style="display: flex; justify-content: center; align-items: center; gap: 5px; padding: 8px 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#ddd" height="0.6em" viewBox="0 0 576 512">
                        <path
                            d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" />
                    </svg>
                </div>
                <div style="font-size: 14px; color: #777; max-width: 350px; margin: 0 auto 30px; line-height: 1.5;">
                    Thank you for your registration. You can login your Account with attached credentials. Please click
                    on the given link to Login Your Account.
                </div>
                <div style="font-size: 14px; color: #333; max-width: 350px; margin: 0 auto 30px; line-height: 1.5;">
                    Your Phone Number is <span style="color: #0f887c; font-weight: 600;">{{ $mailData['phone'] }}</span>
                    <br>
                    Your Email is <span style="color: #0f887c; font-weight: 600;">{{ $mailData['email'] }}</span> <br>
                    Your Password is <span style="color: #0f887c; font-weight: 600;">{{ $mailData['password'] }}</span>
                    <br>
                </div>
                <div style="text-align: center;text-transform: uppercase;">
                    <a href="{{ $mailData['login_link'] }}"
                        style="text-decoration: none;background: #0f887c;color: #fff;padding: 10px; font-size: 14px; display: inline-block;">Click
                        here to Login</a>
                </div>
            </div>
            <div style="background-color: #0e4168; color: #fff; padding: 15px 0; margin: -30px; margin-top: 0; text-align: center;">
                {{ !is_null($setting) ? $setting->title : 'Your title' }}
            </div>
        </div>
    </div>
</body>

</html>
