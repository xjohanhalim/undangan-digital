<x-app-layout>

    {{-- ================= HEADER ================= --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Kelola Galeri
            </h2>
            <p class="text-sm text-gray-500">
                Upload & kelola foto galeri undangan
            </p>
        </div>
    </x-slot>

    {{-- ================= CONTENT ================= --}}
    <div class="p-6 max-w-5xl mx-auto space-y-6">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-xl shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- UPLOAD CARD --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">

            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    📤 Upload Foto
                </h3>
            </div>

            <form action="{{ route('admin.gallery.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Pilih Foto
                    </label>

                    <input type="file" name="image" required
                        class="block w-full text-sm
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-lg file:border-0
                               file:bg-yellow-600 file:text-white
                               hover:file:bg-yellow-700
                               cursor-pointer
                               text-gray-700 dark:text-gray-300">
                </div>

                <div class="flex justify-end">
                    <button
                        class="inline-flex items-center gap-2 px-6 py-2 rounded-lg
                               bg-yellow-600 text-white font-medium
                               hover:bg-yellow-700 transition">
                        ➕ Upload Foto
                    </button>
                </div>
            </form>
        </div>

        {{-- GALERI CARD --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">

            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    🖼️ Daftar Foto
                </h3>
            </div>

            <div class="p-6">
                @if($photos->count())
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">

                        @foreach($photos as $photo)
                            <div class="group relative rounded-xl overflow-hidden shadow hover:shadow-xl transition">

                                <img src="{{ asset('storage/'.$photo->image) }}"
                                     class="w-full h-40 object-cover transition duration-300 group-hover:scale-105">

                                {{-- OVERLAY --}}
                                <div class="absolute inset-0 bg-black/50 opacity-0
                                            group-hover:opacity-100 transition
                                            flex items-center justify-center">

                                    <form method="POST"
                                          action="{{ route('admin.gallery.delete', $photo->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Hapus foto ini?')"
                                            class="px-4 py-2 rounded-lg text-sm
                                                   bg-red-600 text-white
                                                   hover:bg-red-700 transition">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    <p class="text-center text-gray-500">
                        Belum ada foto di galeri
                    </p>
                @endif
            </div>

        </div>

    </div>

</x-app-layout>
