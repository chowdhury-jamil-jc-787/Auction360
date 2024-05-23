<x-backend.layouts.master>

    <x-slot:title1>Show</x-slot:title1>
    <x-slot:title>roles-permission-show</x-slot:title>


            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">
                        <span>Role's Has Permission</span>
                        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $role->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Permissions:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            @if ($role->name == 'Super Admin')
                                <span class="badge bg-primary">All</span>
                            @else
                                @foreach ($rolePermissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}" value="{{ $permission->id }}" disabled {{ $rolePermissions->contains($permission->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>


</x-backend.layouts.master>
