<footer class="pt-5" style="background-color: #0d3b66; color: white;">
    <div class="container">
        <div class="row g-4">
            <!-- MAP & INFO -->
            <div class="col-md-6">
                <h5 class="fw-bold mb-3">📍 Lokasi Bintang Serasi</h5>
                <div class="rounded overflow-hidden shadow-sm mb-2">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.509434915169!2d99.05741557581437!3d2.3336297576225076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e05c85050a295%3A0x8b693c398e4b46c7!2sToko%20Bintang%20Serasi!5e0!3m2!1sid!2sid!4v1743911151567!5m2!1sid!2sid" 
                        width="100%" 
                        height="250" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <p class="text-white-50 small mb-0">
                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> Lokasi kami sudah ditandai dengan ikon merah di peta.
                </p>
            </div>

            <!-- SARAN FORM -->
            <div class="col-md-6">
                <h5 class="fw-bold mb-2">💡 Saran & Masukan</h5>
                <p class="text-white-50">Bantu kami berkembang dengan memberikan saran terbaik Anda.</p>
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="saran" class="form-control rounded-3 shadow-sm border-0" placeholder="Masukkan saran anda..." required>
                    </div>
                    <div class="mb-3">
                        <textarea name="pesan" rows="3" class="form-control rounded-3 shadow-sm border-0" placeholder="Ketikkan pesan anda..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-light fw-semibold px-4 rounded-pill">Kirim</button>
                </form>
            </div>
        </div>

        <!-- Divider -->
        <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">

        <!-- LINK & SOSMED -->
        <div class="row text-center text-md-start align-items-center">
            <div class="col-md-6 mb-3">
                <h6 class="fw-bold text-white mb-3">⭐ Bintang Serasi</h6>
                <ul class="list-unstyled small">
                    <li><a href="/" class="text-white text-decoration-none d-block mb-1">Beranda</a></li>
                    <li><a href="/katalog" class="text-white text-decoration-none d-block mb-1">Katalog</a></li>
                    <li><a href="/wishlist" class="text-white text-decoration-none d-block mb-1">Wishlist</a></li>
                    <li><a href="/profil-toko" class="text-white text-decoration-none d-block mb-1">Profil Toko</a></li>
                </ul>
            </div>

            <div class="col-md-6">
                <h6 class="fw-bold text-white mb-3">🌐 Terhubung dengan kami</h6>
                <div class="d-flex justify-content-center justify-content-md-start gap-3">
                    <a href="#" class="text-white fs-4 hover-social"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-4 hover-social"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-4 hover-social"><i class="bi bi-envelope-fill"></i></a>
                </div>
            </div>
        </div>

        <!-- COPYRIGHT -->
        <div class="text-center mt-4 pt-3 border-top border-light-subtle small" style="color: rgba(255,255,255,0.6);">
            &copy; {{ date('Y') }} Bintang Serasi. All rights reserved.
        </div>
    </div>

    <!-- Efek Hover Sosial Media -->
    <style>
        .hover-social {
            transition: color 0.4s ease, transform 0.4s ease;
        }

        .hover-social:hover {
            color: #ffdd95 !important; /* Warna lembut: pastel gold */
            transform: translateY(-4px); /* Geser sedikit ke atas dengan lembut */
        }
    </style>
</footer>
