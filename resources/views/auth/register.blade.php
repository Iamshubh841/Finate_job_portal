@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <!--== Start Login Area Wrapper ==-->
        <section class="account-login-area">
    <div class="page-header-area sec-overlay sec-overlay-black"  data-bg-img="{{ asset('assets/img/bg2.webp') }}">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-12">
            <div class="page-header-content">
              <h2 class="title">Register Page</h2>
              <nav class="breadcrumb-area">
                <ul class="breadcrumb justify-content-center">
                  <li><a href="index.html">Home</a></li>
                  <li class="breadcrumb-sep">//</li>
                  <li>Pages</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-7 col-xl-6">
                        <div class="login-register-form-wrap register-form-wrap">
                            <div class="login-register-form">
                                <div class="form-title">
                                    <h4 class="title">Register Now</h4>
                                </div>
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">

                                        <button class="nav-link active" id="candidate-tab" data-bs-toggle="pill"
                                            data-bs-target="#candidate" type="button" role="tab"
                                            aria-controls="candidate" aria-selected="true"><i
                                                class="icofont-businessman"></i> Candidate</button>
                                    </li>
                                    <li class="nav-item" role="presentation">

                                        <button class="nav-link" id="employer-tab" data-bs-toggle="pill"
                                            data-bs-target="#employer" type="button" role="tab"
                                            aria-controls="employer" aria-selected="false"><i class="icofont-bag-alt"></i>
                                            Employer</button>
                                    </li>
                                </ul>
                                {{-- candidate page --}}
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="candidate" role="tabpanel"
                                        aria-labelledby="candidate-tab">
                                        <form method="post" action="{{ route('register') }}">
                                            @csrf
                                            <input type="hidden" name="role" value="candidate">
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text"placeholder="First Name"
                                                            name="first_name" value="{{ old('first_name') }}">
                                                        @error('first_name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror

                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text"
                                                                placeholder="Last Name" name="last_name"
                                                                value="{{ old('last_name') }}">
                                                            @error('last_name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control"
                                                                    type="tel"placeholder="Contact No"
                                                                    name="contact_number"
                                                                    value="{{ old('contact_number') }}">
                                                                @error('contact_number')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror

                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control"
                                                                        type="email"placeholder="Email" name="email"
                                                                        value="{{ old('email') }}">
                                                                    @error('email')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" type="password"
                                                                        name="password" placeholder="Password">
                                                                    @error('password')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" type="password"
                                                                        placeholder="Confirm Password"
                                                                        name="password_confirmation">
                                                                    @error('password_confirmation')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="remember-forgot-info">
                                                                        <div class="remember">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="" id="defaultCheck1">
                                                                            <label class="form-check-label"
                                                                                for="defaultCheck1">Aaccept our terms and
                                                                                conditions and privacy policy.</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn-theme">Register
                                                                        Now</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="employer" role="tabpanel"
                                        aria-labelledby="employer-tab">
                                        <form method="post" action="{{ route('register') }}">
                                            @csrf
                                            <input type="hidden" name="role" value="employers">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text"placeholder="Company Name"
                                                            name="first_name" value="{{ old('first_name') }}">
                                                        @error('first_name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        {{-- <div class="form-group">
                                                            <input class="form-control"
                                                                type="text"placeholder="Last Name" name="last_name"
                                                                value="{{ old('last_name') }}">

                                                        </div> --}}

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control"
                                                                    type="tel"placeholder="Contact No"
                                                                    name="contact_number"
                                                                    value="{{ old('contact_number') }}">
                                                                @error('contact_number')
                                                                    <div class ='aleart aleart-danger'>{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" type="email"
                                                                        placeholder="Email" name="email"
                                                                        value="{{ old('email') }}">
                                                                    @error('email')
                                                                        <div class = 'aleart aleart danger'>
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" type="password"
                                                                        placeholder="Password" name="password">
                                                                    @error('password')
                                                                        <div class = 'aleart aleart danger'>
                                                                            {{ $message }}</div>
                                                                    @enderror

                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" type="password"
                                                                        placeholder="Confirm Password"
                                                                        name="password_confirmation">

                                                                    @error('confirm_password')
                                                                        <div class ='aleart alerat danger'>{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="remember-forgot-info">
                                                                        <div class="remember">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value=""
                                                                                id="defaultCheck2">
                                                                            <label class="form-check-label"
                                                                                for="defaultCheck2">Aaccept our
                                                                                terms and
                                                                                conditions and privacy
                                                                                policy.</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn-theme">Register Now
                                                                        </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="login-register-form-info">
                                    <p>Already have an account? <a href={{ url('login') }}>Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </main>
    @endsection
