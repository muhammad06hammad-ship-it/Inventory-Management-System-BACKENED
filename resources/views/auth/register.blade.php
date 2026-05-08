@extends('layouts.base')

@section('title', 'Create Account')

@section('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 15px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .auth-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        overflow: hidden;
        width: 100%;
        max-width: 520px;
    }

    .auth-header {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        padding: 35px 40px 30px;
        text-align: center;
        color: white;
    }

    .auth-header .logo-icon {
        width: 64px;
        height: 64px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 28px;
    }

    .auth-header h2 {
        font-size: 1.6rem;
        font-weight: 600;
        margin: 0 0 6px;
    }

    .auth-header p {
        font-size: 0.9rem;
        opacity: 0.85;
        margin: 0;
    }

    .auth-body {
        padding: 35px 40px;
    }

    .auth-body .form-label {
        font-weight: 500;
        font-size: 0.875rem;
        color: #2c3e50;
        margin-bottom: 6px;
    }

    .auth-body .form-control {
        border-radius: 8px;
        border: 1.5px solid #e0e6ed;
        padding: 11px 14px;
        font-size: 0.925rem;
        transition: all 0.2s ease;
    }

    .auth-body .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15);
    }

    .input-icon-group {
        position: relative;
    }

    .input-icon-group .form-control {
        padding-left: 42px;
    }

    .input-icon-group .field-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #95a5a6;
        font-size: 16px;
        z-index: 5;
    }

    .input-icon-group .toggle-eye {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #95a5a6;
        cursor: pointer;
        padding: 0;
        font-size: 15px;
        z-index: 5;
    }

    .btn-register {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 1rem;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #2980b9 0%, #2471a3 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(52,152,219,0.4);
        color: white;
    }

    .btn-register:active { transform: translateY(0); }

    .strength-bar {
        height: 4px;
        border-radius: 2px;
        background: #ecf0f1;
        margin-top: 6px;
        overflow: hidden;
    }

    .strength-fill {
        height: 100%;
        border-radius: 2px;
        transition: all 0.3s ease;
        width: 0;
    }

    .strength-text {
        font-size: 11px;
        margin-top: 3px;
    }

    .divider-text {
        text-align: center;
        position: relative;
        margin: 20px 0;
    }

    .divider-text::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #ecf0f1;
    }

    .divider-text span {
        background: white;
        padding: 0 12px;
        color: #95a5a6;
        font-size: 13px;
        position: relative;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eaf4ff;
        color: #1a6fa8;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        border: 1px solid #cce4f7;
    }

    .auth-footer-link {
        text-align: center;
        padding: 18px 40px;
        border-top: 1px solid #f0f2f5;
        font-size: 0.9rem;
        color: #7f8c8d;
    }

    .auth-footer-link a {
        color: #3498db;
        font-weight: 500;
        text-decoration: none;
    }

    .auth-footer-link a:hover { text-decoration: underline; }

    @media(max-width: 576px) {
        .auth-header { padding: 25px 24px 20px; }
        .auth-body { padding: 25px 24px; }
        .auth-footer-link { padding: 15px 24px; }
    }
