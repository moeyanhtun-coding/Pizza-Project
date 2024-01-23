@extends('layouts.master')
@section('title', 'registerPage')
@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
            </div>
            @error('name')
                <small>{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <small>{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="number" name="phone" placeholder="Phone">
            </div>
            @error('phone')
                <small>{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label for="cc-payment" class="control-label mb-1">Gender</label>
                <select name="gender" class="form-control">
                    <option value="Male">Male
                    </option>
                    <option value="Female">Female
                    </option>
                </select>
            </div>
            @error('gender')
                <small>{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" placeholder="Address">
            </div>
            @error('address')
                <small>{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <small>{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Confirm Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <small>{{ $message }}</small>
            @enderror
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage') }}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
