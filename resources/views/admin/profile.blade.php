@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Profile</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            
            <form id="profileForm" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        @if($user->profile_photo)
                            <img src="{{ str_starts_with($user->profile_photo, 'profile_photos/') ? asset('storage/' . $user->profile_photo) : asset($user->profile_photo) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" style="object-fit: cover;"/>
                        @else
                            <div class="d-block rounded d-flex align-items-center justify-content-center text-white fw-bold" style="height: 100px; width: 100px; background-color: #696cff; font-size: 2.5rem;" id="uploadedAvatarPlaceholder">
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
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" id="resetAvatarBtn">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2MB</p>
                        </div>
                    </div>
                </div>
                
                <hr class="my-0" />
                
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6 form-group">
                            <label for="name" class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required />
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required />
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="mobile_no" class="form-label fw-bold">Mobile Number</label>
                            <input class="form-control" type="text" id="mobile_no" name="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10" />
                        </div>
                        <div class="col-12 mt-4">
                            <h6 class="fw-bold mb-3 border-bottom pb-2">Change Password</h6>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="password" class="form-label fw-bold">New Password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Leave blank to keep current" />
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </div>
                <!-- /Account -->
            </form>
        </div>

        <!-- No Delete Account Section for Admin -->
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
        const resetBtn = document.getElementById('resetAvatarBtn');
        let originalImageSrc = uploadedAvatar ? uploadedAvatar.src : '';

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

        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                uploadInput.value = '';
                if(originalImageSrc && originalImageSrc !== window.location.href) {
                    uploadedAvatar.src = originalImageSrc;
                    uploadedAvatar.classList.remove('d-none');
                    uploadedAvatar.classList.add('d-block');
                    if(uploadedAvatarPlaceholder) {
                        uploadedAvatarPlaceholder.classList.remove('d-block');
                        uploadedAvatarPlaceholder.classList.add('d-none');
                    }
                } else {
                    uploadedAvatar.src = '';
                    uploadedAvatar.classList.remove('d-block');
                    uploadedAvatar.classList.add('d-none');
                    if(uploadedAvatarPlaceholder) {
                        uploadedAvatarPlaceholder.classList.remove('d-none');
                        uploadedAvatarPlaceholder.classList.add('d-block', 'd-flex');
                    }
                }
            });
        }
    });

    $(document).ready(function() {
        $('#profileForm').validate({
            rules: {
                name: { required: true, minlength: 3 },
                email: { required: true, email: true },
                mobile_no: { digits: true, minlength: 10, maxlength: 10 },
                password: { minlength: 6 },
                password_confirmation: { equalTo: "#password" }
            },
            messages: {
                name: { required: "Please enter your full name", minlength: "Name must be at least 3 characters" },
                email: { required: "Please enter a valid email address", email: "Please enter a valid email address" },
                mobile_no: { digits: "Please enter only digits", minlength: "Mobile number must be exactly 10 digits", maxlength: "Mobile number must be exactly 10 digits" },
                password: { minlength: "Password must be at least 6 characters" },
                password_confirmation: { equalTo: "Passwords do not match" }
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


</script>
@endpush
