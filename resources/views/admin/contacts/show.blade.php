@extends('layouts.admin')
@section('title', 'Message Details')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6"><a href="{{ route('admin.contacts.index') }}" class="text-sm text-secondary/50 hover:text-secondary/70">← Back to Messages</a></div>

    <div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-6">
        <div class="flex justify-between items-start mb-5">
            <h2 class="font-bold text-secondary text-lg">{{ $contact->subject }}</h2>
            <span class="{{ $contact->is_read ? 'badge-gray' : 'badge-primary' }} text-xs">{{ $contact->is_read ? 'Read' : 'Unread' }}</span>
        </div>

        <dl class="grid grid-cols-2 gap-4 text-sm mb-6 bg-surface rounded-xl p-4">
            <div><dt class="text-secondary/50 text-xs mb-0.5">From</dt><dd class="font-medium">{{ $contact->name }}</dd></div>
            <div><dt class="text-secondary/50 text-xs mb-0.5">Email</dt><dd class="font-medium">{{ $contact->email }}</dd></div>
            @if($contact->phone)
            <div><dt class="text-secondary/50 text-xs mb-0.5">Phone</dt><dd class="font-medium">{{ $contact->phone }}</dd></div>
            @endif
            <div><dt class="text-secondary/50 text-xs mb-0.5">Date</dt><dd class="text-secondary/60">{{ $contact->created_at->format('M d, Y \a\t h:i A') }}</dd></div>
        </dl>

        <div>
            <p class="text-secondary/50 text-xs mb-2">Message</p>
            <div class="bg-surface rounded-xl p-4 text-secondary text-sm leading-relaxed whitespace-pre-wrap">{{ $contact->message }}</div>
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
