@extends('layouts.app')
@section('content')

<br /><br /><br /><br />
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-form-container" style="padding: 3.5rem 9rem; background-color: #ffffff; color: #333; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <h3 class="text-center mb-4" style="color: #007b7b;">Login</h3>

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Username/Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-weight: bold;">Username or Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label" style="font-weight: bold;">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Remember me</label>
                    </div>

                    <!-- Login Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" style="background-color: #004c99; border: none;">Log in</button>
                    </div>
                </form>

                <!-- Additional Links -->
                <div class="text-center mt-3">
                    <p>
                        <a href="{{ route('password.request') }}" class="text-muted">Lost your password?</a>
                    </p>
                    <p>
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
