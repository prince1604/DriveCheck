@extends('layouts.auth')

@section('title', 'Register')
@section('auth_width', '800px')

@section('content')
<p class="mb-4 text-muted text-center">Register securely for the official DriveCheck system.</p>

<form id="formAuthentication" action="{{ route('register') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3 form-group">
            <label for="employee_id" class="form-label">Employee ID <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Enter Employee ID" required value="{{ old('employee_id') }}">
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group">
            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required value="{{ old('name') }}">
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required value="{{ old('email') }}" oninput="this.value = this.value.toLowerCase()">
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group">
            <label for="mobile_no" class="form-label">Mobile No <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No" required value="{{ old('mobile_no') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
            </div>
        </div>

        <div class="col-md-12 mb-3 form-group">
            <label for="policestation" class="form-label">Police Station <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-building-house"></i></span>
                <input type="text" class="form-control" id="policestation" name="policestation" placeholder="Enter Police Station" required value="{{ old('policestation') }}">
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group form-password-toggle">
            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>

        <div class="col-md-6 mb-3 form-group form-password-toggle">
            <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
    </div>

    <button class="btn btn-primary d-grid w-100 mt-4" type="submit">Sign up</button>
</form>

<p class="text-center mt-3">
    <span>Already have an account?</span>
    <a href="{{ route('login') }}">
        <span>Sign in instead</span>
    </a>
</p>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#formAuthentication').validate({
            rules: {
                employee_id: {
                    required: true,
                    minlength: 3
                },
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                mobile_no: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                policestation: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                employee_id: {
                    required: "Please enter your Employee ID",
                    minlength: "Employee ID must be at least 3 characters"
                },
                name: {
                    required: "Please enter your full name",
                    minlength: "Name must be at least 3 characters"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                mobile_no: {
                    required: "Please enter your mobile number",
                    digits: "Please enter only digits",
                    minlength: "Mobile number must be exactly 10 digits",
                    maxlength: "Mobile number must be exactly 10 digits"
                },
                policestation: {
                    required: "Please enter the police station"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                }
            },
            errorElement: 'span',
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