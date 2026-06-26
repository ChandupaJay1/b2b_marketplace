@extends('layouts.admin')
@section('title', 'User Details')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Users</a>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn-primary text-sm py-2">Edit User</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-5">
        <div class="flex items-center gap-4 mb-5">
            <div class="w-16 h-16 rounded-full bg-green-50 border-4 border-white shadow flex items-center justify-center flex-shrink-0">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" class="w-16 h-16 rounded-full object-cover" alt="">
                @else
                    <span class="text-2xl font-bold text-green-700">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @endif
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                <div class="flex gap-2 mt-2">
                    @foreach($user->roles as $role)
                        <span class="badge-blue text-xs">{{ ucfirst($role->name) }}</span>
                    @endforeach
                    <span class="{{ $user->is_active ? 'badge-green' : 'badge-red' }} text-xs">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                </div>
            </div>
        </div>

        <dl class="grid grid-cols-2 gap-4 text-sm">
            @if($user->phone) <div><dt class="text-gray-500 text-xs">Phone</dt><dd class="font-medium">{{ $user->phone }}</dd></div> @endif
            @if($user->country) <div><dt class="text-gray-500 text-xs">Country</dt><dd class="font-medium">{{ $user->country }}</dd></div> @endif
            <div><dt class="text-gray-500 text-xs">Provider</dt><dd class="font-medium">{{ $user->provider ?? 'Email' }}</dd></div>
            <div><dt class="text-gray-500 text-xs">Joined</dt><dd class="font-medium">{{ $user->created_at->format('M d, Y') }}</dd></div>
        </dl>
    </div>

    @if($user->vendor)
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <h3 class="font-bold text-gray-900 mb-3">Vendor Account</h3>
        <div class="flex items-center justify-between">
            <div>
                <p class="font-medium text-gray-900">{{ $user->vendor->company_name }}</p>
                <p class="text-xs text-gray-500">{{ $user->vendor->country }}</p>
            </div>
            <a href="{{ route('admin.vendors.show', $user->vendor) }}" class="text-green-600 text-sm hover:underline font-medium">View →</a>
        </div>
    </div>
    @endif

    <div class="flex gap-3 mt-5">
        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit" class="{{ $user->is_active ? 'btn-danger' : 'btn-success' }} text-sm py-2">
                {{ $user->is_active ? 'Disable User' : 'Enable User' }}
            </button>
        </form>
        @if(!$user->hasRole('admin'))
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user permanently?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-secondary text-sm py-2 text-red-600 border-red-300">Delete User</button>
        </form>
        @endif
    </div>
</div>
@endsection
