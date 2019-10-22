@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="regForm" class="regForm">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>

                                    <span class="invalid-feedback" role="alert" data-field="name">
                                    <strong></strong>
                                </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required>

                                    <span class="invalid-feedback" role="alert" data-field="email">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    <span class="invalid-feedback" role="alert" data-field="password">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                const $forms = $(".regForm .form-group .invalid-feedback");
                const $inputs = $("#regForm input");
                $(regForm).on("submit", async function (e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    $forms.fadeOut("slow");
                    $inputs.removeClass("is-invalid");


                    const response = await fetch("/api/register", {
                        method: "POST",
                        body: formData,
                    });

                    const data = await response.json();

                    console.log(data);

                    if(!response.ok) {
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
                    } else {
                        window.location.pathname = "/login";
                    }
                });
            });
        </script>
    </div>
@endsection
