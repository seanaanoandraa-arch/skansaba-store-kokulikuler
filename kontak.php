<?php require_once 'config/functions.php';
$pageTitle = 'Kontak';
$activePage = 'contact';
include 'includes/header.php'; ?>
<main class="container page-main">
    <div class="page-title"><span class="eyebrow">KAMI SIAP MEMBANTU</span>
        <h1>Hubungi Kami</h1>
        <p>Silakan kirim pesan atau hubungi kontak unit layanan.</p>
    </div>
    <div class="contact-layout">
        <form class="form-card" id="contactForm"><label>Nama Lengkap<input name="nama" required
                    placeholder="Masukkan nama kamu"></label><label>Email<input type="email" name="email" required
                    placeholder="nama@email.com"></label><label>Subjek<input name="subjek" required
                    placeholder="Topik pesan"></label><label>Pesan<textarea name="pesan" rows="5" required
                    placeholder="Tulis pesan kamu..."></textarea></label><button class="btn btn-brown"
                type="submit">Kirim Pesan</button>
            <p id="contactMessage" class="form-message"></p>
        </form>
        <aside class="contact-info">
            <h2>Informasi Kontak</h2>
            <p>📍 Jl. Parangtritis No. KM. 11, Dukuh, Sabdodadi, Kec. Bantul, Kabupaten Bantul, Daerah Istimewa
                Yogyakarta 55715</p>
            <p>☎ 0858 3807 8487</p>
            <p>💬 WhatsApp Admin: <a href="https://wa.me/6289524738289" target="_blank" rel="noopener noreferrer">+62
                    895-2473-8289</a></p>
            <div class="contact-note">Jam layanan mengikuti operasional unit layanan sekolah.</div>
        </aside>
    </div>
</main>
<?php include 'includes/footer.php'; ?>