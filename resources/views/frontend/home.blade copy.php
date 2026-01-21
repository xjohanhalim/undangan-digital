<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Undangan Pernikahan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="theme-{{ $theme }}">
<audio id="bg-music" loop>
    <source src="{{ asset('audio/wedding.mp3') }}" type="audio/mpeg">
</audio>
<button
    id="music-toggle"
    class="fixed bottom-6 right-6 bg-yellow-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center text-xl z-50">
    ▶
</button>
@if($event)
<div class="min-h-screen flex flex-col items-center justify-center text-center px-6">

    <p class="text-sm tracking-widest text-gray-500 mb-4">
        UNDANGAN PERNIKAHAN
    </p>

    @if($guestName)
        <p class="text-sm text-gray-500 mb-3">
            Yth. Bapak/Ibu/Saudara/i
        </p>

        <h2 class="text-xl font-semibold mb-6">
            {{ e($guestName) }}
        </h2>
    @endif
    @if($guestName)
<div class="fixed bottom-4 left-1/2 -translate-x-1/2 
            text-xs text-gray-400 opacity-70 select-none pointer-events-none">
    Undangan khusus untuk {{ e($guestName) }}
</div>
@endif


    <h1 class="text-4xl font-serif text-gray-900 mb-2">
        {{ $event->bride_name }} & {{ $event->groom_name }}
    </h1>

    <div id="countdown" class="grid grid-cols-4 gap-4 mt-8 text-center">
        <div class="bg-white rounded-xl shadow p-4">
            <div id="days" class="text-2xl font-semibold">0</div>
            <div class="text-sm text-gray-500">Hari</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div id="hours" class="text-2xl font-semibold">0</div>
            <div class="text-sm text-gray-500">Jam</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div id="minutes" class="text-2xl font-semibold">0</div>
            <div class="text-sm text-gray-500">Menit</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <div id="seconds" class="text-2xl font-semibold">0</div>
            <div class="text-sm text-gray-500">Detik</div>
        </div>
    </div>

    <p class="text-lg text-gray-600 mb-6">
        {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}
    </p>

    @if($event->location)
        <div class="mt-6 text-gray-600">
            <p class="font-semibold">📍 Lokasi Acara</p>
            <p>{{ $event->location }}</p>
        </div>
    @endif

    @if($event->map_link)
        <div class="mt-6">
            <iframe
                src="{{ $event->map_link }}"
                class="w-full h-64 rounded-xl border"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    @endif

    <div class="w-24 h-[1px] bg-yellow-600 mb-6"></div>

    <p class="max-w-xl text-gray-600">
        Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri acara pernikahan kami.
    </p>

    <div class="mt-12 max-w-md w-full bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-center">
            Konfirmasi Kehadiran
        </h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="/rsvp" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="name" class="w-full border rounded-lg px-4 py-2" placeholder="Nama Anda" required>
            <select name="attendance" class="w-full border rounded-lg px-4 py-2">
                <option value="hadir">Hadir</option>
                <option value="tidak">Tidak Hadir</option>
            </select>
            <textarea name="message" class="w-full border rounded-lg px-4 py-2" placeholder="Ucapan & doa (opsional)"></textarea>
            <button class="w-full bg-yellow-600 text-white py-2 rounded-lg hover:bg-yellow-700 transition">
                Kirim RSVP
            </button>
        </form>
    </div>
</div>

<script>
    const targetDate = new Date("{{ \Carbon\Carbon::parse($event->event_date)->toIso8601String() }}").getTime();

    const countdown = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            clearInterval(countdown);
            document.getElementById("countdown").innerHTML =
                "<p class='col-span-4 text-green-700 font-semibold'>Acara sedang berlangsung 🎉</p>";
            return;
        }

        document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24));
        document.getElementById("hours").innerText = Math.floor((distance / (1000 * 60 * 60)) % 24);
        document.getElementById("minutes").innerText = Math.floor((distance / (1000 * 60)) % 60);
        document.getElementById("seconds").innerText = Math.floor((distance / 1000) % 60);
    }, 1000);
</script>

@else
<div class="min-h-screen flex items-center justify-center">
    <p class="text-gray-500">Data undangan belum tersedia.</p>
</div>
@endif

@if($photos->count())
<section class="mt-24 bg-[#f9f7f3] py-16">
    <div class="max-w-5xl mx-auto px-6">

        <h2 class="text-2xl font-semibold text-center mb-2">
            Galeri Foto
        </h2>
        <p class="text-center text-gray-500 mb-8">
            Momen kebahagiaan kami
        </p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($photos as $photo)
                <div class="overflow-hidden rounded-xl shadow">
                    <img
                        src="{{ asset('storage/'.$photo->image) }}"
                        class="w-full h-48 object-cover hover:scale-105 transition">
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

<script>
    const music = document.getElementById('bg-music');
    const toggleBtn = document.getElementById('music-toggle');

    let isPlaying = false;

    // Volume kecil biar elegan
    music.volume = 0.3;

    toggleBtn.addEventListener('click', () => {
        if (isPlaying) {
            music.pause();
            toggleBtn.innerText = '▶';
        } else {
            music.play();
            toggleBtn.innerText = '⏸';
        }
        isPlaying = !isPlaying;
    });

    // Auto play setelah interaksi pertama (scroll / klik)
    const autoPlay = () => {
        music.play().then(() => {
            isPlaying = true;
            toggleBtn.innerText = '⏸';
        }).catch(() => {});
        document.removeEventListener('click', autoPlay);
        document.removeEventListener('scroll', autoPlay);
    };

    document.addEventListener('click', autoPlay);
    document.addEventListener('scroll', autoPlay);
</script>

</body>
</html>
