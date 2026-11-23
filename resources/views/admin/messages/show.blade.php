@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Heading --}}
    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-white">
                View Message
            </h1>

            <p class="text-gray-400 mt-2">
                Read the complete message from your visitor.
            </p>

        </div>

        <a
            href="{{ route('admin.messages.index') }}"
            class="px-5 py-3 rounded-lg bg-gray-700 hover:bg-gray-600 text-white"
        >
            ← Back
        </a>

    </div>


    {{-- Message details --}}
    <div class="admin-card p-6 md:p-8">

        <div class="flex items-start justify-between gap-4 mb-8">

            <div>

                <h2 class="text-2xl font-bold text-white">
                    {{ $message->subject ?: 'No subject' }}
                </h2>

                <p class="text-gray-400 mt-2">
                    Received {{ $message->created_at->format('d M Y, h:i A') }}
                </p>

            </div>


            <span class="px-3 py-1 rounded-full text-xs
                {{ $message->is_read
                    ? 'bg-green-500/20 text-green-400'
                    : 'bg-yellow-500/20 text-yellow-400' }}">

                {{ $message->is_read ? 'Read' : 'Unread' }}

            </span>

        </div>


        <div class="border-t border-gray-700 pt-6 space-y-5">

            <div>

                <p class="text-gray-500 text-sm">
                    Sender Name
                </p>

                <p class="text-white font-medium mt-1">
                    {{ $message->name }}
                </p>

            </div>


            <div>

                <p class="text-gray-500 text-sm">
                    Email Address
                </p>

                <a
                    href="mailto:{{ $message->email }}"
                    class="text-purple-400 hover:underline mt-1 inline-block"
                >
                    {{ $message->email }}
                </a>

            </div>


            <div>

                <p class="text-gray-500 text-sm mb-2">
                    Message
                </p>

                <div class="bg-gray-800/70 rounded-xl p-5 text-gray-200 leading-7 whitespace-pre-line">
                    {{ $message->message }}
                </div>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex flex-wrap gap-3 mt-8 border-t border-gray-700 pt-6">

            <a
                href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: ' . ($message->subject ?: 'Your message')) }}"
                class="btn-primary"
            >
                Reply by Email
            </a>


            <form
                action="{{ route('admin.messages.toggle-read', $message) }}"
                method="POST"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="px-5 py-3 rounded-lg bg-gray-700 hover:bg-gray-600 text-white"
                >
                    {{ $message->is_read ? 'Mark as Unread' : 'Mark as Read' }}
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
                    class="px-5 py-3 rounded-lg bg-red-600 hover:bg-red-700 text-white"
                >
                    Delete Message
                </button>

            </form>

        </div>

    </div>

</div>

@endsection