@extends('layouts.app')
@section('title', 'Create Role')
<br/><br/><br/><br/>
@section('content')
    <!-- Wrapper -->
    <div class="container my-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role List</li>
            </ol>
        </nav>

        <!-- Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Role</h5>
                <a href="{{ url('roles') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bx bx-left-arrow-alt me-1"></i>Back
                </a>
            </div>
           


            <div class="container">
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <!-- Role Name Field -->
        <div class="mb-3">
            <label for="roleName" class="form-label">Role Name</label>
            <input type="text" name="role_name" id="roleName" class="form-control" required>
        </div>

        <!-- Permissions Group Section -->
        @foreach ($permissions as $group => $permissionList)
            <div class="card mb-3">
                <div class="card-header">
                    <strong>{{ $group }}</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($permissionList as $permission)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission_ids[]" value="{{ $permission->id }}" id="permission{{ $permission->id }}">
                                    <label class="form-check-label" for="permission{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save Role</button>
    </form>
</div>


        </div>
    </div>
@endsection

@section('scripts')
<script>
    function toggleGroup(groupId) {
        // Toggle all permissions in the same group
        const groupCheckbox = document.getElementById('group_' + groupId);
        const permissions = document.querySelectorAll('.permission-checkbox[data-group-id="' + groupId + '"]');
        
        permissions.forEach(permissionCheckbox => {
            permissionCheckbox.checked = groupCheckbox.checked;
        });
    }
</script>
@endsection
