@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Создание записи</div>
                    <span>{{ Auth::user()->name }}</span>
                    <div class="card-body">
                        <form method="POST" action="/api/posts/create" id="regForm" class="regForm">
                            <div class="form-group row">
                                <label for="photo" class="col-sm-4 col-form-label text-md-right">{{ __('Выберите фотографию') }}</label>

                                <div class="col-md-6">
                                    <input id="photo" type="file" class="form-control" name="photo" required>

                                    <span class="invalid-feedback" role="alert" data-field="email">
                                        <strong></strong>
                                    </span>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Введите название фотографии') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required>

                                    <span class="invalid-feedback" role="alert" data-field="email">
                                        <strong></strong>
                                    </span>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label text-md-right">{{ __('Описание фотографии (не обязательно)') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control" name="description" required></textarea>

                                    <span class="invalid-feedback" role="alert" data-field="email">
                                        <strong></strong>
                                    </span>
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        {{ __('Создать запись') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
