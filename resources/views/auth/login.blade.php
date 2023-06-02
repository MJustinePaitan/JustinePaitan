@extends('layouts.login')

@section('content')
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-10 col-sm-8 col-md-4 col-lg-5 col-xl-6">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>WELCOME BACK!</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <form method="post"  action="{{route('login')}}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email')  is-invalid @enderror" id="floatingInput" name='email' placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control  @error('password')  is-invalid @enderror" id="floatingPassword" placeholder="Password" name='password'>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div>
                           <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                            <p class="text-center mb-0">Don't have an Account? <a href="{{ route('register') }}">Sign Up</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
@endsection
