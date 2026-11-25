@extends('layouts.admin')

@section('title', 'Account Settings')
@section('page-heading', 'Account Settings')

@section('content')

<div class="account-settings">

    <div class="settings-intro">
        <div>
            <h2>Manage my Account</h2>
            <p>Update my administrator information and protect your account.</p>
        </div>

        <div class="account-badge">
            <i class="fas fa-shield-alt"></i>
            Administrator Account
        </div>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="settings-alert success-alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ACCOUNT INFORMATION --}}
    <div class="settings-card">

        <div class="settings-card-header">
            <div class="settings-icon purple-icon">
                <i class="fas fa-user-circle"></i>
            </div>

            <div>
                <h3>Account Information</h3>
                <p>Update your administrator name and email address.</p>
            </div>
        </div>

        <form action="{{ route('admin.account-settings.update-account') }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="settings-form-grid">

                <div class="settings-field">
                    <label for="name">Full Name</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Enter your full name"
                        required
                    >

                    @error('name')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="settings-field">
                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        placeholder="Enter your email address"
                        required
                    >

                    @error('email')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="settings-field full-width">
                    <label for="account_current_password">
                        Current Password
                    </label>

                    <input
                        type="password"
                        id="account_current_password"
                        name="current_password"
                        placeholder="Enter your current password"
                        required
                    >

                    @error('current_password')
                        <small class="field-error">{{ $message }}</small>
                    @enderror

                    <small class="field-hint">
                        Confirm your identity before updating account information.
                    </small>
                </div>

            </div>

            <div class="settings-form-footer">
                <button type="submit" class="settings-button primary-button">
                    <i class="fas fa-save"></i>
                    Save Account Information
                </button>
            </div>

        </form>
    </div>


    {{-- PASSWORD AND SECURITY --}}
    <div class="settings-card">

        <div class="settings-card-header">
            <div class="settings-icon blue-icon">
                <i class="fas fa-lock"></i>
            </div>

            <div>
                <h3>Password & Security</h3>
                <p>Change your password to keep your account secure.</p>
            </div>
        </div>

        <div class="security-notice">
            <i class="fas fa-info-circle"></i>

            <div>
                <strong>Password requirements</strong>
                <p>
                    Use at least 8 characters. Your new password must be
                    different from your current password.
                </p>
            </div>
        </div>

        <form action="{{ route('admin.account-settings.update-password') }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="settings-form-grid">

                <div class="settings-field full-width">
                    <label for="password_current_password">
                        Current Password
                    </label>

                    <input
                        type="password"
                        id="password_current_password"
                        name="current_password"
                        placeholder="Enter your current password"
                        required
                        autocomplete="current-password"
                    >

                    @error('current_password')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="settings-field">
                    <label for="password">New Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your new password"
                        minlength="8"
                        required
                        autocomplete="new-password"
                    >

                    @error('password')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="settings-field">
                    <label for="password_confirmation">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm your new password"
                        minlength="8"
                        required
                        autocomplete="new-password"
                    >
                </div>

            </div>

            <div class="settings-form-footer">
                <button type="submit" class="settings-button primary-button">
                    <i class="fas fa-key"></i>
                    Change Password
                </button>
            </div>

        </form>
    </div>


    {{-- ACCOUNT DETAILS --}}
    <div class="settings-card account-details-card">

        <div class="settings-card-header">
            <div class="settings-icon green-icon">
                <i class="fas fa-id-card"></i>
            </div>

            <div>
                <h3>Account Details</h3>
                <p>Information about your administrator account.</p>
            </div>
        </div>

        <div class="account-details-grid">

            <div class="detail-item">
                <span>Account ID</span>
                <strong>#{{ $user->id }}</strong>
            </div>

            <div class="detail-item">
                <span>Account Role</span>
                <strong class="role-label">
                    {{ ucfirst($user->role) }}
                </strong>
            </div>

            <div class="detail-item">
                <span>Account Created</span>
                <strong>{{ $user->created_at->format('d M Y') }}</strong>
            </div>

            <div class="detail-item">
                <span>Last Updated</span>
                <strong>{{ $user->updated_at->format('d M Y') }}</strong>
            </div>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>

