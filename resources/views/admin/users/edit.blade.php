@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-sm text-secondary/50 hover:text-secondary/70">← Back to Users</a>
    </div>
    <div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-6">
        <h2 class="font-bold text-secondary text-lg mb-6">Edit: {{ $user->name }}</h2>
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="label">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-field @error('name') border-red-400 @enderror" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-field @error('email') border-red-400 @enderror" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label">Role</label>
                <select name="role" class="input-field" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" @selected($user->hasRole($role->name))>{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Status</label>
                <select name="is_active" class="input-field" required>
                    <option value="1" @selected($user->is_active)>Active</option>
                    <option value="0" @selected(!$user->is_active)>Inactive</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary text-sm">Save Changes</button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
