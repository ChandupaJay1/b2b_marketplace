@extends('layouts.admin')
@section('title', 'Contact Messages')

@section('content')
<div class="mb-6">
    <h2 class="text-lg font-bold text-secondary">Contact Messages</h2>
</div>

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-4 mb-5">
    <form method="GET" class="flex gap-4 items-end">
        <div class="w-44">
            <label class="label">Status</label>
            <select name="status" class="input-field text-sm">
                <option value="">All</option>
                <option value="unread" @selected(request('status') === 'unread')>Unread</option>
                <option value="read" @selected(request('status') === 'read')>Read</option>
            </select>
        </div>
        <button type="submit" class="btn-primary text-sm py-2.5 px-5">Filter</button>
    </form>
</div>

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface border-b border-secondary/5">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Sender</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Subject</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Status</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Date</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-secondary/50 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-secondary/5">
            @forelse($contacts as $contact)
            <tr class="hover:bg-surface {{ !$contact->is_read ? 'bg-primary/10/30' : '' }}">
                <td class="px-5 py-4">
                    <p class="font-medium text-secondary {{ !$contact->is_read ? 'font-bold' : '' }}">{{ $contact->name }}</p>
                    <p class="text-xs text-secondary/50">{{ $contact->email }}</p>
                </td>
                <td class="px-5 py-4 text-secondary/60 {{ !$contact->is_read ? 'font-semibold' : '' }}">{{ $contact->subject }}</td>
                <td class="px-5 py-4">
                    <span class="{{ $contact->is_read ? 'badge-gray' : 'badge-primary' }} text-xs">{{ $contact->is_read ? 'Read' : 'Unread' }}</span>
                </td>
                <td class="px-5 py-4 text-secondary/50 text-xs">{{ $contact->created_at->format('M d, Y') }}</td>
                <td class="px-5 py-4 text-right">
                    <a href="{{ route('admin.contacts.show', $contact) }}" class="text-xs text-primary hover:text-primary-dark font-medium mr-3">View</a>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-secondary/50 hover:text-red-600 font-medium">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-10 text-center text-secondary/50">No messages</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-secondary/5">{{ $contacts->withQueryString()->links() }}</div>
</div>
@endsection
