@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Profile</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            
            <form id="profileForm" action="{{ route('employee.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        @if($user->profile_photo)
                            <img src="{{ str_starts_with($user->profile_photo, 'profile_photos/') ? asset('storage/' . $user->profile_photo) : asset($user->profile_photo) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" style="object-fit: cover;"/>
                        @else
                            <div class="d-block rounded d-flex align-items-center justify-content-center text-white fw-bold" style="height: 100px; width: 100px; background-color: #71dd37; font-size: 2.5rem;" id="uploadedAvatarPlaceholder">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <img src="" alt="user-avatar" class="d-none rounded" height="100" width="100" id="uploadedAvatar" style="object-fit: cover;"/>
                        @endif
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" name="profile_photo" class="account-file-input" hidden accept="image/png, image/jpeg, image/gif" />
                            </label>
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2MB</p>
                        </div>
                    </div>
                </div>
                
                <hr class="my-0" />
                
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6 form-group">
                            <label for="employee_id" class="form-label fw-bold">Employee ID <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="employee_id" name="employee_id" value="{{ old('employee_id', $user->employee_id) }}" required />
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="name" class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required />
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required />
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="mobile_no" class="form-label fw-bold">Mobile Number <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10" />
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="policestation" class="form-label fw-bold">Police Station <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="policestation" name="policestation" value="{{ old('policestation', $user->policestation) }}" required />
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="dob" class="form-label fw-bold">Date of Birth</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control flatpickr-date-input bg-white" type="text" id="dob" name="dob" value="{{ old('dob', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '') }}" placeholder="YYYY-MM-DD" />
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label class="form-label fw-bold">Join Date</label>
                            <input class="form-control text-muted" type="text" value="{{ $user->created_at ? $user->created_at->format('d M, Y') : 'N/A' }}" readonly />
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </div>
                <!-- /Account -->
            </form>
        </div>

        <div class="card">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                        <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                    </div>
                </div>
                <form id="deleteAccountForm" action="{{ route('employee.account.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                        <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                    </div>
                    <button type="button" onclick="confirmDelete()" class="btn btn-danger deactivate-account">Deactivate Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Image preview logic
        const uploadInput = document.getElementById('upload');
        const uploadedAvatar = document.getElementById('uploadedAvatar');
        const uploadedAvatarPlaceholder = document.getElementById('uploadedAvatarPlaceholder');

        if (uploadInput) {
            uploadInput.addEventListener('change', function (e) {
                if (e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        uploadedAvatar.src = e.target.result;
                        uploadedAvatar.classList.remove('d-none');
                        uploadedAvatar.classList.add('d-block');
                        if(uploadedAvatarPlaceholder) {
                            uploadedAvatarPlaceholder.classList.remove('d-block');
                            uploadedAvatarPlaceholder.classList.add('d-none');
                        }
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }

        // Initialize Flatpickr for Date of Birth
        flatpickr('.flatpickr-date-input', {
            dateFormat: "Y-m-d",
            allowInput: true
        });
    });

    $(document).ready(function() {
        $('#profileForm').validate({
            rules: {
                employee_id: { required: true, minlength: 3 },
                name: { required: true, minlength: 3 },
                email: { required: true, email: true },
                mobile_no: { required: true, digits: true, minlength: 10, maxlength: 10 },
                policestation: { required: true }
            },
            messages: {
                employee_id: { required: "Please enter your Employee ID", minlength: "Employee ID must be at least 3 characters" },
                name: { required: "Please enter your full name", minlength: "Name must be at least 3 characters" },
                email: { required: "Please enter a valid email address", email: "Please enter a valid email address" },
                mobile_no: { required: "Please enter your mobile number", digits: "Please enter only digits", minlength: "Mobile number must be exactly 10 digits", maxlength: "Mobile number must be exactly 10 digits" },
                policestation: { required: "Please enter your police station" }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

    function confirmDelete() {
        const checkbox = document.getElementById('accountActivation');
        if (!checkbox.checked) {
            Swal.fire({
                icon: 'error',
                title: 'Confirmation required',
                text: 'Please check the confirmation box to deactivate your account.',
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this! Your account will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAccountForm').submit();
            }
        });
    }
</script>
@endpush
