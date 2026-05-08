@extends('layouts.base')

@section('title', 'Add New User')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-person-plus"></i> Add New User</h1>
    <p>Create a new system user account</p>


<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card"><div class="card-body p-4">
            <form action="{{ route('users.store') }}" method="POST" id="userForm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="e.g., John Doe"
                           required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}
                    @enderror
                

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address *</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="user@example.com"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}
                    @enderror
                

                <div class="mb-3">
                    <label for="role" class="form-label">Role *</label>
                    <select class="form-select @error('role') is-invalid @enderror"
                            id="role" name="role" required>
                        <option value="">-- Select Role --</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                            Admin – Full access (products, suppliers, users, reports)
                        </option>
                        <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>
                            Staff – Stock transactions and reports only
                        </option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}
                    @enderror
                

                <hr class="my-4">
                <h6 class="mb-3"><i class="bi bi-lock"></i> Set Password</h6>

                <div class="mb-3">
                    <label for="password" class="form-label">Password *</label>
                    <div class="input-group">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               placeholder="Minimum 8 characters"
                               required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}
                    @enderror
                

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirm Password *</label>
                    <input type="password"
                           class="form-control"
                           id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Repeat password"
                           required>
                    <div id="passwordMatch" class="form-text">
                

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-check"></i> Create User
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                
            </form>
        
    


@section('scripts')
<script>
$(document).ready(function () {
    // Toggle password visibility
    $('#togglePassword').on('click', function () {
        var input = $('#password');
        var icon  = $('#eyeIcon');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });

    // Live password match indicator
    $('#password_confirmation').on('keyup', function () {
        var pw    = $('#password').val();
        var conf  = $(this).val();
        var msg   = $('#passwordMatch');
        if (conf.length === 0) { msg.text('').removeClass('text-success text-danger'); return; }
        if (pw === conf) {
            msg.text('✓ Passwords match').removeClass('text-danger').addClass('text-success');
        } else {
            msg.text('✗ Passwords do not match').removeClass('text-success').addClass('text-danger');
        }
    });
});
</script>
@endsection
@endsection
