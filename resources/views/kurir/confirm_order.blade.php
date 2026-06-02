<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan - Dear Seana Kurir</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <style>
        :root {
            --primary: #f06292;
            --primary-dark: #ec407a;
            --secondary: #6d4c41;
            --background: #fffcfd;
            --card-bg: #ffffff;
            --text-main: #4e342e;
            --text-muted: #8d6e63;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--background);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 15px 20px;
            box-shadow: 0 4px 15px rgba(240, 98, 146, 0.25);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            max-width: 700px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: white;
        }

        .logo-small {
            font-family: 'Dancing Script', cursive;
            font-size: 24px;
            color: #fff5f5;
        }

        .btn-back {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: white;
            color: var(--primary-dark);
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 0 20px;
            flex: 1;
        }

        .page-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-title h2 {
            font-size: 28px;
            font-weight: 800;
            color: var(--secondary);
            margin-bottom: 6px;
        }

        .page-title p {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
        .alert-danger  { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }

        /* Detail Card */
        .detail-card {
            background: white;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            border: 1px solid #fce4ec;
            margin-bottom: 20px;
        }

        .order-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #fff5f5, #fce4ec);
            color: var(--secondary);
            border: 1.5px solid #f8bbd0;
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .info-section {
            margin-bottom: 24px;
        }

        .info-section-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-row {
            display: flex;
            margin-bottom: 14px;
            align-items: flex-start;
        }

        .info-label {
            width: 160px;
            flex-shrink: 0;
            font-weight: 700;
            font-size: 13px;
            color: var(--text-muted);
            padding-top: 2px;
        }

        .info-value {
            flex: 1;
            font-weight: 600;
            font-size: 15px;
            color: var(--text-main);
        }

        .divider {
            height: 1.5px;
            background: linear-gradient(90deg, #fce4ec, transparent);
            margin: 20px 0;
        }

        /* Highlight boxes */
        .ongkir-box {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border: 1.5px solid #a5d6a7;
            border-radius: 16px;
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .ongkir-box .label {
            font-size: 14px;
            font-weight: 700;
            color: #2e7d32;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ongkir-box .amount {
            font-size: 20px;
            font-weight: 800;
            color: #1b5e20;
        }

        .total-box {
            background: linear-gradient(135deg, #fff5f5, #fce4ec);
            border: 1.5px solid #f8bbd0;
            border-radius: 16px;
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .total-box .label {
            font-size: 14px;
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .total-box .amount {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-dark);
        }

        /* Action Buttons */
        .action-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-accept {
            flex: 1;
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
            border: none;
            padding: 16px 28px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 5px 18px rgba(76,175,80,0.35);
            transition: all 0.3s;
        }

        .btn-accept:hover {
            box-shadow: 0 8px 25px rgba(76,175,80,0.5);
            filter: brightness(1.06);
            transform: translateY(-2px);
        }

        .btn-reject {
            background: white;
            color: var(--text-muted);
            border: 2px solid #f0cfd6;
            padding: 16px 22px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-reject:hover {
            border-color: var(--primary);
            color: var(--primary-dark);
        }

        /* Warning Box */
        .warning-box {
            background: #fff8e1;
            border: 1.5px solid #ffe082;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 13px;
            font-weight: 600;
            color: #f57f17;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 600;
            border-top: 1px solid #fce4ec;
            background: white;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <a href="{{ route('kurir.orders.pending') }}" class="logo">
                <i class="fas fa-motorcycle"></i>
                <span>Dear Seana <span class="logo-small">Kurir</span></span>
            </a>
            <a href="{{ route('kurir.orders.pending') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </header>

    <div class="container">

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="page-title">
            <h2>🛵 Konfirmasi Pesanan</h2>
            <p>Periksa detail pesanan sebelum Anda menerimanya.</p>
        </div>

        <div class="detail-card">
            <div class="order-badge">
                <i class="fas fa-shopping-bag"></i> Pesanan #{{ $order->id }}
            </div>

            <div class="info-section">
                <div class="info-section-title">
                    <i class="fas fa-user-circle"></i> Data Pelanggan
                </div>
                <div class="info-row">
                    <div class="info-label">Nama</div>
                    <div class="info-value" style="font-size:17px; font-weight:800; color:var(--secondary)">
                        {{ $order->nama_pelanggan }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. WhatsApp</div>
                    <div class="info-value">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->no_wa) }}" target="_blank"
                           style="color: #25D366; font-weight:700; text-decoration:none; display:flex; align-items:center; gap:5px;">
                            <i class="fab fa-whatsapp"></i> {{ $order->no_wa }}
                        </a>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Metode Bayar</div>
                    <div class="info-value">{{ $order->metode_pembayaran }}</div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="info-section">
                <div class="info-section-title">
                    <i class="fas fa-map-marker-alt"></i> Alamat Pengantaran
                </div>
                <div style="background: #f8f4f2; border-radius: 12px; padding: 15px 18px; font-size:15px; font-weight:600; color:var(--text-main); line-height:1.6; margin-bottom: 15px;">
                    {{ $order->alamat }}
                </div>
                
                <!-- Map Container -->
                <div id="map-container" style="border-radius: 12px; overflow: hidden; border: 1px solid #fce4ec; position: relative; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                    <div id="map" style="height: 250px; width: 100%; z-index: 1;"></div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="info-section">
                <div class="info-section-title">
                    <i class="fas fa-receipt"></i> Ringkasan Pembayaran
                </div>

                <div class="ongkir-box">
                    <span class="label"><i class="fas fa-truck"></i> Ongkos Kirim (untukmu)</span>
                    <span class="amount" id="ongkir-amount">Rp {{ number_format($order->ongkir ?? 0, 0, ',', '.') }}</span>
                </div>

                <div class="total-box">
                    <span class="label"><i class="fas fa-money-bill-wave"></i> Total Pembayaran Pelanggan</span>
                    <span class="amount">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="warning-box">
                <i class="fas fa-exclamation-triangle" style="margin-top:1px;"></i>
                <div>Dengan menekan <strong>"Terima Pesanan"</strong>, pesanan ini akan dikunci untukmu dan tidak bisa diambil kurir lain. Pastikan kamu siap mengantarkan pesanan ini.</div>
            </div>

            <div class="action-row">
                <form method="POST" action="{{ route('kurir.order.accept', ['order' => $order->id]) }}" style="flex:1;">
                    @csrf
                    <button type="submit" class="btn-accept" style="width:100%;">
                        <i class="fas fa-check-circle"></i> Terima Pesanan Ini
                    </button>
                </form>
                <a href="{{ route('kurir.orders.pending') }}" class="btn-reject">
                    <i class="fas fa-times"></i> Lewati
                </a>
            </div>
        </div>

    </div>

    <footer>
        &copy; 2026 Dear Seana Kurir Panel. Keajaiban Rasa Dalam Setiap Sematan.
    </footer>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    
    <script>
        const RESTO_LAT = -6.1872;
        const RESTO_LNG = 106.8491;

        document.addEventListener('DOMContentLoaded', function() {
            const mapContainer = document.getElementById('map');
            if (!mapContainer) return;

            const mapInstance = L.map('map').setView([RESTO_LAT, RESTO_LNG], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(mapInstance);

            const alamat = {!! json_encode($order->alamat) !!};

            // Forward Geocoding via Nominatim
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(alamat)}&limit=1`)
                .then(response => response.json())
                .then(data => {
                    let destLat = RESTO_LAT;
                    let destLng = RESTO_LNG;

                    if (data && data.length > 0) {
                        destLat = parseFloat(data[0].lat);
                        destLng = parseFloat(data[0].lon);
                    }

                    L.Routing.control({
                        waypoints: [
                            L.latLng(RESTO_LAT, RESTO_LNG),
                            L.latLng(destLat, destLng)
                        ],
                        routeWhileDragging: false,
                        showAlternatives: false,
                        fitSelectedRoutes: true,
                        show: false,
                        createMarker: function(i, wp) {
                            if (i === 0) {
                                return L.marker(wp.latLng, {
                                    draggable: false,
                                    icon: L.icon({
                                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                        iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34]
                                    })
                                }).bindPopup("Toko: Sweet & Savory Seana");
                            } else {
                                return L.marker(wp.latLng, {
                                    draggable: false,
                                    icon: L.icon({
                                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                        iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34]
                                    })
                                }).bindPopup("Tujuan Pengantaran");
                            }
                        },
                        lineOptions: {
                            styles: [{color: '#4caf50', opacity: 0.8, weight: 6}]
                        }
                    }).addTo(mapInstance);
                })
                .catch(err => {
                    console.error("Geocoding failed", err);
                });
        });
    </script>
</body>
</html>
