@extends('layouts.app')
@section('title', 'My Profile — B2B Marketplace')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">My Profile</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Avatar & Quick Info --}}
        <div class="card p-6 text-center">
            <div class="w-24 h-24 mx-auto mb-4 rounded-full overflow-hidden bg-blue-50 border-4 border-white shadow">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-3xl font-bold text-blue-700">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <h2 class="font-bold text-gray-900 text-lg">{{ $user->name }}</h2>
            <p class="text-gray-500 text-sm">{{ $user->email }}</p>
            <div class="mt-3">
                @foreach($user->roles as $role)
                    <span class="badge-blue">{{ ucfirst($role->name) }}</span>
                @endforeach
            </div>
            @if($user->country)
                <p class="text-gray-500 text-sm mt-2">🌍 {{ $user->country }}</p>
            @endif
            <p class="text-xs text-gray-400 mt-4">Member since {{ $user->created_at->format('M Y') }}</p>
        </div>

        {{-- Forms --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Profile Info --}}
            <div class="card p-6">
                <h3 class="font-bold text-gray-900 mb-5">Update Profile</h3>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="label">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-field @error('name') border-red-400 @enderror" required>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-field @error('email') border-red-400 @enderror" required>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" class="input-field">
                        </div>
                        <div>
                            <label class="label">Country</label>
                            <input type="text" name="country" value="{{ old('country', $user->country) }}" class="input-field">
                        </div>
                    </div>
                    <div>
                        <label class="label">Profile Photo</label>
                        <input type="file" name="avatar" accept="image/*" class="input-field text-sm">
                    </div>
                    <button type="submit" class="btn-primary text-sm py-2.5">Save Changes</button>
                </form>
            </div>

            {{-- Change Password --}}
            <div class="card p-6">
                <h3 class="font-bold text-gray-900 mb-5">Change Password</h3>
                <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="label">Current Password</label>
                        <input type="password" name="current_password" class="input-field @error('current_password') border-red-400 @enderror" required>
                        @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="label">New Password</label>
                            <input type="password" name="password" class="input-field" required>
                        </div>
                        <div>
                            <label class="label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="input-field" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-success text-sm py-2.5">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
