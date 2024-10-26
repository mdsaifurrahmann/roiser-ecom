@extends('layouts.client')

@section('title', 'Login')

@section('body')

    <section class="login-area pt-100 pb-100">
        <div class="container">
            <div class="login-wrap text-center">
                <h3 class="title">Login Into Your Account</h3>
                <a href="#" class="google-login"><img src="assets/img/icon/google.png" alt="google">Login with Google</a>
                <span class="or-text">OR</span>
                <form action="mail.php" class="login-form">
                    <div class="form-item">
                        <h4 class="form-header">Phone Number*</h4>
                        <input type="text" id="text" name="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-item">
                        <h4 class="form-header">Password*</h4>
                        <input type="text" id="text-2" name="text-2" class="form-control" placeholder="">
                    </div>
                    <div class="form-item">
                        <div class="checkbox-wrap">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> Remember me</label><br>
                        </div>
                    </div>
                    <div class="submit-btn">
                        <button class="rr-primary-btn">Login Account</button>
                    </div>
                    <a href="#" class="forgot">Lost your password?</a>
                </form>
            </div>
        </div>
    </section>

@endsection
