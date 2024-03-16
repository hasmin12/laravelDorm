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

                             <!-- Account Information -->
                             <h4>Account Information</h4>
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

                                 <!-- Type -->
                                 <div class="form-group row mb-2">
                                    <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                                    <div class="col-md-6">
                                        <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            <!-- img path -->
                            <div class="form-group row mb-2">
                                <label for="img_path" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                                <div class="col-md-6">
                                    <input id="img_path" type="file" class="form-control-file @error('img_path') is-invalid @enderror" name="img_path" required>
                                    @error('img_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Account Information -->
                            <h4>Personal Information</h4>
                        
                            <!-- Tuptnum -->
                            <div class="form-group row mb-2">
                                <label for="Tuptnum" class="col-md-4 col-form-label text-md-right">{{ __('TUPT Number') }}</label>
                                <div class="col-md-6">
                                    <input id="Tuptnum" type="text" class="form-control @error('Tuptnum') is-invalid @enderror" name="Tuptnum" value="{{ old('Tuptnum') }}" required>
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

                            <div class="form-group row mb-2">
                                <label for="course" class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>
                                <div class="col-md-6">
                                    <select id="course" class="form-control @error('course') is-invalid @enderror" name="course" required>
                                        {{-- <option value="" selected hidden></option> --}}
                                        <option value="BET Major in Automotive Technology">BETAT-T</option>
                                        <option value="BET Major in Chemical Technology">BETChT-T</option>
                                        <option value="BET Major in Construction Technology">BETCT-T</option>
                                        <option value="BET Major in Electrical Technology">BETET-T</option>
                                        <option value="BET Major in Electromechanical Technology">BETEMT-T</option>
                                        <option value="BET Major in Electronics Technology">BETElxT-T</option>
                                        <option value="BET Major in Instrumentation and Control Technology">BETInCT-T</option>
                                        <option value="BET Major in Mechanical Technology">BETMT-T</option>
                                        <option value="BET Major in Mechatronics Technology">BETMecT-T</option>
                                        <option value="BET Major in Non-Destructive Testing Technology">BETNDTT-T</option>
                                        <option value="BET Major in Dies & Moulds Technology">BETDMT-T</option>
                                        <option value="BET Major in Heating, Ventilation and Airconditioning/Refrigeration Technology">BETHVAC/RT-T</option>
                                        <option value="Bachelor of Science in Civil Engineering">BSCESEP-T</option>
                                        <option value="Bachelor of Science in Electrical Engineering">BSEESEP-T</option>
                                        <option value="Bachelor of Science in Electronics Engineering">BSECESEP-T</option>
                                        <option value="Bachelor of Science in Mechanical Engineering">BSMESEP-T</option>   
                                        <option value="Bachelor of Science in Information Technology">BSIT-T</option> 
                                        <option value="Bachelor of Science in Information System">BSIS-T</option> 
                                        <option value="Bachelor of Science in Environmental Science">BSESSDP-T</option> 
                                        <option value="Bachelor in Graphics Technology Major in Architecture Technology">BGTAT-T</option> 
                                        <option value="BTVTE Major in Electrical Technology">BTVTEdET-T</option> 
                                        <option value="BTVTE Major in Electronics Technology">BTVTEdElxT-T</option> 
                                        <option value="BTVTE Major in Information and Communication Technology">BTVTEdICT-T</option> 
                                    
                                    </select>
                                    @error('course')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Year -->
                            <div class="form-group row mb-2">
                                <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>
                                <div class="col-md-6">
                                    <input id="year" type="text" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}" required autocomplete="year" autofocus>
                                    @error('year')
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

                              <!-- age -->
                              <div class="form-group row mb-2">
                                <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>
                                <div class="col-md-6">
                                    <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>
                                    @error('age')
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


                             <!-- Religion -->
                             <div class="form-group row mb-2">
                                <label for="religion" class="col-md-4 col-form-label text-md-right">{{ __('Religion') }}</label>
                                <div class="col-md-6">
                                    <input id="religion" type="text" class="form-control @error('religion') is-invalid @enderror" name="religion" value="{{ old('religion') }}" required autocomplete="religion" autofocus>
                                    @error('religion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 

                               <!-- Civil Status -->
                               <div class="form-group row mb-2">
                                <label for="civil_status" class="col-md-4 col-form-label text-md-right">{{ __('Civil Status') }}</label>
                                <div class="col-md-6">
                                    <input id="civil_status" type="text" class="form-control @error('civil_status') is-invalid @enderror" name="civil_status" value="{{ old('civil_status') }}" required autocomplete="civil_status" autofocus>
                                    @error('civil_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 

                             <!-- Address -->
                             <div class="form-group row mb-2">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Permanent Address') }}</label>
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contacts -->
                            <div class="form-group row mb-2">
                                <label for="contactNumber" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>
                                <div class="col-md-6">
                                    <input id="contactNumber" type="text" class="form-control @error('contactNumber') is-invalid @enderror" name="contactNumber" value="{{ old('contactNumber') }}" required>
                                    @error('contactNumber')
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

                            <!-- Vaccine Card -->
                            <div class="form-group row mb-2">
                                <label for="laptop" class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input id="laptop" type="checkbox" class="form-check-input @error('laptop') is-invalid @enderror" name="laptop" {{ old('laptop') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="laptop">
                                            {{ __('Has Laptop') }}
                                        </label>
                                    </div>
                                    @error('laptop')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                             <!-- Vaccine Card -->
                             <div class="form-group row mb-2">
                                <label for="electricfan" class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input id="electricfan" type="checkbox" class="form-check-input @error('electricfan') is-invalid @enderror" name="electricfan"  {{ old('electricfan') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="electricfan">
                                            {{ __('Has Electric Fan') }}
                                        </label>
                                    </div>
                                    @error('electricfan')
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
