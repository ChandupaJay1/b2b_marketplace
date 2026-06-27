@extends('layouts.admin')
@section('title', 'User Management')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-secondary">All Users</h2>
</div>

{{-- Filters --}}
<div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-40">
            <label class="label">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" class="input-field text-sm" placeholder="Name or email...">
        </div>
        <div class="w-40">
            <label class="label">Role</label>
            <select name="role" class="input-field text-sm">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" @selected(request('role') == $role->name)>{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-primary text-sm py-2.5 px-5">Filter</button>
        <a href="{{ route('admin.users.index') }}" class="btn-secondary text-sm py-2.5 px-5">Reset</a>
    </form>
</div>

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface border-b border-secondary/5">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">User</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Role</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Status</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Joined</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-secondary/50 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-secondary/5">
            @forelse($users as $user)
            <tr class="hover:bg-surface">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" class="w-9 h-9 rounded-full object-cover" alt="">
                            @else
                                <span class="text-primary-dark font-bold text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-secondary">{{ $user->name }}</p>
                            <p class="text-xs text-secondary/50">{{ $user->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4">
                    @foreach($user->roles as $role)
                        <span class="badge-primary text-xs">{{ ucfirst($role->name) }}</span>
                    @endforeach
                </td>
                <td class="px-5 py-4">
                    <span class="{{ $user->is_active ? 'badge-success' : 'badge-red' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-5 py-4 text-secondary/50 text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-xs text-primary hover:text-blue-800 font-medium">Edit</a>
                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="text-xs {{ $user->is_active ? 'text-red-600 hover:text-red-800' : 'text-primary hover:text-primary-dark' }} font-medium">
                                {{ $user->is_active ? 'Disable' : 'Enable' }}
                            </button>
                        </form>
                        @if(!$user->hasRole('admin'))
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-secondary/50 hover:text-red-600 font-medium">Delete</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-10 text-center text-secondary/50">No users found</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-secondary/5">{{ $users->withQueryString()->links() }}</div>
</div>
@endsection
