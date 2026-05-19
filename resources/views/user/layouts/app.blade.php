<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dear Seana - Keajaiban Rasa Dalam Setiap Sematan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Titan+One&family=Dancing+Script:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <meta name="description" content="Dear Seana menyediakan berbagai macam kue coklat, puding, dan roti premium.">
    <!-- Midtrans Snap JS -->
    @if(config('services.midtrans.is_production'))
        <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    @else
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    @endif
    
    <!-- Custom Style Lonceng Notifikasi Status Pesanan -->
    <style>
        .notification-dropdown-wrapper {
            position: relative;
        }
        #notificationBellBtn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #notificationBellBtn:hover {
            transform: scale(1.08) rotate(5deg);
            background: #ffebee !important;
            color: #d32f2f !important;
            box-shadow: 0 6px 15px rgba(229, 115, 115, 0.3) !important;
        }
        #notificationBellBtn:active {
            transform: scale(0.92);
        }
        .notification-item-link {
            display: flex; 
            gap: 14px; 
            padding: 14px 16px; 
            border-bottom: 1px solid #fce4ec; 
            text-decoration: none; 
            color: inherit; 
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); 
            margin: 8px 12px; 
            border-radius: 16px; 
            border: 1px solid rgba(229,115,115,0.05); 
            box-shadow: 0 4px 10px rgba(0,0,0,0.01);
        }
        .notification-item-link:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 6px 18px rgba(229, 115, 115, 0.1) !important;
            filter: brightness(0.98);
        }
        /* Custom Scrollbar */
        .notification-scrollable::-webkit-scrollbar {
            width: 6px;
        }
        .notification-scrollable::-webkit-scrollbar-track {
            background: transparent;
        }
        .notification-scrollable::-webkit-scrollbar-thumb {
            background: #f8bbd0;
            border-radius: 10px;
        }
        .notification-scrollable::-webkit-scrollbar-thumb:hover {
            background: #f06292;
            border-radius: 10px;
        }
        .notification-scrollable::-webkit-scrollbar-thumb:hover {
            background: #f06292;
        }

        /* Custom Premium Toast Pop-up */
        .toast-container {
            position: fixed;
            top: 25px;
            right: 25px;
            z-index: 999999;
            display: flex;
            flex-direction: column;
            gap: 15px;
            pointer-events: none;
        }
        .toast-card {
            pointer-events: auto;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 20px 24px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            width: 385px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transform: translateX(130%);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        .toast-card.show {
            transform: translateX(0);
            opacity: 1;
        }
        
        /* Progress Bar Animation */
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 100%;
            background: rgba(0, 0, 0, 0.05);
        }
        .toast-progress-bar {
            height: 100%;
            width: 100%;
            transition: width 8s linear;
        }

        @keyframes bounceNotif {
            0% { transform: translateY(0); }
            100% { transform: translateY(-3px); }
        }
    </style>
</head>

