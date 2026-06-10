@extends('layouts.admin')
@section('title', 'Add Vendor')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6"><a href="{{ route('admin.vendors.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Vendors</a></div>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <h2 class="font-bold text-gray-900 text-lg mb-6">Add New Vendor</h2>
        <form action="{{ route('admin.vendors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="label">Category *</label>
                    <select name="vendor_category_id" class="input-field" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('vendor_category_id') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('vendor_category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="label">Company Name *</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" class="input-field @error('company_name') border-red-400 @enderror" required>
                    @error('company_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="label">Business Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="input-field @error('email') border-red-400 @enderror" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="label">Phone</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" class="input-field">
                </div>
                <div>
                    <label class="label">Website</label>
                    <input type="url" name="website" value="{{ old('website') }}" class="input-field @error('website') border-red-400 @enderror" placeholder="https://">
                    @error('website') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="label">Country</label>
                    <input type="text" name="country" value="{{ old('country') }}" class="input-field">
                </div>
                <div>
                    <label class="label">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" class="input-field">
                </div>
                <div>
                    <label class="label">State / Province</label>
                    <input type="text" name="state" value="{{ old('state') }}" class="input-field">
                </div>
                <div>
                    <label class="label">Postal Code</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="input-field">
                </div>
                <div>
                    <label class="label">Established Year</label>
                    <input type="number" name="established_year" value="{{ old('established_year') }}" class="input-field" min="1900" max="{{ date('Y') }}">
                </div>
                <div>
                    <label class="label">Number of Employees</label>
                    <input type="number" name="employees_count" value="{{ old('employees_count') }}" class="input-field" min="1">
                </div>
                <div>
                    <label class="label">Certifications</label>
                    <input type="text" name="certifications" value="{{ old('certifications') }}" class="input-field" placeholder="ISO 9001, etc.">
                </div>
                <div>
                    <label class="label">Status</label>
                    <select name="status" class="input-field">
                        @foreach(['pending','approved','rejected','suspended'] as $s)
                            <option value="{{ $s }}" @selected(old('status', 'approved') == $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="label">Address</label>
                <input type="text" name="address" value="{{ old('address') }}" class="input-field">
            </div>
            <div>
                <label class="label">Description</label>
                <textarea name="description" rows="4" class="input-field resize-none" placeholder="Tell buyers about this vendor...">{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="label">Logo <span class="text-gray-400 font-normal">(max 2MB)</span></label>
                    <input type="file" name="logo" accept="image/*" class="input-field text-sm">
                    @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="label">Banner <span class="text-gray-400 font-normal">(max 4MB)</span></label>
                    <input type="file" name="banner" accept="image/*" class="input-field text-sm">
                    @error('banner') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured')) class="rounded border-gray-300">
                <label for="is_featured" class="text-sm text-gray-700">Mark as Featured Vendor</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary text-sm">Create Vendor</button>
                <a href="{{ route('admin.vendors.index') }}" class="btn-secondary text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