</style>
@endsection

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        {{-- Header --}}
        <div class="auth-header">
            <div class="logo-icon">
                <i class="bi bi-box2-heart"></i>
            </div>
            <h2>Create Account</h2>
            <p>Join the Inventory Management System</p>
        </div>

        {{-- Body --}}
        <div class="auth-body">

            @if($errors->any())
            <div class="alert alert-danger py-2 mb-3" style="border-radius:8px;font-size:0.875rem;">
                <i class="bi bi-exclamation-circle me-1"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-1 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Role info --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <small class="text-muted">New accounts are created as:</small>
                <span class="role-badge">
                    <i class="bi bi-person-check" style="font-size:13px;"></i> Staff Role
                </span>
            </div>

            <form action="{{ route('register') }}" method="POST" id="registerForm" novalidate>
                @csrf

                {{-- Full Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-icon-group">
                        <i class="bi bi-person field-icon"></i>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g., Ali Hassan"
                               autocomplete="name"
                               required autofocus>
                    </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-icon-group">
                        <i class="bi bi-envelope field-icon"></i>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="ali@example.com"
                               autocomplete="email"
                               required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-icon-group">
                        <i class="bi bi-lock field-icon"></i>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               placeholder="Minimum 8 characters"
                               autocomplete="new-password"
                               required>
                        <button type="button" class="toggle-eye" id="togglePw">
                            <i class="bi bi-eye" id="eyePw"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    {{-- Password strength bar --}}
                    <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                    <div class="strength-text text-muted" id="strengthText"></div>
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-icon-group">
                        <i class="bi bi-lock-fill field-icon"></i>
                        <input type="password"
                               class="form-control"
                               id="password_confirmation"
                               name="password_confirmation"
                               placeholder="Repeat your password"
                               autocomplete="new-password"
                               required>
                        <button type="button" class="toggle-eye" id="toggleCf">
                            <i class="bi bi-eye" id="eyeCf"></i>
                        </button>
                    </div>
                    <div id="matchMsg" class="form-text mt-1"></div>
                </div>

                {{-- Terms --}}
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input @error('terms') is-invalid @enderror"
                               type="checkbox" id="terms" name="terms" value="1"
                               {{ old('terms') ? 'checked' : '' }}>
                        <label class="form-check-label" for="terms" style="font-size:0.875rem;">
                            I agree to the
                            <a href="#" style="color:#3498db;">Terms & Conditions</a>
                            and
                            <a href="#" style="color:#3498db;">Privacy Policy</a>
                        </label>
                        @error('terms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-register" id="submitBtn">
                    <i class="bi bi-person-plus me-2"></i> Create My Account
                </button>
            </form>

            <div class="divider-text"><span>Already have an account?</span></div>

            <a href="{{ route('login') }}"
               class="btn btn-outline-secondary w-100"
               style="border-radius:8px;padding:11px;font-weight:500;">
                <i class="bi bi-box-arrow-in-right me-2"></i> Sign In Instead
            </a>

        </div>

        {{-- Footer --}}
        <div class="auth-footer-link">
            <i class="bi bi-shield-check text-success me-1"></i>
            Your data is secure and encrypted.
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    // Toggle password visibility
    function toggleVis(btnId, iconId, inputId) {
        $('#' + btnId).on('click', function () {
            var inp  = $('#' + inputId);
            var icon = $('#' + iconId);
            if (inp.attr('type') === 'password') {
                inp.attr('type', 'text');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                inp.attr('type', 'password');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
    }
    toggleVis('togglePw', 'eyePw', 'password');
    toggleVis('toggleCf', 'eyeCf', 'password_confirmation');

    // Password strength meter
    $('#password').on('input', function () {
        var pw      = $(this).val();
        var score   = 0;
        var label   = '';
        var color   = '';
        var width   = '0%';

        if (pw.length >= 8)         score++;
        if (/[A-Z]/.test(pw))       score++;
        if (/[0-9]/.test(pw))       score++;
        if (/[^A-Za-z0-9]/.test(pw)) score++;

        if (pw.length === 0) {
            label = ''; color = ''; width = '0%';
        } else if (score <= 1) {
            label = 'Weak'; color = '#e74c3c'; width = '25%';
        } else if (score === 2) {
            label = 'Fair'; color = '#f39c12'; width = '50%';
        } else if (score === 3) {
            label = 'Good'; color = '#3498db'; width = '75%';
        } else {
            label = 'Strong'; color = '#27ae60'; width = '100%';
        }

        $('#strengthFill').css({ width: width, background: color });
        $('#strengthText').text(label ? 'Strength: ' + label : '').css('color', color);

        checkMatch();
    });

    // Password match checker
    $('#password_confirmation').on('input', checkMatch);

    function checkMatch() {
        var pw   = $('#password').val();
        var cf   = $('#password_confirmation').val();
        var msg  = $('#matchMsg');
        if (!cf.length) { msg.text(''); return; }
        if (pw === cf) {
            msg.html('<span style="color:#27ae60;">&#10003; Passwords match</span>');
        } else {
            msg.html('<span style="color:#e74c3c;">&#10007; Passwords do not match</span>');
        }
    }

    // Prevent submit if passwords don't match
    $('#registerForm').on('submit', function (e) {
        var pw = $('#password').val();
        var cf = $('#password_confirmation').val();
        if (pw !== cf) {
            e.preventDefault();
            $('#matchMsg').html('<span style="color:#e74c3c;">&#10007; Passwords do not match. Please fix before submitting.</span>');
            $('#password_confirmation').focus();
        }
    });
});
</script>
@endpush
