@extends('layouts.base')

@section('title', 'Edit User')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-person-gear"></i> Edit User</h1>
    <p>Update account details for <strong>{{ $user->name }}</strong></p>


<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card"><div class="card-body p-4">
            <form action="{{ route('users.update', $user) }}" method="POST" id="userForm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name"
                           value="{{ old('name', $user->name) }}"
                           required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}
                    @enderror
                

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address *</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email', $user->email) }}"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}
                    @enderror
                

                <div class="mb-3">
                    <label for="role" class="form-label">Role *</label>
                    <select class="form-select @error('role') is-invalid @enderror"
                            id="role" name="role"
                            {{ $user->id === auth()->id() ? 'disabled' : '' }} required>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                            Admin – Full access
                        </option>
                        <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>
                            Staff – Stock transactions and reports only
                        </option>
                    </select>
                    @if($user->id === auth()->id())
                        {{-- Keep original role if disabled --}}
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        <small class="text-muted"><i class="bi bi-info-circle"></i> You cannot change your own role.</small>
                    @endif
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}
                    @enderror
                

                <hr class="my-4">
                <h6 class="mb-1"><i class="bi bi-lock"></i> Change Password</h6>
                <small class="text-muted d-block mb-3">Leave blank to keep the existing password.</small>

                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               placeholder="Minimum 8 characters (optional)">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}
                    @enderror
                

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password"
                           class="form-control"
                           id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Repeat new password">
                    <div id="passwordMatch" class="form-text">
                

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Changes
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                
            </form>
        
    


@section('scripts')
<script>
$(document).ready(function () {
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

    $('#password_confirmation').on('keyup', function () {
        var pw   = $('#password').val();
        var conf = $(this).val();
        var msg  = $('#passwordMatch');
        if (!conf.length) { msg.text('').removeClass('text-success text-danger'); return; }
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
