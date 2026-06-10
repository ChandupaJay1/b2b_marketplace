@extends('layouts.admin')
@section('title', 'Message Details')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6"><a href="{{ route('admin.contacts.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Messages</a></div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <div class="flex justify-between items-start mb-5">
            <h2 class="font-bold text-gray-900 text-lg">{{ $contact->subject }}</h2>
            <span class="{{ $contact->is_read ? 'badge-gray' : 'badge-blue' }} text-xs">{{ $contact->is_read ? 'Read' : 'Unread' }}</span>
        </div>

        <dl class="grid grid-cols-2 gap-4 text-sm mb-6 bg-gray-50 rounded-xl p-4">
            <div><dt class="text-gray-500 text-xs mb-0.5">From</dt><dd class="font-medium">{{ $contact->name }}</dd></div>
            <div><dt class="text-gray-500 text-xs mb-0.5">Email</dt><dd class="font-medium">{{ $contact->email }}</dd></div>
            @if($contact->phone)
            <div><dt class="text-gray-500 text-xs mb-0.5">Phone</dt><dd class="font-medium">{{ $contact->phone }}</dd></div>
            @endif
            <div><dt class="text-gray-500 text-xs mb-0.5">Date</dt><dd class="text-gray-600">{{ $contact->created_at->format('M d, Y \a\t h:i A') }}</dd></div>
        </dl>

        <div>
            <p class="text-gray-500 text-xs mb-2">Message</p>
            <div class="bg-gray-50 rounded-xl p-4 text-gray-800 text-sm leading-relaxed whitespace-pre-wrap">{{ $contact->message }}</div>
        </div>

        <div class="flex gap-3 mt-6">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn-primary text-sm">Reply via Email</a>
            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger text-sm">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
