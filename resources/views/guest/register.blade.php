@extends('layouts.base') <!-- Assuming you have a master layout file -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dormitory Registration') }}</div>

                    <div class="card-body">
                        <form id="registrationForm" enctype="multipart/form-data">
                            @csrf

                            <!-- Personal Information -->
                            <h4>Personal Information</h4>
                            <!-- TUPT Number -->
                            <div class="form-group row mb-2">
                                <label for="Tuptnum" class="col-md-4 col-form-label text-md-right">{{ __('TUPT Number') }}</label>
                                <div class="col-md-6">
                                    <input id="Tuptnum" type="text" class="form-control @error('Tuptnum') is-invalid @enderror" name="Tuptnum" value="{{ old('Tuptnum') }}" required autocomplete="Tuptnum" autofocus>
                                    @error('Tuptnum')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Full Name -->
                            <div class="form-group row mb-2">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row mb-2">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="off" autofocus>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                                <div class="col-md-6">
                                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                                        <option value="" selected hidden></option>
                                        <option value="Student">Student</option>
                                        <option value="Faculty">Faculty</option>
                                        <option value="Staff">Staff</option>

                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Sex -->
                            <div class="form-group row mb-2">
                                <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sex') }}</label>
                                <div class="col-md-6">
                                    <select id="sex" class="form-control @error('sex') is-invalid @enderror" name="sex" required>
                                        <option value="" selected hidden></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('sex')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Birthdate -->
                            <div class="form-group row mb-2">
                                <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birthdate') }}</label>
                                <div class="col-md-6">
                                    <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" required>
                                    @error('birthdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <h4>Contact Information</h4>

                            <!-- Address -->
                            <div class="form-group row mb-2">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                                <div class="col-md-6">
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contacts -->
                            <div class="form-group row mb-2">
                                <label for="contacts" class="col-md-4 col-form-label text-md-right">{{ __('Contacts') }}</label>
                                <div class="col-md-6">
                                    <input id="contacts" type="text" class="form-control @error('contacts') is-invalid @enderror" name="contacts" value="{{ old('contacts') }}" required>
                                    @error('contacts')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <h4>File Inputs</h4>
                            <!-- Contract -->
                            <div class="form-group row mb-2">
                                <label for="contract" class="col-md-4 col-form-label text-md-right">{{ __('Contract') }}</label>
                                <div class="col-md-6">
                                    <input id="contract" type="file" class="form-control-file @error('contract') is-invalid @enderror" name="contract" required>
                                    @error('contract')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- COR -->
                            <div class="form-group row mb-2">
                                <label for="cor" class="col-md-4 col-form-label text-md-right">{{ __('COR') }}</label>
                                <div class="col-md-6">
                                    <input id="cor" type="file" class="form-control-file @error('cor') is-invalid @enderror" name="cor" required>
                                    @error('cor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Valid ID -->
                            <div class="form-group row mb-2">
                                <label for="validId" class="col-md-4 col-form-label text-md-right">{{ __('Student ID') }}</label>
                                <div class="col-md-6">
                                    <input id="validId" type="file" class="form-control-file @error('validId') is-invalid @enderror" name="validId" required>
                                    @error('validId')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Vaccine Card -->
                            <div class="form-group row mb-2">
                                <label for="vaccineCard" class="col-md-4 col-form-label text-md-right">{{ __('Vaccine Card') }}</label>
                                <div class="col-md-6">
                                    <input id="vaccineCard" type="file" class="form-control-file @error('vaccineCard') is-invalid @enderror" name="vaccineCard" required>
                                    @error('vaccineCard')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Registration Button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/guest/registration.js') }}"></script>

@endsection
