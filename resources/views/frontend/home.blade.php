<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan</title>
    <link rel="stylesheet" href="{{ asset('css/wedding-style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Audio -->
    <audio id="bg-music" loop>
        <source src="{{ asset('audio/wedding.mp3') }}" type="audio/mpeg">
    </audio>

    @if($event)
    <!-- Cover -->
    <div class="cover" id="cover">
        <div class="cover-content">
            <div class="cover-title">UNDANGAN PERNIKAHAN</div>
            <div class="cover-names">{{ $event->bride_name }} & {{ $event->groom_name }}</div>
            <div class="cover-date">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</div>
            <button class="open-btn" onclick="openInvitation()">BUKA UNDANGAN</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Hero Section -->
        <section class="hero">
            <div class="label">UNDANGAN PERNIKAHAN</div>
            
            @if($guestName)
                <div class="guest-name">Yth. Bapak/Ibu/Saudara/i</div>
                <div class="guest-name-large">{{ e($guestName) }}</div>
            @endif

            <div class="couple-names">{{ $event->bride_name }} & {{ $event->groom_name }}</div>
            
            <div class="divider"></div>

            <div class="event-date">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</div>

            <!-- Countdown -->
            <div class="countdown" id="countdown">
                <div class="countdown-item">
                    <span class="countdown-number" id="days">0</span>
                    <span class="countdown-label">Hari</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="hours">0</span>
                    <span class="countdown-label">Jam</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="minutes">0</span>
                    <span class="countdown-label">Menit</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="seconds">0</span>
                    <span class="countdown-label">Detik</span>
                </div>
            </div>

            <p class="hero-text">
                Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Bapak/Ibu/Saudara/i 
                untuk menghadiri acara pernikahan kami yang akan dilaksanakan pada:
            </p>
        </section>

        <!-- Details Section -->
        <section class="details-section">
            <h2 class="section-title">Acara Pernikahan</h2>
            <p class="section-subtitle">Dua acara dalam satu hari istimewa</p>

            <div class="details-grid">
                <div class="detail-card">
                    <span class="detail-icon">🕌</span>
                    <h3 class="detail-title">Akad Nikah</h3>
                    <p class="detail-text">
                        <strong>{{ \Carbon\Carbon::parse($event->event_date)->format('H:i') }} WIB</strong><br>
                        @if($event->location)
                            {{ $event->location }}
                        @else
                            Lokasi akan ditentukan
                        @endif
                    </p>
                </div>

                <div class="detail-card">
                    <span class="detail-icon">🎉</span>
                    <h3 class="detail-title">Resepsi</h3>
                    <p class="detail-text">
                        <strong>{{ \Carbon\Carbon::parse($event->event_date)->addHours(3)->format('H:i') }} WIB</strong><br>
                        @if($event->location)
                            {{ $event->location }}
                        @else
                            Lokasi akan ditentukan
                        @endif
                    </p>
                </div>
            </div>
        </section>

        <!-- Location -->
        @if($event->location || $event->map_link)
        <section class="location-section">
            <h2 class="section-title">Lokasi Acara</h2>
            @if($event->location)
                <p class="section-subtitle">{{ $event->location }}</p>
            @endif

            @if($event->map_link)
            <div class="map-container">
                <iframe
                    src="{{ $event->map_link }}"
                    class="map-frame"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            @else
            <div class="map-container">
                <div class="map-placeholder">
                    📍 Peta Lokasi<br>
                    <small>Segera hadir</small>
                </div>
            </div>
            @endif
        </section>
        @endif

        <!-- Gallery -->
        @if($photos->count())
        <section class="gallery-section">
            <h2 class="section-title">Galeri Foto</h2>
            <p class="section-subtitle">Momen kebahagiaan kami</p>

            <div class="gallery-grid">
                @foreach($photos as $photo)
                <div class="gallery-item">
                    <img 
                        src="{{ asset('storage/'.$photo->image) }}"
                        class="gallery-img"
                        alt="Wedding Photo"
                    >
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- RSVP -->
        <section class="rsvp-section">
            <h2 class="section-title">Konfirmasi Kehadiran</h2>
            <p class="section-subtitle">Mohon konfirmasi kehadiran Anda</p>

            <form class="rsvp-form" action="/rsvp" method="POST">
                @csrf
                
                @if(session('success'))
                <div class="success-msg">
                    {{ session('success') }}
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-input" placeholder="Masukkan nama Anda" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Kehadiran</label>
                    <select name="attendance" class="form-select" required>
                        <option value="">Pilih...</option>
                        <option value="hadir">✅ Ya, saya akan hadir</option>
                        <option value="tidak">❌ Maaf, saya tidak bisa hadir</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Ucapan & Doa (Opsional)</label>
                    <textarea name="message" class="form-textarea" placeholder="Tuliskan ucapan dan doa untuk kami..."></textarea>
                </div>

                <button type="submit" class="submit-btn">KIRIM KONFIRMASI</button>
            </form>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-text">
                Merupakan suatu kehormatan dan kebahagiaan bagi kami<br>
                apabila Bapak/Ibu/Saudara/i berkenan hadir<br>
                untuk memberikan doa restu kepada kami.<br><br>
                ❤️ {{ $event->bride_name }} & {{ $event->groom_name }} ❤️
            </div>
        </footer>

        @if($guestName)
        <div class="guest-watermark">
            Undangan khusus untuk {{ e($guestName) }}
        </div>
        @endif
    </div>

    @else
    <div class="no-data">
        <p>Data undangan belum tersedia.</p>
    </div>
    @endif

    <!-- Music Button -->
    <button class="music-btn" id="music-toggle">▶</button>

    <script>
        let isPlaying = false;
        const music = document.getElementById('bg-music');
        const musicBtn = document.getElementById('music-toggle');
        
        music.volume = 0.3;

        function openInvitation() {
            document.getElementById('cover').classList.add('hidden');
            document.getElementById('mainContent').classList.add('visible');
            
            // Auto play music
            setTimeout(() => {
                music.play().then(() => {
                    isPlaying = true;
                    musicBtn.textContent = '⏸';
                }).catch(() => {});
            }, 1000);
        }

        musicBtn.addEventListener('click', () => {
            if (isPlaying) {
                music.pause();
                musicBtn.textContent = '▶';
            } else {
                music.play();
                musicBtn.textContent = '⏸';
            }
            isPlaying = !isPlaying;
        });

        // Countdown
        @if($event)
        const targetDate = new Date("{{ \Carbon\Carbon::parse($event->event_date)->toIso8601String() }}").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                document.getElementById('countdown').innerHTML = 
                    '<div style="grid-column: 1/-1; color: #c9a96e; font-size: 1.5rem; font-weight: 600;">🎉 Acara Sedang Berlangsung 🎉</div>';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = days;
            document.getElementById('hours').textContent = hours;
            document.getElementById('minutes').textContent = minutes;
            document.getElementById('seconds').textContent = seconds;
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();
        @endif
    </script>
</body>
</html>