@extends('layouts.admin')
@section('title', 'Contact Messages')

@section('content')
<div class="mb-6">
    <h2 class="text-lg font-bold text-gray-900">Contact Messages</h2>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5">
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

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Sender</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Subject</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($contacts as $contact)
            <tr class="hover:bg-gray-50 {{ !$contact->is_read ? 'bg-blue-50/30' : '' }}">
                <td class="px-5 py-4">
                    <p class="font-medium text-gray-900 {{ !$contact->is_read ? 'font-bold' : '' }}">{{ $contact->name }}</p>
                    <p class="text-xs text-gray-500">{{ $contact->email }}</p>
                </td>
                <td class="px-5 py-4 text-gray-600 {{ !$contact->is_read ? 'font-semibold' : '' }}">{{ $contact->subject }}</td>
                <td class="px-5 py-4">
                    <span class="{{ $contact->is_read ? 'badge-gray' : 'badge-blue' }} text-xs">{{ $contact->is_read ? 'Read' : 'Unread' }}</span>
                </td>
                <td class="px-5 py-4 text-gray-400 text-xs">{{ $contact->created_at->format('M d, Y') }}</td>
                <td class="px-5 py-4 text-right">
                    <a href="{{ route('admin.contacts.show', $contact) }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium mr-3">View</a>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-gray-400 hover:text-red-600 font-medium">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-10 text-center text-gray-400">No messages</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-100">{{ $contacts->withQueryString()->links() }}</div>
</div>
@endsection
