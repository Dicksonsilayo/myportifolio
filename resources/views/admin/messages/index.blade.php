@extends('layouts.admin')

@section('content')

<div>

    {{-- Page heading --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-white">
            Messages
        </h1>

        <p class="text-gray-400 mt-2">
            Manage messages received through your portfolio contact form.
        </p>

    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        <div class="admin-card p-6">

            <p class="text-gray-400 text-sm">
                Total Messages
            </p>

            <h2 class="text-3xl font-bold text-white mt-2">
                {{ $statistics['total'] }}
            </h2>

        </div>


        <div class="admin-card p-6">

            <p class="text-gray-400 text-sm">
                Unread Messages
            </p>

            <h2 class="text-3xl font-bold text-yellow-400 mt-2">
                {{ $statistics['unread'] }}
            </h2>

        </div>


        <div class="admin-card p-6">

            <p class="text-gray-400 text-sm">
                Read Messages
            </p>

            <h2 class="text-3xl font-bold text-green-400 mt-2">
                {{ $statistics['read'] }}
            </h2>

        </div>

    </div>


    {{-- Search and filter --}}
    <div class="admin-card p-5 mb-6">

        <form
            action="{{ route('admin.messages.index') }}"
            method="GET"
            class="flex flex-col md:flex-row gap-4"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search name, email, subject or message..."
                class="form-input flex-1"
            >

            <select name="status" class="form-input md:w-48">

                <option value="">All Messages</option>

                <option
                    value="unread"
                    {{ request('status') === 'unread' ? 'selected' : '' }}
                >
                    Unread
                </option>

                <option
                    value="read"
                    {{ request('status') === 'read' ? 'selected' : '' }}
                >
                    Read
                </option>

            </select>

            <button type="submit" class="btn-primary">
                Search
            </button>

            <a
                href="{{ route('admin.messages.index') }}"
                class="px-5 py-3 rounded-lg bg-gray-700 text-white text-center"
            >
                Reset
            </a>

        </form>

    </div>


    {{-- Messages table --}}
    <div class="admin-card overflow-hidden">

        @if($messages->count())

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-800 text-gray-300">

                        <tr>

                            <th class="p-4">Sender</th>

                            <th class="p-4">Subject</th>

                            <th class="p-4">Message</th>

                            <th class="p-4">Date</th>

                            <th class="p-4">Status</th>

                            <th class="p-4">Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($messages as $message)

                            <tr class="border-t border-gray-700
                                {{ !$message->is_read ? 'bg-purple-900/10' : '' }}">

                                {{-- Sender --}}
                                <td class="p-4">

                                    <div class="font-semibold text-white">
                                        {{ $message->name }}
                                    </div>

                                    <div class="text-gray-400 text-xs">
                                        {{ $message->email }}
                                    </div>

                                </td>


                                {{-- Subject --}}
                                <td class="p-4 text-gray-300">

                                    {{ $message->subject ?: 'No subject' }}

                                </td>


                                {{-- Message preview --}}
                                <td class="p-4 text-gray-400">

                                    {{ \Illuminate\Support\Str::limit($message->message, 55) }}

                                </td>


                                {{-- Date --}}
                                <td class="p-4 text-gray-400 text-sm">

                                    {{ $message->created_at->format('d M Y') }}

                                </td>


                                {{-- Status --}}
                                <td class="p-4">

                                    @if($message->is_read)

                                        <span class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-400">
                                            Read
                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-full text-xs bg-yellow-500/20 text-yellow-400">
                                            Unread
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="p-4">

                                    <div class="flex flex-wrap items-center gap-3">

                                        <a
                                            href="{{ route('admin.messages.show', $message) }}"
                                            class="text-blue-400 hover:text-blue-300"
                                        >
                                            View
                                        </a>


                                        <form
                                            action="{{ route('admin.messages.toggle-read', $message) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="text-purple-400 hover:text-purple-300"
                                            >
                                                {{ $message->is_read ? 'Mark unread' : 'Mark read' }}
                                            </button>

                                        </form>


                                        <form
                                            action="{{ route('admin.messages.destroy', $message) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this message?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-red-400 hover:text-red-300"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="p-4">
                {{ $messages->links() }}
            </div>


        @else

            <div class="p-12 text-center">

                <div class="text-5xl mb-4">
                    📩
                </div>

                <h3 class="text-xl font-semibold text-white">
                    No messages found
                </h3>

                <p class="text-gray-400 mt-2">
                    Messages submitted through your contact form will appear here.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection