<x-app-layout>

    {{-- ================= HEADER ================= --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Kelola Event
            </h2>
            <p class="text-sm text-gray-500">
                Atur informasi utama acara pernikahan
            </p>
        </div>
    </x-slot>

    {{-- ================= CONTENT ================= --}}
    <div class="p-6 max-w-3xl mx-auto space-y-6">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-xl shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- CARD --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">

            {{-- CARD HEADER --}}
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    ✏️ Form Data Event
                </h3>
            </div>

            {{-- FORM --}}
            <form method="POST"
                  action="{{ route('admin.event.update') }}"
                  class="p-6 space-y-5">
                @csrf

                {{-- Mempelai Wanita --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nama Mempelai Wanita
                    </label>
                    <input type="text" name="bride_name"
                        value="{{ $event->bride_name }}"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                               bg-white dark:bg-gray-700
                               text-gray-800 dark:text-gray-100
                               px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Nama Mempelai Wanita">
                </div>

                {{-- Mempelai Pria --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nama Mempelai Pria
                    </label>
                    <input type="text" name="groom_name"
                        value="{{ $event->groom_name }}"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                               bg-white dark:bg-gray-700
                               text-gray-800 dark:text-gray-100
                               px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Nama Mempelai Pria">
                </div>

                {{-- Tanggal Acara --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Tanggal Acara
                    </label>
                    <input type="date" name="event_date"
                        value="{{ $event->event_date }}"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                               bg-white dark:bg-gray-700
                               text-gray-800 dark:text-gray-100
                               px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Lokasi Acara
                    </label>
                    <input type="text" name="location"
                        value="{{ $event->location }}"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                               bg-white dark:bg-gray-700
                               text-gray-800 dark:text-gray-100
                               px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Lokasi Acara">
                </div>

                {{-- Map Link --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Google Maps Embed
                    </label>
                    <textarea name="map_link" rows="5"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600
                               bg-white dark:bg-gray-700
                               text-gray-800 dark:text-gray-100
                               px-4 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Link Google Maps Embed">{{ $event->map_link }}</textarea>
                </div>

                {{-- ACTION --}}
                <div class="pt-4 flex justify-end">
                    <button
                        class="inline-flex items-center gap-2 px-6 py-2 rounded-lg
                               bg-yellow-600 text-white font-medium
                               hover:bg-yellow-700 transition">
                        💾 Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
