@extends('layout.authbase')
@section("custom_css")

<link href="/backend/assets/build/css/intlTelInput.css" rel="stylesheet" type="text/css" />

@stop

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-4 bg-white">
            <div class=" m-h-100">
                <div class="account-pages pt-5">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-12 p-5">
                                        <div class="mx-auto mb-5">
                                            <a href="{{ url('/') }}">
                                                <img src="{{ ('/frontend/assets/images/fulllogo.png') }}" alt=""
                                                    height="auto" /> </a>
                                        </div>

                                        <h6 class="h5 mb-0 mt-4">Welcome back!</h6>
                                        <p class="text-muted mt-1 mb-4">Enter your phone number and password to
                                            access admin panel.</p>

                                        @if(Session::has('message'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                                            {{ Session::get('message') }}</p>
                                        @endif

                                        @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                        @endforeach
                                        @endif

                                        <form action="{{ route('assistant.authenticate') }}" class="authentication-form"
                                            method="POST" id="submitForm">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-control-label">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                    </div>
                                                    <input type="number" id="phone" name="" class="form-control"
                                                        value="" aria-describedby="helpPhone" placeholder="813012345"
                                                        required>
                                                    <input type="hidden" name="phone_number" id="phone_number"
                                                        class="form-control">
                                                </div>
                                                <small id="helpPhone" class="form-text text-muted">Enter your number
                                                    without the starting 0, eg 813012345</small>
                                            </div>

                                            <div class="form-group mt-4">
                                                <label class="form-control-label">Password</label>
                                                <a href="{{ route('password') }}"
                                                    class="float-right text-muted text-unline-dashed ml-1">Forgot
                                                    your
                                                    password?</a>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="icon-dual" data-feather="lock"></i>
                                                        </span>
                                                    </div>
                                                    <input type="password" name="password" class="form-control"
                                                        id="password" placeholder="Enter your password" required>
                                                </div>
                                            </div>

                                            <div class="form-group mb-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="checkbox-signin" checked>
                                                    <label class="custom-control-label" for="checkbox-signin">Remember
                                                        me</label>
                                                </div>
                                            </div>

                                            <div class="form-group mb-0 text-center">
                                                <button class="btn btn-primary btn-block" type="submit"> Log In
                                                </button>
                                            </div>
                                        </form>
                                        {{-- commented by @jeremiahiro until social login is ready --}}
                                        {{-- <div>
                                                <div class="py-3 text-center">
                                                    <span class="font-size-16 font-weight-bold">Or</span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="#" class="btn btn-white"><i
                                                                class='uil uil-google icon-google mr-2'></i>With Google</a>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <a href="#" class="btn btn-white"><i
                                                                class='uil uil-facebook mr-2 icon-fb'></i>With Facebook</a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 d-none d-md-block bg-cover"
            style="background-image: url(/backend/assets/images/login.svg);">
        </div>
    </div>
</div>

@endsection


@section("javascript")
<script src="/backend/assets/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    var test = window.intlTelInput(input, {
        separateDialCode: true,
        // any initialisation options go here
    });

    $("#phone").keyup(() => {
        if ($("#phone").val().charAt(0) == 0) {
            $("#phone").val($("#phone").val().substring(1));
        }
    });

    $("#submitForm").submit((e) => {
        e.preventDefault();
        const dialCode = test.getSelectedCountryData().dialCode;
        if ($("#phone").val().charAt(0) == 0) {
            $("#phone").val($("#phone").val().substring(1));
        }
        $("#phone_number").val(dialCode + $("#phone").val());
        $("#submitForm").off('submit').submit();
    });

</script>


@stop