.account-settings {
    max-width: 1100px;
    margin: 0 auto;
    color: #e5e7eb;
}

.settings-intro {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 28px;
    flex-wrap: wrap;
}

.settings-intro h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 7px;
    color: #ffffff;
}

.settings-intro p {
    color: #9ca3af;
    font-size: 14px;
}

.account-badge {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 10px 15px;
    border-radius: 30px;
    background: rgba(139, 92, 246, 0.12);
    border: 1px solid rgba(139, 92, 246, 0.3);
    color: #c4b5fd;
    font-size: 12px;
    font-weight: 600;
}

.settings-card {
    background: #111827;
    border: 1px solid rgba(148, 163, 184, 0.12);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.settings-card-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(148, 163, 184, 0.12);
}

.settings-card-header h3 {
    color: #ffffff;
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 5px;
}

.settings-card-header p {
    color: #9ca3af;
    font-size: 13px;
}

.settings-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 18px;
    flex-shrink: 0;
}

.purple-icon {
    background: rgba(139, 92, 246, 0.15);
    color: #a78bfa;
}

.blue-icon {
    background: rgba(59, 130, 246, 0.15);
    color: #60a5fa;
}

.green-icon {
    background: rgba(16, 185, 129, 0.15);
    color: #34d399;
}

.settings-form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
}

.settings-field {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.settings-field.full-width {
    grid-column: 1 / -1;
}

.settings-field label {
    color: #d1d5db;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 9px;
}

.settings-field input {
    width: 100%;
    padding: 13px 15px;
    background: #0b1220;
    border: 1px solid #293449;
    border-radius: 9px;
    color: #ffffff;
    font-size: 13px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.settings-field input::placeholder {
    color: #64748b;
}

.settings-field input:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.12);
}

.field-error {
    color: #f87171;
    margin-top: 7px;
    font-size: 12px;
}

.field-hint {
    color: #64748b;
    font-size: 11px;
    margin-top: 7px;
}

.settings-form-footer {
    display: flex;
    justify-content: flex-end;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid rgba(148, 163, 184, 0.12);
}

.settings-button {
    border: none;
    border-radius: 9px;
    padding: 12px 19px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease;
}

.primary-button {
    background: linear-gradient(135deg, #7c3aed, #4f46e5);
    color: white;
}

.primary-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 18px rgba(124, 58, 237, 0.25);
}

.security-notice {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    padding: 15px;
    margin-bottom: 25px;
    background: rgba(59, 130, 246, 0.08);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 10px;
    color: #60a5fa;
}

.security-notice i {
    margin-top: 3px;
}

.security-notice strong {
    font-size: 13px;
}

.security-notice p {
    color: #9ca3af;
    font-size: 12px;
    margin-top: 5px;
    line-height: 1.6;
}

.settings-alert {
    padding: 14px 17px;
    border-radius: 9px;
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
}

.success-alert {
    background: rgba(16, 185, 129, 0.1);
    color: #34d399;
    border: 1px solid rgba(16, 185, 129, 0.25);
}

.account-details-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.detail-item {
    padding: 15px;
    background: #0b1220;
    border: 1px solid rgba(148, 163, 184, 0.1);
    border-radius: 9px;
}

.detail-item span {
    display: block;
    color: #9ca3af;
    font-size: 12px;
    margin-bottom: 8px;
}

.detail-item strong {
    color: #ffffff;
    font-size: 14px;
}

.role-label {
    color: #a78bfa !important;
}

@media (max-width: 650px) {

    .settings-card {
        padding: 18px;
    }

    .settings-form-grid,
    .account-details-grid {
        grid-template-columns: 1fr;
    }

    .settings-field.full-width {
        grid-column: auto;
    }

    .settings-intro {
        align-items: flex-start;
    }

    .settings-form-footer {
        justify-content: stretch;
    }

    .settings-button {
        width: 100%;
    }

}

</style>

@endpush
