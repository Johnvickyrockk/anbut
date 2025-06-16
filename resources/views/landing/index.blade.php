<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Calci Shoes Care</title>
    <link rel="stylesheet" href="{{ asset('/LandingPage/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#home">Calci Shoes Care</a>
            </div>
            <button class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </button>
            <ul id="nav-links" class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#tracking">Tracking</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="/login">Login</a></li>
                <li>
                    <a href="/cart">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Cuci Sepatu Modern, Bersih dan Profesional</h1>
            <p>Percayakan kebersihan sepatu Anda kepada ahli kami. Layanan cuci sepatu cepat dan terpercaya.</p>
        </div>
        <div class="hero-image slideshow-container">
            <!-- Slides -->
            <div class="slide fade">
                <img src="{{ asset('/LandingPage/image/cucisepatu1.jpg') }}" alt="Sepatu Bersih 1">
            </div>
            <div class="slide fade">
                <img src="{{ asset('/LandingPage/image/cucisepatu2.jpg') }}" alt="Sepatu Bersih 2">
            </div>
            <div class="slide fade">
                <img src="{{ asset('/LandingPage/image/cucisepatu3.jpg') }}" alt="Sepatu Bersih 3">
            </div>
            <div class="slide fade">
                <img src="{{ asset('/LandingPage/image/cucisepatu4.jpg') }}" alt="Sepatu Bersih 4">
            </div>
        </div>
    </section>

 <!-- Promo Section -->
