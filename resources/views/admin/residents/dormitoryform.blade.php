<x-app-layout :assets="$assets ?? []">
    <div>
        <?php
        $id = $id ?? null;
        ?>
        @if (isset($id))
            {!! Form::model($data, [
                'route' => ['dormitoryresidents.update', $id],
                'method' => 'patch',
                'enctype' => 'multipart/form-data',
            ]) !!}
        @else
            {!! Form::open([
                'route' => ['dormitoryresidents.store'],
                'method' => 'post',
                'enctype' => 'multipart/form-data',
            ]) !!}
        @endif
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $id !== null ? 'Update' : 'Add' }} User</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="profile-img-edit position-relative">
                                <img id="profile-image-preview"
                                    src="{{ $profileImage ?? asset('images/avatars/01.png') }}" alt="User-Profile"
                                    class="profile-pic rounded avatar-155">
                                {{-- <div class="upload-icone bg-primary">
                                    <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                                        <path fill="#ffffff"
                                            d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                    </svg>
                                </div> --}}
                                {{-- <input class="file-upload" type="file" accept="image/*" name="profile_image"> --}}

                            </div>
                            <div class="form-group">
                                {{ Form::file('profile_image', ['class' => 'form-control', 'placeholder' => 'profile_image', 'id' => 'profile-image-upload']) }}
                            </div>

                            <div class="img-extension mt-3">
                                <div class="d-inline-block align-items-center">
                                    <span>Only</span>
                                    <a href="javascript:void();">.jpg</a>
                                    <a href="javascript:void();">.png</a>
                                    <a href="javascript:void();">.jpeg</a>
                                    <span>allowed</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status:</label>
                            <div class="grid" style="--bs-gap: 1rem">
                                <div class="form-check g-col-6">
                                    {{ Form::radio('status', 'active', old('status') || true, ['class' => 'form-check-input', 'id' => 'status-active']) }}
                                    <label class="form-check-label" for="status-active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check g-col-6">
                                    {{ Form::radio('status', 'pending', old('status'), ['class' => 'form-check-input', 'id' => 'status-pending']) }}
                                    <label class="form-check-label" for="status-pending">
                                        Pending
                                    </label>
                                </div>
                                <div class="form-check g-col-6">
                                    {{ Form::radio('status', 'banned', old('status'), ['class' => 'form-check-input', 'id' => 'status-banned']) }}
                                    <label class="form-check-label" for="status-banned">
                                        Banned
                                    </label>
                                </div>
                                <div class="form-check g-col-6">
                                    {{ Form::radio('status', 'inactive', old('status'), ['class' => 'form-check-input', 'id' => 'status-inactive']) }}
                                    <label class="form-check-label" for="status-inactive">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="form-label">User Role: <span class="text-danger">*</span></label>
                            {{ Form::select('user_role', $roles, old('user_role') ? old('user_role') : $data->user_type ?? 'user', ['class' => 'form-control', 'placeholder' => 'Select User Role']) }}
                        </div> --}}
                        <div class="form-group">
                            <label class="form-label">Appliances:</label>
                            <div class="grid" style="--bs-gap: 1rem">
                                <div class="form-check g-col-6">
                                    {{ Form::checkbox('userProfile[laptop]', '1', old('userProfile.laptop', isset($data) ? $data->userProfile->laptop : null) == '1', ['class' => 'form-check-input', 'id' => 'status-laptop']) }}
                                    <label class="form-check-label" for="status-laptop">
                                        Laptop
                                    </label>
                                </div>
                                <div class="form-check g-col-6">
                                    {{ Form::checkbox('userProfile[electricfan]', '1', old('userProfile.electricfan', isset($data) ? $data->userProfile->electricfan : null) == '1', ['class' => 'form-check-input', 'id' => 'status-electricfan']) }}
                                    <label class="form-check-label" for="status-electricfan">
                                        Electric Fan
                                    </label>
                                </div>
                            </div>
                        </div>


                        <hr>
                        <h5 class="mb-3">Security</h5>
                        <div class="row">
                            <div class="form-group">
                                <label class="form-label" for="uname">User Name: <span
                                        class="text-danger">*</span></label>
                                {{ Form::text('username', old('username'), ['class' => 'form-control', 'required', 'placeholder' => 'Enter Username']) }}
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pass">Password:</label>
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="rpass">Repeat Password:</label>
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repeat Password']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $id !== null ? 'Update' : 'New' }} User Information</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('dormitoryresidents') }}" class="btn btn-sm btn-primary"
                                role="button">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="fname">First Name: <span
                                            class="text-danger">*</span></label>
                                    {{ Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'First Name', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="lname">Last Name: <span
                                            class="text-danger">*</span></label>
                                    {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Last Name', 'required']) }}
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label" for="email">Email: <span
                                            class="text-danger">*</span></label>
                                    {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Enter e-mail', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="mobno">Mobile Number:</label>
                                    {{ Form::number('userProfile[contactNumber]', old('userProfile[contactNumber]'), ['class' => 'form-control', 'id' => 'mobno', 'placeholder' => 'Mobile Number']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="add1">Course:</label>
                                    {{ Form::text('userProfile[course]', old('userProfile[course]'), ['class' => 'form-control', 'id' => 'add1', 'placeholder' => 'Course']) }}
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="add2">TUPT Number:</label>
                                    {{ Form::text('userProfile[Tuptnum]', old('userProfile[Tuptnum]'), ['class' => 'form-control', 'id' => 'add2', 'placeholder' => 'TUPT Number']) }}
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label" for="add3">Year Level:</label>
                                    {{ Form::text('userProfile[year]', old('userProfile[year]'), ['class' => 'form-control', 'id' => 'add3', 'placeholder' => 'Year Level']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="birthdate">Birthdate:</label>
                                    {{ Form::date('userProfile[birthdate]', old('userProfile[birthdate]'), ['class' => 'form-control', 'id' => 'birthdate', 'placeholder' => 'Birthdate']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="age">Age:</label>
                                    {{ Form::number('userProfile[age]', old('userProfile[age]'), ['class' => 'form-control', 'id' => 'age', 'placeholder' => 'Age']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="add3">Sex:</label>
                                    {{ Form::text('userProfile[sex]', old('userProfile[sex]'), ['class' => 'form-control', 'id' => 'sex', 'placeholder' => 'Sex']) }}
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="address">Address: <span
                                            class="text-danger">*</span></label>
                                    {{ Form::text('userProfile[address]', old('userProfile[address]'), ['class' => 'form-control', 'required', 'placeholder' => 'Address']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="religion">Religion:</label>
                                    {{ Form::text('userProfile[religion]', old('userProfile[religion]'), ['class' => 'form-control', 'id' => 'religion', 'placeholder' => 'Religion']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="civil_status">Civil Status:</label>
                                    {{ Form::text('userProfile[civil_status]', old('userProfile[civil_status]'), ['class' => 'form-control', 'id' => 'civil_status', 'placeholder' => 'Civil Status']) }}
                                </div>

                                <hr>
                                <h5 class="mb-3">File Uploads</h5>
                                <div class="row">
                                    @php
                                        // Check if userProfile exists for later use
                                        $userProfile = $data->userProfile ?? null;
                                    @endphp

                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="applicationForm">Application Form:</label>
                                        {{ Form::file('userProfile[applicationForm]', ['class' => 'form-control', 'placeholder' => 'Application Form']) }}
                                        @if ($userProfile && $userProfile->applicationForm)
                                            <a href="{{ route('userProfile.applicationForm.show', $userProfile->id) }}"
                                                class="btn btn-primary mt-2" target="_blank">
                                                View Application Form
                                            </a>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="contract">Contract:</label>
                                        {{ Form::file('userProfile[contract]', ['class' => 'form-control', 'placeholder' => 'Contract']) }}
                                        @if ($userProfile && $userProfile->contract)
                                            <a href="{{ route('userProfile.contract.show', $userProfile->id) }}"
                                                class="btn btn-primary mt-2" target="_blank">
                                                View Contract
                                            </a>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="cor">Certificate of Registration:</label>
                                        {{ Form::file('userProfile[cor]', ['class' => 'form-control', 'placeholder' => 'Certificate of Registration']) }}
                                        @if ($userProfile && $userProfile->cor)
                                            <a href="{{ route('userProfile.cor.show', $userProfile->id) }}"
                                                class="btn btn-primary mt-2" target="_blank">
                                                View Certificate of Registration
                                            </a>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="validID">Valid ID:</label>
                                        {{ Form::file('userProfile[validID]', ['class' => 'form-control', 'placeholder' => 'Valid ID']) }}
                                        @if ($userProfile && $userProfile->validID)
                                            <a href="{{ route('userProfile.validID.show', $userProfile->id) }}"
                                                class="btn btn-primary mt-2" target="_blank">
                                                View Valid ID
                                            </a>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vaccineCard">Vaccine Card:</label>
                                        {{ Form::file('userProfile[vaccineCard]', ['class' => 'form-control', 'placeholder' => 'Vaccine Card']) }}
                                        @if ($userProfile && $userProfile->vaccineCard)
                                            <a href="{{ route('userProfile.vaccineCard.show', $userProfile->id) }}"
                                                class="btn btn-primary mt-2" target="_blank">
                                                View Vaccine Card
                                            </a>
                                        @endif
                                    </div>
                                </div>


                                <hr>
                                <h5 class="mb-3">Guardian Information</h5>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="form-label" for="guardianname">Name:</label>
                                        {{ Form::text('userProfile[guardianName]', old('userProfile[guardianName]'), ['class' => 'form-control', 'id' => 'guardianname', 'placeholder' => 'Name']) }}

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="guardianaddress">Address:</label>
                                        {{ Form::text('userProfile[guardianAddress]', old('userProfile[guardianAddress]'), ['class' => 'form-control', 'id' => 'guardianaddress', 'placeholder' => 'Address']) }}

                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label class="form-label" for="guardianContactNumber">Contact Number:</label>
                                        {{ Form::text('userProfile[guardianContactNumber]', old('userProfile[guardianContactNumber]'), ['class' => 'form-control', 'id' => 'guardianContactNumber', 'placeholder' => 'Contact Number']) }}

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="guardianRelationship">Relationship:</label>
                                        {{ Form::text('userProfile[guardianRelationship]', old('userProfile[guardianRelationship]'), ['class' => 'form-control', 'id' => 'guardianRelationship', 'placeholder' => 'Relationship']) }}

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ $id !== null ? 'Update' : 'Add' }}
                                    User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('profile-image-upload');
                const imagePreview = document.getElementById('profile-image-preview');

                fileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>

</x-app-layout>
