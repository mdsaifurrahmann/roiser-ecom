@extends('layouts.client')

@section('body')


    <section class="login-area pt-100 pb-100">
        <div class="container">
            <div class="login-wrap text-center">
                <h3 class="title">Create Your Account</h3>
                <a href="#" class="google-login"><img src="assets/img/icon/google.png" alt="google">Login with Google</a>
                <span class="or-text">OR</span>
                <form action="mail.php" class="login-form">
                    <div class="form-item">
                        <h4 class="form-header">Your Name*</h4>
                        <input type="text" id="name" name="name" class="form-control" placeholder="">
                    </div>
                    <div class="form-item">
                        <h4 class="form-header">Phone Number*</h4>
                        <input type="text" id="email" name="email" class="form-control" placeholder="">
                    </div>
                    <div class="form-item">
                        <h4 class="form-header">Password*</h4>
                        <input type="text" id="text-2" name="text-2" class="form-control" placeholder="">
                    </div>
                    <div class="form-item">
                        <div class="checkbox-wrap mb-10">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> Subscribe to stay updated with new products and offers!</label><br>
                        </div>
                        <div class="checkbox-wrap">
                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Bike">
                            <label for="vehicle2"> I accept the  <span>Terms / Privacy Policy</span></label><br>
                        </div>
                    </div>
                    <div class="submit-btn">
                        <button class="rr-primary-btn">Register Account</button>
                    </div>
                    <div class="login-btn-wrap">
                        <a href="#" class="forgot">Already have an account?</a>
                        <a class="log-in" href="{{route('login')}}">Log in</a>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection
