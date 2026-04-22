@extends('user.layouts.app')

@section('content')
    <!-- Journey Section -->
    <div class="journey-wrapper" style="margin-top: 5rem; padding-bottom: 5rem;">
        <!-- Part 1 -->
        <section class="journey-section fade-in-on-scroll">
            <div class="container journey-grid">
                <div class="journey-img-box">
                </div>
                <div class="journey-text">
                    <h2>Tentang Kami</h2>
                    <p>Sejak 2017, Dear Seana hadir dengan berbagai hidangan manis dan gurih yang memanjakan lidah. Kami menggunakan bahan berkualitas dan resep istimewa untuk memberikan pengalaman kuliner yang memuaskan. Setiap sajian kami dibuat dengan penuh cinta, untuk Anda yang mencari kenikmatan dalam setiap gigitan. Terima kasih telah menjadi bagian dari perjalanan kami!</p>
                </div>
            </div>
        </section>

        <!-- Part 2 -->
        <section class="journey-section bg-lite fade-in-on-scroll">
            <div class="container journey-grid">
                <div class="journey-text">
                    <h2>Visi</h2>
                    <p style="font-style: italic; font-size: 1.3rem;">“ Menjadi toko kue dan roti terdepan yang membawa kebahagiaan dan kelezatan ke setiap rumah, menyempurnakan setiap momen dengan cita rasa terbaik. ”</p>
                </div>
                <div class="journey-img-box">
                </div>
            </div>
        </section>

        <!-- Part 3 -->
        <section class="journey-section fade-in-on-scroll">
            <div class="container journey-grid">
                <div class="journey-img-box">
                </div>
                <div class="journey-text">
                    <h2>Misi</h2>
                    <p>• Menghadirkan produk berkualitas tinggi dengan bahan-bahan alami dan tanpa pengawet.</p>
                    <p>• Memberikan pengalaman pelanggan yang hangat dan personal, seperti keluarga.</p>
                </div>
            </div>
        </section>

        <!-- Part 4 - Keunggulan -->
        <section class="journey-section bg-lite fade-in-on-scroll">
            <div class="container">
                <div class="keunggulan-header">
                    <h2>Keunggulan</h2>
                    <p>Kami berkomitmen untuk menyajikan produk kue dan roti yang terbaik dengan mengutamakan kualitas di setiap proses pembuatannya. Berikut adalah beberapa keunggulan yang membedakan produk kami:</p>
                </div>
                <div class="keunggulan-cards">
                    <div class="keunggulan-card fade-in-on-scroll">
                        <div class="keunggulan-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="keunggulan-card-text">
                            <h3>Bahan Alami Berkualitas</h3>
                            <p>Menggunakan bahan-bahan alami terbaik, tanpa tambahan pengawet, untuk menjamin rasa dan kesehatan dalam setiap gigitan.</p>
                        </div>
                    </div>
                    <div class="keunggulan-card fade-in-on-scroll">
                        <div class="keunggulan-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="keunggulan-card-text">
                            <h3>Resep Istimewa</h3>
                            <p>Setiap produk dibuat dari resep-resep khusus yang merupakan kombinasi rasa tradisional dan modern, menciptakan cita rasa yang otentik dan tak terlupakan.</p>
                        </div>
                    </div>
                    <div class="keunggulan-card fade-in-on-scroll">
                        <div class="keunggulan-icon">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="keunggulan-card-text">
                            <h3>Selalu Segar Setiap Hari</h3>
                            <p>Kami memanggang setiap hari untuk memastikan produk yang disajikan selalu segar dan lezat ketika sampai di tangan Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Scroll Animation Observer for Journey Section
        const faders = document.querySelectorAll('.fade-in-on-scroll');
        const appearOptions = {
            threshold: 0.15,
            rootMargin: "0px 0px -50px 0px"
        };
        const appearOnScroll = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('appear');
                observer.unobserve(entry.target);
            });
        }, appearOptions);

        faders.forEach(fader => {
            appearOnScroll.observe(fader);
        });
    });
</script>
@endpush
