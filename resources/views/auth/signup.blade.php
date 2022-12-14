@extends('auth.auth_layout')

@section('title')
signup
@endsection

@section('content')
<div class="card-body register-card-body">
    <p class="login-box-msg">Register a new membership</p>
    @if (count($errors) > 0)
    <ul>
    @foreach ($errors->all() as $error)
    <li style="color: red">{{$error}}</li>
    @endforeach
    </ul>
    @endif
    <form action="{{Route('register.post')}}" method="post">
        @csrf
      <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Full name" value="{{old('name')}}" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
            <label for="agreeTerms">
             I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-primary">
        <i class="fab fa-facebook mr-2"></i>
        Sign up using Facebook
      </a>
      <a href="#" class="btn btn-block btn-danger">
        <i class="fab fa-google-plus mr-2"></i>
        Sign up using Google+
      </a>
    </div>

    <a href="{{Route('login')}}" class="text-center">I already have a membership</a>
  </div>
@endsection
