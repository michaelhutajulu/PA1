<footer style="background-color: #284593; color: white; padding-top: 60px; padding-bottom: 0;">
    <div class="container pb-5">
        <div class="row g-5 align-items-start">
            <!-- Google Map -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4" style="font-size: 28px;">Lokasi Bintang Serasi</h2>
                <div class="rounded overflow-hidden shadow-lg" style="border-radius: 15px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.509434915169!2d99.05741557581437!3d2.3336297576225076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e05c85050a295%3A0x8b693c398e4b46c7!2sToko%20Bintang%20Serasi!5e0!3m2!1sid!2sid!4v1743911151567!5m2!1sid!2sid"
                        width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Kritik dan Saran -->
            <div class="col-lg-5 offset-lg-2">
                <h2 class="fw-bold mb-3" style="font-size: 28px;">Bantu kami dengan memberikan saran</h2>
                <div class="bg-white p-4 rounded-2 shadow" style="max-width: 450px;">
                    <!-- Alert Messages -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
                            {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <form id="formSaran" action="{{ route('saran.kirim') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="pesan" id="pesanSaran" class="form-control rounded-3 py-2 px-3" placeholder="Saran Anda" required
                                style="resize: none; border-color: #e0e0e0; background-color: #f8f9fa; height: 130px; max-height: 130px; overflow-y: auto;">{{ session('draft_saran', '') }}</textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn rounded-pill fw-semibold px-4 py-2 shadow text-white border-0"
                                style="background: linear-gradient(45deg, #284593, #376fa7);">
                                <span class="d-flex align-items-center gap-2">
                                    <span>Kirim</span>
                                    <i class="bi bi-arrow-right-circle"></i>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('pesanSaran');

            textarea.addEventListener('focus', function() {
                this.style.outline = 'none';
                this.style.borderColor = '#376fa7';
            });

            textarea.addEventListener('blur', function() {
                this.style.borderColor = '#e0e0e0';
            });

            const alerts = document.querySelectorAll('.alert');

            // Atur timeout untuk menghilangkannya setelah 5 detik
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000); // 5000 ms = 5 detik
            });
        });
    </script>
    </div>
    </div>

    <!-- Informasi Toko -->
    <div class="bg-white text-dark py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Navbar bawah -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="d-flex align-items-center mb-3">
                        <span class="me-2 fs-4" style="color: #284593;">⭐</span>
                        <h3 class="mb-0 fw-bold" style="color: #284593;">Bintang Serasi</h3>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/"
                                class="text-decoration-none text-secondary hover-link">Beranda</a></li>
                        <li class="mb-2"><a href="/katalog"
                                class="text-decoration-none text-secondary hover-link">Katalog</a></li>
                        <li class="mb-2"><a href="/favorit"
                                class="text-decoration-none text-secondary hover-link">Favorit</a></li>
                        <li><a href="/profil-toko" class="text-decoration-none text-secondary hover-link">Profil
                                Toko</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div class="col-md-4 mb-4 mb-md-0 text-center">
                    <h3 class="mb-4 fw-bold" style="color: #284593;">Terhubung dengan kami</h3>
                    <div class="d-flex justify-content-center gap-4">
                        <a href="#" class="social-icon">
                            <i class="bi bi-instagram fs-2"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-facebook fs-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Info Toko -->
                <div class="col-md-4">
                    <h3 class="mb-0 fw-bold" style="color: #284593;">Informasi Toko</h3>
                    <hr>
                    <p class="fw-semibold" style="color: #284593;">Waktu Operasional</p>
                    <p>Senin - Sabtu : 08.00 - 20.00</p>
                    <p>Minggu : 12.00 - 20.00</p>
                    <p id="status-operasional" class="fw-semibold mt-2" style="color: #284593;"></p>

                    <p class="fw-semibold mt-4" style="color: #284593;">No. Telepon</p>
                    <p>0812-6466-7712</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="container">
        <div class="py-4 text-center">
            <small class="text-white-50">&copy; {{ date('Y') }} Bintang Serasi. All rights reserved.</small>
        </div>
    </div>
    <style>
        /* Hover effect for social media icons */
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #f0f0f0;
            color: #284593;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background-color: #284593;
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Hover effect for navigation links */
        .hover-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .hover-link:hover {
            color: #284593 !important;
        }

        .hover-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #284593;
            transition: width 0.3s ease;
        }

        .hover-link:hover::after {
            width: 100%;
        }
    </style>

    <!-- Script for form handling -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil form dan textarea
            const formSaran = document.getElementById('formSaran');
            const pesanSaran = document.getElementById('pesanSaran');

            // Periksa apakah ada draft tersimpan di localStorage
            const savedDraft = localStorage.getItem('saran_draft');
            if (savedDraft) {
                pesanSaran.value = savedDraft;
            }

            // Simpan draft saat pengguna mengetik
            pesanSaran.addEventListener('input', function() {
                localStorage.setItem('saran_draft', this.value);
            });

            // Tangani submit form
            formSaran.addEventListener('submit', function(e) {
                // Hapus draft dari localStorage jika user sudah login
                @if (Auth::check())
                    localStorage.removeItem('saran_draft');
                    localStorage.removeItem('from_saran');
                @else
                    // Jika belum login, kita tetap menyimpan draft
                    localStorage.setItem('saran_draft', pesanSaran.value);
                @endif
            });

            // Cek apakah user baru saja login dari form saran
            const fromSaran = localStorage.getItem('from_saran');
            if (fromSaran === 'true') {
                // Hapus flag
                localStorage.removeItem('from_saran');

                // Fokus ke textarea
                setTimeout(function() {
                    pesanSaran.focus();
                }, 500);
            }
            //Infromasi toko//
            function updateStatus() {
                const statusElement = document.getElementById('status-operasional');
                if (!statusElement) return;

                const now = new Date();
                const dayIndex = now.getDay();
                const hour = now.getHours();
                const minute = now.getMinutes();
                const currentTime = hour + minute / 60;

                let isOpen = false;

                if (dayIndex === 0) { // Minggu
                    isOpen = (currentTime >= 12 && currentTime < 20);
                } else { // Senin - Sabtu
                    isOpen = (currentTime >= 8 && currentTime < 20);
                }

                const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const today = dayNames[dayIndex];

                const timeFormatted = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                });

                statusElement.innerHTML =
                    `Hari ini: <strong>${today}</strong>, pukul <strong>${timeFormatted}</strong> — ` +
                    (isOpen ?
                        '<span style="color: green;">Sedang Buka</span>' :
                        '<span style="color: red;">Tutup</span>');
            }

            updateStatus();
            setInterval(updateStatus, 60000); // Update tiap 1 menit
        });
    </script>
</footer>
