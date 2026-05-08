@extends('layouts.base')

@section('title', 'User Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-people me-2"></i>User Management</h1>
            <p>Manage system users and their roles</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-light fw-semibold">
            <i class="bi bi-person-plus me-1"></i>Add New User
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="userSearch"
                           class="form-control border-start-0 ps-0"
                           placeholder="Search by name or email…">
                </div>
            </div>
            <div class="col-md-3">
                <select id="roleFilter" class="form-select">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div class="col-md-4 text-end">
                <small class="text-white opacity-75">
                    Total: <strong>{{ $users->total() }}</strong> users
                </small>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0" id="usersTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Role</th>
                        <th>Registered</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr data-role="{{ $user->role }}">
                            <td class="text-muted small">{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0"
                                         style="width:38px;height:38px;font-size:15px;background:{{ $user->isAdmin() ? '#3498db' : '#27ae60' }};">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->id === auth()->id())
                                            <span class="badge bg-warning text-dark ms-1" style="font-size:10px;">You</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                @if($user->isAdmin())
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="bi bi-shield-check me-1"></i>Admin
                                    </span>
                                @else
                                    <span class="badge bg-success rounded-pill">
                                        <i class="bi bi-person me-1"></i>Staff
                                    </span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="btn btn-warning btn-sm"
                                       data-bs-toggle="tooltip" title="Edit User">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-delete-url="{{ route('users.destroy', $user) }}"
                                                data-delete-name="{{ $user->name }}"
                                                data-bs-toggle="tooltip" title="Delete User">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled
                                                data-bs-toggle="tooltip" title="Cannot delete your own account">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-people display-4 d-block mb-2"></i>No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center px-3 py-3">
            <small class="text-muted">
                Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} users
            </small>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
        bootstrap.Tooltip.getOrCreateInstance(el);
    });

    function filterUsers() {
        var q    = $('#userSearch').val().toLowerCase();
        var role = $('#roleFilter').val();
        $('#usersTable tbody tr').each(function () {
            var match = (!q || $(this).text().toLowerCase().includes(q))
                     && (!role || $(this).data('role') === role);
            $(this).toggle(match);
        });
    }
    $('#userSearch').on('keyup input', filterUsers);
    $('#roleFilter').on('change', filterUsers);
});
</script>
@endpush
