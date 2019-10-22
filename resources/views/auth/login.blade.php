@extends('layouts.app')

@section('content')
<div class="container">
    <style>
        .invalid-feedback[data-field="message"] {
            display: block!important;
            text-align: center;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="regForm" class="regForm">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                <span class="invalid-feedback" role="alert" data-field="email">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                <span class="invalid-feedback" role="alert" data-field="password">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row user-not-found" style="display: none;">

                            <div class="col-md-6">
                                <span class="invalid-feedback" role="alert" data-field="message">
                                        <strong></strong>
                                    </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let isSuccess = false;
            const $users = $(".user-not-found");
            const $forms = $(".regForm .form-group .invalid-feedback");
            const $inputs = $("#regForm input");
            $(regForm).on("submit", async function (e) {
                if(!isSuccess) e.preventDefault();
                const formData = new FormData(this);
                $forms.fadeOut("slow");
                $users.fadeOut("slow");
                $inputs.removeClass("is-invalid");

                try {
                    const response = await fetch("/api/login", {
                        method: "POST",
                        body: formData,
                    });

                    const data = await response.json();

                    if(!response.ok) {
                        if(data.userNotFound) {
                            $users.fadeIn("slow");

                            console.log(data.message);


                            setTimeout(() => {
                                $('.invalid-feedback[data-field="message"] strong').html(data.message);
                            }, 0);

                            return false;
                        }

                        for(let i = 0; i < $forms.length; i++) {
                            const formItem = $forms[i];
                            const strong = formItem.querySelector("strong");
                            const field = formItem.getAttribute("data-field");

                            for (const [key, errorItem] of Object.entries(data)) {
                                const currInput = $(`#regForm #${key}`);

                                if(field === key) {
                                    $(formItem).fadeIn("slow");
                                    $(strong).html(`${errorItem}<br>`);
                                    $(currInput).addClass("is-invalid");
                                }
                            }
                        }
                    }
                } catch (err) {
                    isSuccess = true;
                    $(regForm).submit();
                }
            });
        });
    </script>
</div>
@endsection