<body>
    <!-- Topbar -->
    <div class="topbar container">
        <div class="logo-container">
            <div class="logo-sweet">SWEET & SAVORY</div>
            <a href="/" class="logo-group">
                <span class="logo-dear">
                    <span style="color: #D5BCCC;">D</span>
                    <span style="color: #C1D0AA;">e</span>
                    <span style="color: #EBE5B5;">a</span>
                    <span style="color: #E8BC85;">r</span>
                </span>
                <span class="logo-seana">Seana</span>
            </a>
        </div>
        <div class="topbar-right" style="gap: 2rem;">
            <ul class="nav-links">
                <li><a href="{{ route('beranda') }}">Home</a></li>
                <li><a href="{{ route('menu') }}">Menu</a></li>
                <li><a href="{{ route('our_story') }}">Our Story</a></li>
                <li><a href="{{ route('katering') }}">Katering</a></li>
                @auth
                    @if(Auth::user()->role === 'kurir')
                        <li><a href="{{ route('kurir.dashboard') }}" style="color: #f06292; font-weight: 700;"><i class="fas fa-motorcycle"></i> Dashboard Kurir</a></li>
                    @else
                        <li><a href="{{ route('pesanan_saya') }}" style="color: #f06292; font-weight: 700;"><i class="fas fa-shopping-bag"></i> Pesanan Saya</a></li>
                    @endif
                @endauth
            </ul>
            <div style="display: flex; align-items: center; gap: 15px;">
                @auth
                    <!-- Tombol Profil -->
                    <a href="{{ route('profil.index') }}" title="Profil Saya" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: #fce4ec; color: #f06292; font-size: 1.2rem; transition: all 0.3s; text-decoration: none; box-shadow: 0 4px 10px rgba(240, 98, 146, 0.2);">
                        <i class="fas fa-user"></i>
                    </a>

                    <!-- Lonceng Notifikasi Status Pesanan -->
                    @php
                        $active_notification_count = \App\Models\Order::where('user_id', auth()->id())
                            ->whereIn('status', ['baru', 'disiapkan', 'dikirim'])
                            ->count();
                    @endphp
                    
                    <a href="{{ route('notifikasi') }}" id="notificationBellBtn" title="Notifikasi Status Pesanan" style="position: relative; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: #fff5f5; color: #e57373; font-size: 1.2rem; border: none; text-decoration: none; box-shadow: 0 4px 10px rgba(229, 115, 115, 0.15);">
                        <i class="fas fa-bell"></i>
                        @if($active_notification_count > 0)
                            <span class="notification-badge" style="position: absolute; top: -5px; right: -5px; display: flex; align-items: center; justify-content: center; min-width: 18px; height: 18px; padding: 0 4px; border-radius: 50%; background: #e57373; color: white; font-size: 10px; font-weight: 800; border: 2px solid white;">
                                {{ $active_notification_count }}
                            </span>
                        @endif
                    </a>
                @endauth

                <!-- Tombol Pesan Sekarang -->
                <a href="https://wa.me/{{ $global_setting->wa_number ?? '6281234567890' }}?text=Halo%20Dear%20Seana,%20saya%20tertarik%20dengan%20koleksi%20kue%20Anda."
                    target="_blank" class="btn-pesan" style="display:flex; align-items:center; gap:8px;"><i
                        class="fab fa-whatsapp" style="font-size:1.1rem;"></i> Pesan Sekarang</a>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="footer-crumbl">
        <div class="footer-socials">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-pinterest-p"></i></a>
        </div>
        <div class="footer-bottom">
            <h1 class="giant-logo">Dear Seana</h1>
            <div class="footer-legal">
                <p>&copy; 2026 semua hak dilindungi undang-undang. | Data peta &copy; Kontributor OpenStreetMap</p>
                <div class="legal-links">
                    <a href="#">Kebijakan privasi</a> | 
                    <a href="#">Syarat dan Ketentuan</a> | 
                    <a href="#">Syarat dan Ketentuan Kartu Hadiah/Voucher</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    @auth
    <!-- Container untuk Toast Pop-up -->
    <div id="toastContainer" class="toast-container"></div>
    
    <!-- Script Real-Time Background Checking (Opsi A) -->
    <script>
        function launchConfettiShower() {
            const duration = 3.5 * 1000;
            const animationEnd = Date.now() + duration;
            const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 1000000 };

            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }

            const interval = setInterval(function() {
                const timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }

                const particleCount = 50 * (timeLeft / duration);
                confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
                confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
            }, 250);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Cek jika baru saja menyelesaikan pembayaran sukses
            if (sessionStorage.getItem('payment_success_confetti') === 'true') {
                sessionStorage.removeItem('payment_success_confetti');
                setTimeout(launchConfettiShower, 600);
            }

            // Dapatkan map status pesanan dari sessionStorage
            let orderStatusMap = JSON.parse(sessionStorage.getItem('orderStatusMap')) || {};
            let isFirstLoad = Object.keys(orderStatusMap).length === 0;

            function playChimeSound() {
                try {
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    if (!AudioContext) return;
                    const ctx = new AudioContext();
                    
                    // Main tone (Chime)
                    const osc1 = ctx.createOscillator();
                    const gain1 = ctx.createGain();
                    osc1.type = 'sine';
                    osc1.frequency.setValueAtTime(880, ctx.currentTime); // A5 (high sweet pitch)
                    osc1.frequency.exponentialRampToValueAtTime(1760, ctx.currentTime + 0.1); // Sweet slide up
                    
                    gain1.gain.setValueAtTime(0.12, ctx.currentTime);
                    gain1.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.7); // Smooth decay
                    
                    osc1.connect(gain1);
                    gain1.connect(ctx.destination);
                    osc1.start();
                    osc1.stop(ctx.currentTime + 0.7);
                    
                    // Second tone (harmonics / delayed ding)
                    setTimeout(() => {
                        const osc2 = ctx.createOscillator();
                        const gain2 = ctx.createGain();
                        osc2.type = 'sine';
                        osc2.frequency.setValueAtTime(1320, ctx.currentTime); // E6
                        osc2.frequency.exponentialRampToValueAtTime(2640, ctx.currentTime + 0.08);
                        
                        gain2.gain.setValueAtTime(0.08, ctx.currentTime);
                        gain2.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.5);
                        
                        osc2.connect(gain2);
                        gain2.connect(ctx.destination);
                        osc2.start();
                        osc2.stop(ctx.currentTime + 0.5);
                    }, 100);
                } catch(e) {
                    console.log('Audio playback error:', e);
                }
            }

            function checkOrderStatuses() {
                fetch('{{ route("order_status_check") }}')
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.json();
                    })
                    .then(orders => {
                        let updatedMap = {};
                        orders.forEach(order => {
                            updatedMap[order.id] = order.status;
                            
                            // Jika bukan loading pertama, dan status lamanya ada tapi berubah
                            if (!isFirstLoad && orderStatusMap[order.id] && orderStatusMap[order.id] !== order.status) {
                                triggerToastNotification(order.id, order.status);
                            }
                        });
                        orderStatusMap = updatedMap;
                        sessionStorage.setItem('orderStatusMap', JSON.stringify(orderStatusMap));
                        isFirstLoad = false;
                    })
                    .catch(err => console.log('Checking status error:', err));
            }

            function triggerToastNotification(orderId, status) {
                playChimeSound(); // Bunyikan lonceng manis!
                
                const container = document.getElementById('toastContainer');
                if (!container) return;

                const toast = document.createElement('div');
                toast.className = 'toast-card';
                
                let icon = '📦';
                let title = 'Status Pesanan Terupdate';
                let desc = `Pesanan Kue #${orderId} Anda telah mengalami perubahan status.`;
                let progressColor = '#f06292';
                let glowColor = 'rgba(240, 98, 146, 0.25)';
                
                if (status === 'baru') {
                    icon = '⏳';
                    title = 'Menunggu Pembayaran';
                    desc = `Pesanan #${orderId} sukses dibuat. Silakan selesaikan pembayaran di simulator agar adonan dapat diproses.`;
                    progressColor = '#fbc02d';
                    glowColor = 'rgba(251, 192, 45, 0.25)';
                } else if (status === 'disiapkan') {
                    icon = '🥣';
                    title = 'Kue Sedang Dibuat! 🎂';
                    desc = `Chef terbaik kami sedang mengemas dan membuat adonan kue lezat pesanan #${orderId} Anda dengan higienis!`;
                    progressColor = '#e91e63';
                    glowColor = 'rgba(233, 30, 99, 0.25)';
                } else if (status === 'dikirim') {
                    icon = '🛵';
                    title = 'Pesanan Dikirim! 🚀';
                    desc = `Kue manis pesanan #${orderId} Anda sedang diantar kurir ke alamat tujuan. Bersiap-siap ya!`;
                    progressColor = '#2196f3';
                    glowColor = 'rgba(33, 150, 243, 0.25)';
                } else if (status === 'selesai') {
                    icon = '✅';
                    title = 'Pesanan Selesai! ❤️';
                    desc = `Terima kasih! Pesanan #${orderId} Anda telah sukses diterima. Selamat menikmati hidangan manis kami!`;
                    progressColor = '#4caf50';
                    glowColor = 'rgba(76, 175, 80, 0.25)';
                } else if (status === 'dibatalkan') {
                    icon = '❌';
                    title = 'Pesanan Dibatalkan';
                    desc = `Pesanan #${orderId} Anda telah dibatalkan oleh pihak toko.`;
                    progressColor = '#f44336';
                    glowColor = 'rgba(244, 67, 54, 0.25)';
                }
                
                toast.style.boxShadow = `0 15px 40px ${glowColor}`;
                toast.style.borderLeft = `6px solid ${progressColor}`;
                toast.innerHTML = `
                    <div style="font-size: 32px; background: #fff5f5; border-radius: 16px; width: 56px; height: 56px; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 15px rgba(0,0,0,0.03); flex-shrink: 0; animation: bounceNotif 1s infinite alternate;">
                        ${icon}
                    </div>
                    <div style="flex: 1; padding-right: 8px;">
                        <div style="font-weight: 900; font-size: 16px; color: #6d4c41; margin-bottom: 4px;">${title}</div>
                        <div style="font-size: 13.5px; color: #8d6e63; line-height: 1.5; font-weight: 600;">${desc}</div>
                    </div>
                    <button onclick="this.parentElement.remove()" style="background: rgba(0,0,0,0.04); border: none; font-size: 18px; color: #bcaaa4; cursor: pointer; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s; flex-shrink: 0;" onmouseover="this.style.background='#ffebee'; this.style.color='#f06292'" onmouseout="this.style.background='rgba(0,0,0,0.04)'; this.style.color='#bcaaa4'">&times;</button>
                    <div class="toast-progress">
                        <div class="toast-progress-bar" id="progressBar-${orderId}" style="background: ${progressColor}; width: 100%;"></div>
                    </div>
                `;
                
                toast.addEventListener('click', function(e) {
                    if (e.target.tagName.toLowerCase() === 'button' || e.target.closest('button')) {
                        return;
                    }
                    window.location.href = '{{ route("notifikasi") }}';
                });

                container.appendChild(toast);
                
                // Pemicu animasi slide-in
                setTimeout(() => toast.classList.add('show'), 150);
                
                // Pemicu linear progress bar menyusut
                setTimeout(() => {
                    const pBar = document.getElementById(`progressBar-${orderId}`);
                    if (pBar) pBar.style.width = '0%';
                }, 200);
                
                // Otomatis hilangkan dalam 8 detik
                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => toast.remove(), 600);
                }, 8000);
            }

            // Jalankan poller pemeriksaan pertama kali dan ulangi setiap 12 detik
            checkOrderStatuses();
            setInterval(checkOrderStatuses, 12000);
        });
    </script>
    @endauth

    @stack('scripts')
</body>

</html>