<!-- Promo Section -->
<!-- Promo Section -->
<section id="promo" class="promo-section">
    <div class="container">
        <h2>Promo Terbaru</h2>
        @if($promotions->count() > 0)
            <div class="promo-container">
                @foreach($promotions as $promotion)
                <div class="promo-banner">
                    <div class="promo-content">
                        <h3>{{ $promotion->name }}</h3>
                        <div class="promo-info">
                            <span class="discount">{{ $promotion->discount }}% OFF</span>
                            <span class="promo-code">Kode: {{ $promotion->code }}</span>
                        </div>
                        <div class="promo-dates">
                            <span>Berlaku hingga {{ $promotion->end_date->format('d M Y') }}</span>
                            <span>Min. Pembayaran Rp {{ number_format($promotion->min_payment, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="no-active-promo">
                <i class="fas fa-exclamation-circle"></i>
                <p>Tidak ada Promo Yang Aktif Hari Ini</p>
            </div>
        @endif
    </div>
</section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2>About Us</h2>
            <p>Cuci Sepatu adalah layanan cuci sepatu modern yang mengutamakan kualitas dan kepuasan pelanggan. Kami
                menggunakan teknologi dan produk pembersih terbaik untuk memastikan sepatu Anda bersih, wangi, dan
                terlindungi. Dengan tim profesional, kami siap memberikan hasil terbaik untuk sepatu kesayangan Anda.
            </p>
            <p>Jangan biarkan sepatu kotor merusak gaya Anda. Percayakan kebersihan sepatu Anda kepada kami dan rasakan
                perbedaannya!</p>
        </div>
    </section>

    <!-- Services Section -->
<section id="services" class="services-section">
    <div class="container">
        <h2>Layanan Kami</h2>
        <p class="description-first">
            Kami menawarkan layanan perawatan dan pembersihan sepatu terbaik untuk menjaga penampilan dan kualitas sepatu Anda. 
            Setiap layanan dirancang untuk memenuhi kebutuhan spesifik Anda dan memastikan kepuasan maksimal.
        </p>

        <!-- Fast Cleaning -->
        <div class="service-category">
            <h3>Fast Cleaning</h3>
            <div class="subcategory-container">
                <div class="subcategory-item">
                    <strong>Reguler</strong>
                    <p>Pembersihan cepat untuk sepatu harian</p>
                    <span class="price">Rp 30.000</span>
                    <form action="/cart/add" method="POST" style="margin-top:10px;">
                        @csrf
                        <input type="hidden" name="id" value="1">
                        <input type="hidden" name="name" value="Fast Cleaning - Reguler">
                        <input type="hidden" name="category" value="Fast Cleaning">
                        <input type="hidden" name="price" value="30000">
                        <label for="quantity_1">Jumlah:</label>
                        <input type="number" id="quantity_1" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                </div>
                <div class="subcategory-item">
                    <strong>Outsole</strong>
                    <p>Pembersihan khusus bagian outsole</p>
                    <span class="price">Rp 50.000</span>
                    <form action="/cart/add" method="POST" style="margin-top:10px;">
                        @csrf
                        <input type="hidden" name="id" value="2">
                        <input type="hidden" name="name" value="Fast Cleaning - Outsole">
                        <input type="hidden" name="category" value="Fast Cleaning">
                        <input type="hidden" name="price" value="50000">
                        <label for="quantity_2">Jumlah:</label>
                        <input type="number" id="quantity_2" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Deep Cleaning -->
        <div class="service-category">
            <h3>Deep Cleaning</h3>
            <div class="subcategory-container">
                <div class="subcategory-item">
                    <strong>Mid</strong>
                    <p>Pembersihan mendalam tingkat menengah</p>
                    <span class="price">Rp 60.000</span>
                    <form action="/cart/add" method="POST" style="margin-top:10px;">
                        @csrf
                        <input type="hidden" name="id" value="3">
                        <input type="hidden" name="name" value="Deep Cleaning - Mid">
                        <input type="hidden" name="category" value="Deep Cleaning">
                        <input type="hidden" name="price" value="60000">
                        <label for="quantity_3">Jumlah:</label>
                        <input type="number" id="quantity_3" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                </div>
                <div class="subcategory-item">
                    <strong>Reguler</strong>
                    <p>Pembersihan mendalam standar</p>
                    <span class="price">Rp 80.000</span>
                    <form action="/cart/add" method="POST" style="margin-top:10px;">
                        @csrf
                        <input type="hidden" name="id" value="4">
                        <input type="hidden" name="name" value="Deep Cleaning - Reguler">
                        <input type="hidden" name="category" value="Deep Cleaning">
                        <input type="hidden" name="price" value="80000">
                        <label for="quantity_4">Jumlah:</label>
                        <input type="number" id="quantity_4" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                </div>
                <div class="subcategory-item">
                    <strong>Hard</strong>
                    <p>Pembersihan menyeluruh untuk noda membandel</p>
                    <span class="price">Rp 160.000</span>
                    <form action="/cart/add" method="POST" style="margin-top:10px;">
                        @csrf
                        <input type="hidden" name="id" value="5">
                        <input type="hidden" name="name" value="Deep Cleaning - Hard">
                        <input type="hidden" name="category" value="Deep Cleaning">
                        <input type="hidden" name="price" value="160000">
                        <label for="quantity_5">Jumlah:</label>
                        <input type="number" id="quantity_5" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Repaint -->
        <div class="service-category">
            <h3>Repaint (Hanya untuk sepatu berwarna)</h3>
            <div class="subcategory-container">
                <div class="subcategory-item">
                    <strong>Soft</strong>
                    <p>Pewarnaan ulang ringan untuk memperbaiki tampilan</p>
                    <span class="price">Rp 200.000</span>
                    <form action="/cart/add" method="POST" style="margin-top:10px;">
                        @csrf
                        <input type="hidden" name="id" value="6">
                        <input type="hidden" name="name" value="Repaint - Soft">
                        <input type="hidden" name="category" value="Repaint">
                        <input type="hidden" name="price" value="200000">
                        <label for="quantity_6">Jumlah:</label>
                        <input type="number" id="quantity_6" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                </div>
                <div class="subcategory-item">
                    <strong>Medium</strong>
                    <p>Pewarnaan ulang sedang untuk warna yang mulai pudar</p>
                    <span class="price">Rp 250.000</span>
                    <form action="/cart/add" method="POST" style="margin-top:10px;">
                        @csrf
                        <input type="hidden" name="id" value="7">
                        <input type="hidden" name="name" value="Repaint - Medium">
                        <input type="hidden" name="category" value="Repaint">
                        <input type="hidden" name="price" value="250000">
                        <label for="quantity_7">Jumlah:</label>
                        <input type="number" id="quantity_7" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                </div>
                <div class="subcategory-item">
                    <strong>Hard</strong>
                    <p>Pewarnaan total untuk sepatu sangat kusam</p>
                    <span class="price">Rp 300.000</span>
                    <form action="/cart/add" method="POST" style="margin-top:10px;">
                        @csrf
                        <input type="hidden" name="id" value="8">
                        <input type="hidden" name="name" value="Repaint - Hard">
                        <input type="hidden" name="category" value="Repaint">
                        <input type="hidden" name="price" value="300000">
                        <label for="quantity_8">Jumlah:</label>
                        <input type="number" id="quantity_8" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="submit">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Tracking Timeline Section -->
    <section id="tracking" class="tracking-section">
        <div class="container">
            <h2>Lacak Sepatu Anda</h2>
            <p>Masukkan kode pesanan Anda di bawah ini untuk melacak status layanan sepatu Anda:</p>
            <div class="tracking-form">
                <form id="trackingForm">
                    <div class="form-group">
                        <input type="text" id="trackingCode" name="trackingCode"
                            placeholder="Masukkan Kode Pesanan Anda">
                    </div>
                    <button type="submit" class="cta-button">Lacak Pesanan</button>
                </form>
            </div>

            <!-- Error Message -->
            <div id="errorMessage" class="alert alert-danger" style="display: none;">
                Kode pesanan tidak ditemukan. Pastikan Anda memasukkan kode yang benar.
            </div>

            <div id="trackingCodeInfo"
                style="display: none; font-size: 18px; font-weight: bold; margin-bottom: 20px;">
                Kode Tracking: <span id="trackingCodeDisplay"></span>
            </div>

            <!-- Timeline Section (Initially Hidden) -->
            <div id="timelineSection" class="timeline-modern" style="display: none;">
                <div id="timelineContent">
                    <!-- Status will be appended here -->
                </div>
                <button id="closeTimeline" class="cta-button" style="margin-top: 20px;">Tutup Timeline</button>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2>Hubungi Kami</h2>
            <p>Untuk memberikan saran atau kritik mengenai layanan kami, silakan isi form di samping atau kunjungi
                lokasi kami yang tertera pada peta di bawah ini.</p>

            <div class="contact-wrapper">
                <!-- Form Kontak -->
                <div class="contact-form">
                    <form id="adviceForm">
                        <input type="hidden" id="adviceRoute" value="/advice">
                        <div class="form-group" id="name-group">
                            <label for="nama">Nama Anda</label>
                            <input type="text" id="nama" name="nama" placeholder="Nama Anda"
                                autocomplete="off">
                        </div>
                        <div class="form-group" id="email-group">
                            <label for="email">Email Anda</label>
                            <input type="email" id="email" name="email" placeholder="Email Anda"
                                autocomplete="off">
                        </div>
                        <div class="form-group" id="advice-group">
                            <label for="advice">Saran/Kritik</label>
                            <textarea id="advice" name="advice" rows="5" placeholder="Tulis saran atau kritik Anda di sini"
                                autocomplete="off"></textarea>
                        </div>
                        <button type="submit" class="cta-button">Kirim Saran/Kritik</button>
                    </form>
                </div>

                <!-- Informasi Kontak -->
                <div class="contact-info">
                    <div id="map" class="maplp" style="height: 200px;"></div>
                    <p style="text-align: justify;">
                        <i class="fas fa-map-marker-alt"></i> Jl. Contoh No. 123, Jakarta
                    </p>
                    <p><i class="fas fa-phone-alt"></i> 0812-3456-7890</p>
                    <p><i class="fas fa-envelope"></i> info@calcishoescare.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <h3 class="footer-logo">Calci Shoes Care</h3>
                <p class="footer-description">Layanan cuci sepatu profesional dengan hasil maksimal.</p>
                <div class="social-icons">
                    <a href="#" target="_blank" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" target="_blank" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" target="_blank" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" target="_blank" aria-label="Tiktok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 Calci Shoes Care. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <button id="backToTop"><i class="fas fa-arrow-up"></i></button>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="{{ asset('/LandingPage/js/scripts.js') }}"></script>
    
    <script>
        // Simple form submission handler
        document.getElementById('adviceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Terima kasih!',
                text: 'Saran/kritik Anda telah berhasil dikirim.',
                confirmButtonText: 'OK'
            });
            this.reset();
        });

        // Tracking form handler
        document.getElementById('trackingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const trackingCode = document.getElementById('trackingCode').value;
            
            if (!trackingCode) {
                document.getElementById('errorMessage').style.display = 'block';
                return;
            }
            
            // Simulate tracking
            document.getElementById('trackingCodeDisplay').textContent = trackingCode;
            document.getElementById('trackingCodeInfo').style.display = 'block';
            document.getElementById('errorMessage').style.display = 'none';
            
            // Simulate timeline content
            const timelineContent = document.getElementById('timelineContent');
            timelineContent.innerHTML = `
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="timeline-content">
                        <h4>Status: Pesanan Diterima</h4>
                        <p>Pesanan Anda telah diterima dan sedang diproses</p>
                        <span><i class="fas fa-calendar-alt"></i> 15 Juni 2024 <i class="fas fa-clock"></i> 10:30</span>
                    </div>
                </div>
            `;
            
            document.getElementById('timelineSection').style.display = 'block';
        });

        // Close timeline
        document.getElementById('closeTimeline').addEventListener('click', function() {
            document.getElementById('timelineSection').style.display = 'none';
            document.getElementById('trackingCodeInfo').style.display = 'none';
            document.getElementById('trackingCode').value = '';
        });

        // Initialize map
        function initMap() {
            var map = L.map('map').setView([-6.2088, 106.8456], 13); // Jakarta coordinates
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            L.marker([-6.2088, 106.8456]).addTo(map)
                .bindPopup('Calci Shoes Care')
                .openPopup();
        }

        // Initialize map when page loads
        window.addEventListener('load', initMap);

        // Back to top button
        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                document.getElementById("backToTop").style.display = "block";
            } else {
                document.getElementById("backToTop").style.display = "none";
            }
        };

        document.getElementById("backToTop").addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Mobile menu toggle
        document.getElementById('hamburger').addEventListener('click', function() {
            document.getElementById('nav-links').classList.toggle('active');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>