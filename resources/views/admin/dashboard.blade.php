<x-app-layout>

    {{-- ================= HEADER ================= --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Dashboard Admin
            </h2>
            <p class="text-sm text-gray-500">
                Kelola & pantau data RSVP tamu undangan
            </p>
        </div>
    </x-slot>

    {{-- ================= CONTENT ================= --}}
    <div class="p-6 max-w-7xl mx-auto space-y-6">

        {{-- CARD --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">

            {{-- CARD HEADER --}}
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700
                        flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    📋 Data RSVP
                </h3>

                {{-- ACTION BUTTON --}}
                <div class="flex gap-2">
                    <a href="{{ route('admin.rsvp.export.excel') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                              bg-green-600 text-white text-sm font-medium
                              hover:bg-green-700 transition">
                        📊 Export Excel
                    </a>

                    <a href="{{ route('admin.rsvp.export.pdf') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                              bg-red-600 text-white text-sm font-medium
                              hover:bg-red-700 transition">
                        📄 Export PDF
                    </a>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">No</th>
                            <th class="px-4 py-3 text-left font-semibold">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold">Kehadiran</th>
                            <th class="px-4 py-3 text-left font-semibold">Ucapan</th>
                            <th class="px-4 py-3 text-left font-semibold">Waktu</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($rsvps as $rsvp)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-3">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-100">
                                    {{ $rsvp->name }}
                                </td>

                                <td class="px-4 py-3">
                                    @if($rsvp->attendance === 'hadir')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                     bg-green-100 text-green-700">
                                            Hadir
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                     bg-red-100 text-red-700">
                                            Tidak Hadir
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-gray-600 dark:text-gray-300 max-w-xs truncate">
                                    {{ $rsvp->message ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-gray-500">
                                    {{ $rsvp->created_at->format('d M Y, H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    Belum ada data RSVP
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</x-app-layout>
