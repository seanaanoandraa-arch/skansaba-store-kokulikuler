const translations = {
    "Beranda": "Home", "Katalog Produk": "Product Catalog", "Tentang Kami": "About Us", "Kontak": "Contact",
    "TOKO RESMI SMKN 1 BANTUL": "OFFICIAL SMKN 1 BANTUL STORE",
    "Belanja Kebutuhan Pokok Dan Atribut Sekolah Jadi Lebih Mudah Di Skansaba Store": "Shopping for Daily Essentials and School Supplies Is Easier at Skansaba Store",
    "Platform digital resmi unit layanan SMKN 1 Bantul untuk mempermudah akses produk siswa dan sekolah secara cepat dan transparan.": "The official digital platform of SMKN 1 Bantul's service unit, making student and school products easier to access quickly and transparently.",
    "Lihat Katalog": "View Catalog", "Hubungi Kami": "Contact Us", "Lihat produk lebih mudah": "Browse products easily",
    "Periksa pilihan barang dan harga dalam satu katalog.": "Check product selections and prices in one catalog.", "Pilihan lebih tertata": "Better-organized choices",
    "Produk dikelompokkan berdasarkan jenis kebutuhan.": "Products are grouped by type of need.", "Keranjang praktis": "Convenient cart",
    "Atur jumlah barang sebelum membuat pesanan.": "Adjust item quantities before placing an order.", "DARI KATALOG KAMI": "FROM OUR CATALOG",
    "Produk pilihan": "Featured Products", "Kenali beberapa produk yang tersedia di Skansaba Store.": "Explore some of the products available at Skansaba Store.",
    "Lihat Semua Produk": "View All Products", "Belanjakan kebutuhan pokok anda.": "Shop for your everyday essentials.",
    "Layanan Produk": "Product Services", "Kontak Siswa": "Student Contact", "Informasi": "Information", "Tentang Skansaba Store": "About Skansaba Store",
    "Informasi kontak": "Contact Information", "Hubungi": "Get in Touch", "Katalog Produk": "Product Catalog",
    "TEMUKAN KEBUTUHANMU": "FIND WHAT YOU NEED", "Pilih produk kebutuhan yang anda butuhkan.": "Choose the products you need.",
    "Cari nama produk...": "Search product name...", "Semua": "All", "Semua Kategori": "All Categories", "Makanan": "Food", "Minuman": "Drinks", "Kebutuhan Rumah Tangga": "Household Essentials",
    "PESANANMU": "YOUR ORDER", "Keranjang Belanja": "Shopping Cart", "Periksa kembali produk sebelum melakukan pemesanan.": "Review your products before placing an order.",
    "Keranjang masih kosong": "Your cart is empty", "Yuk, pilih kebutuhanmu.": "Let's find what you need.", "Hubungi Kami": "Contact Us",
    "KAMI SIAP MEMBANTU": "WE ARE HERE TO HELP", "Silakan kirim pesan atau hubungi kontak unit layanan.": "Send us a message or contact our service unit.",
    "Nama Lengkap": "Full Name", "Masukkan nama kamu": "Enter your name", "Subjek": "Subject", "Topik pesan": "Message subject",
    "Pesan": "Message", "Tulis pesan kamu...": "Write your message...", "Kirim Pesan": "Send Message", "Informasi Kontak": "Contact Information",
    "Jam layanan mengikuti operasional unit layanan sekolah.": "Service hours follow the school's service unit operating hours.",
    "TENTANG SKANSABA STORE": "ABOUT SKANSABA STORE", "Belanja kebutuhan sekolah, lebih mudah dan terarah.": "Shopping for school essentials, made easier and more convenient.",
    "Skansaba Store merupakan konsep platform digital unit layanan SMKN 1 Bantul yang membantu siswa memperoleh kebutuhan atribut, perlengkapan praktik, merchandise, dan modul pembelajaran.": "Skansaba Store is a digital platform concept for SMKN 1 Bantul's service unit, helping students access school accessories, practical equipment, merchandise, and learning modules.",
    "Visi": "Vision", "Misi": "Mission", "Lokasi": "Location",
    "Mendukung layanan sekolah yang modern, praktis, dan mudah diakses oleh seluruh warga sekolah.": "Supporting modern, practical school services that are accessible to the entire school community.",
    "Menyediakan katalog produk yang jelas, memudahkan pemesanan, serta menghadirkan informasi transaksi yang transparan.": "Providing a clear product catalog, easier ordering, and transparent transaction information.",
    "Produk tidak ditemukan.": "No products found.", "Stok Habis": "Out of Stock", "Pesan Sekarang": "Order Now",
    "Stok produk tidak mencukupi!": "Insufficient product stock!", "ditambahkan ke keranjang!": "added to cart!",
    "Keranjang kosong": "Empty cart", "Kurangi jumlah": "Decrease quantity", "Tambah jumlah": "Increase quantity", "Hapus": "Remove",
    "Total Pembayaran": "Total Payment", "Buat Pesanan": "Place Order", "Masukkan nama pemesan:": "Enter customer name:",
    "Pesanan berhasil dibuat! ID:": "Order placed successfully! ID:", "Menunggu": "Pending", "Per item": "per item",
    "WhatsApp berhasil disiapkan. Silakan tekan tombol Kirim di WhatsApp untuk mengirim pesan ke admin.": "WhatsApp is ready. Press Send in WhatsApp to send your message to the admin.",
    "Halo Admin Skansaba Store, saya ingin menyampaikan pesan/komplain.": "Hello Skansaba Store Admin, I would like to send a message/complaint.",
    "Nama": "Name", "Email": "Email", "Belanja": "Shop", "Quick Links": "Quick Links"
};

function currentLanguage() {
    return localStorage.getItem('skansaba_language') || 'id';
}

function translateText(value, language) {
    if (language !== 'en') return value;
    const trimmed = value.trim();
    if (!trimmed) return value;
    const normalized = trimmed.replace(/\s+/g, " ");
    const translated = translations[normalized];
    return translated ? value.replace(trimmed, translated) : value;
}

function applyLanguage(language) {
    localStorage.setItem('skansaba_language', language);
    document.documentElement.lang = language;
    document.querySelectorAll('.lang-btn').forEach(button => {
        const active = button.dataset.lang === language;
        button.classList.toggle('active', active);
        button.setAttribute('aria-pressed', String(active));
    });

    const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
    let node;
    while ((node = walker.nextNode())) {
        if (!node.parentElement.closest('script, style, .lang-btn')) {
            if (!node._skansabaOriginal) node._skansabaOriginal = node.nodeValue;
            node.nodeValue = translateText(node._skansabaOriginal, language);
        }
    }
    document.querySelectorAll('[placeholder]').forEach(el => {
        if (!el.dataset.originalPlaceholder) el.dataset.originalPlaceholder = el.getAttribute('placeholder');
        el.setAttribute('placeholder', translateText(el.dataset.originalPlaceholder, language));
    });
    document.querySelectorAll('[aria-label]').forEach(el => {
        if (!el.dataset.originalAria) el.dataset.originalAria = el.getAttribute('aria-label');
        el.setAttribute('aria-label', translateText(el.dataset.originalAria, language));
    });

    renderFeatured();
    renderCatalog();
    renderCart();
}

const t = text => currentLanguage() === 'en' ? (translations[text] || text) : text;

const defaultProducts = [
    { id: 1, name: "Chocolatos", category: "Makanan", price: 500, stock: 25, image: "assets/images/chocolatos.jpeg" },
    { id: 2, name: "Chiki_balls", category: "Makanan", price: 2000, stock: 25, image: "assets/images/Chiki_balls.jpeg" },
    { id: 3, name: "Indomie", category: "Makanan", price: 3000, stock: 50, image: "assets/images/Indomie.jpeg" },
    { id: 4, name: "le_mineral", category: "Minuman", price: 2500, stock: 30, image: "assets/images/le_mineral.jpeg" },
    { id: 5, name: "Mama_lemon", category: "Kebutuhan Rumah Tangga", price: 7000, stock: 20, image: "assets/images/Mama_lemon.jpeg" },
    { id: 6, name: "Milku", category: "Minuman", price: 3000, stock: 25, image: "assets/images/Milku.jpeg" },
    { id: 7, name: "pop_mie", category: "Makanan", price: 5000, stock: 30, image: "assets/images/pop_mie.jpeg" },
    { id: 8, name: "sunco", category: "Kebutuhan Rumah Tangga", price: 20000, stock: 20, image: "assets/images/sunco.jpeg" },
    { id: 9, name: "Teh_kotak", category: "Minuman", price: 3000, stock: 25, image: "assets/images/Teh_kotak.jpeg" },
    { id: 10, name: "tissue", category: "Kebutuhan Rumah Tangga", price: 9500, stock: 30, image: "assets/images/tissue.jpeg" }
];

function get(key, defaultValue) {
    try {
        const storedValue = localStorage.getItem(key);
        return storedValue === null ? defaultValue : JSON.parse(storedValue);
    } catch (error) {
        console.warn(`Data ${key} tidak dapat dibaca. Menggunakan data awal.`, error);
        return defaultValue;
    }
}

function save(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

let products = get("skansaba_products", defaultProducts);
let cart = get("skansaba_cart", []);
let orders = get("skansaba_orders", []);

products = products.map(product => {
    if (
        product.image &&
        !product.image.startsWith("data:") &&
        !product.image.startsWith("http") &&
        !product.image.startsWith("assets/images/")
    ) {
        product.image = "assets/images/" + product.image.split("/").pop();
    }
    return product;
});

save("skansaba_products", products);

const rupiah = number => "Rp " + Number(number).toLocaleString("id-ID");
const displayName = name => String(name || "").replaceAll("_", " ").replace(/\b\w/g, letter => letter.toUpperCase());

function updateCartCount() {
    const totalItems = cart.reduce((total, item) => total + item.qty, 0);
    document.querySelectorAll("#cartCount").forEach(element => {
        element.textContent = totalItems;
    });
}

function productCard(product) {
    return `
        <article class="product-card">
            <div class="product-art">
                ${product.image ? `<img src="${product.image}" alt="${product.name}" onerror="this.style.display='none'">` : ""}
            </div>
            <span class="product-category">${t(product.category)}</span>
            <h3>${displayName(product.name)}</h3>
            <div class="price">${rupiah(product.price)}</div>
            <button class="btn btn-mint" onclick="addToCart(${product.id})" ${product.stock <= 0 ? "disabled" : ""}>
                ${product.stock <= 0 ? t("Stok Habis") : t("Pesan Sekarang")}
            </button>
        </article>
    `;
}

function renderFeatured() {
    const element = document.getElementById("featuredProducts");
    if (!element) return;

    element.innerHTML = products.slice(0, 4).map(productCard).join("");
}

function renderCatalog() {
    const element = document.getElementById("allProducts");
    if (!element) return;

    const keyword = (document.getElementById("searchProduct")?.value || "").toLowerCase().trim();
    const category = document.getElementById("categoryFilter")?.value || "Semua";

    const filteredProducts = products.filter(product => {
        const matchName = product.name.toLowerCase().includes(keyword);
        const matchCategory = category === "Semua" || product.category === category;
        return matchName && matchCategory;
    });

    element.innerHTML = filteredProducts.length
        ? filteredProducts.map(productCard).join("")
        : `<div class="empty-state">${t('Produk tidak ditemukan.')}</div>`;
}

function addToCart(id) {
    const product = products.find(item => item.id === id);
    if (!product) return;

    const cartItem = cart.find(item => item.id === id);
    const currentQty = cartItem ? cartItem.qty : 0;

    if (currentQty >= product.stock) {
        alert(t("Stok produk tidak mencukupi!"));
        return;
    }

    if (cartItem) {
        cartItem.qty++;
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            qty: 1
        });
    }

    save("skansaba_cart", cart);
    updateCartCount();
    alert(displayName(product.name) + " " + t("ditambahkan ke keranjang!"));
}

function renderCart() {
    const element = document.getElementById("cartContents");
    if (!element) return;

    if (cart.length === 0) {
        element.innerHTML = `
            <div class="empty-state">
                <img src="assets/images/keranjang.png" alt="Keranjang kosong" class="empty-cart-img">
                <h2>${t("Keranjang masih kosong")}</h2>
                <p>${t("Yuk, pilih kebutuhanmu.")}</p>
                <a class="btn btn-brown" href="katalog.html">${t("Lihat Katalog")}</a>
            </div>
        `;
        return;
    }

    const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);

    element.innerHTML = `
        <div class="cart-items">
            ${cart.map(item => `
                <div class="cart-row">
                    <div>
                        <b>${displayName(item.name)}</b>
                        <div class="product-category">${rupiah(item.price)} / ${t("Per item")}</div>
                    </div>
                    <div>
                        <button class="qty-btn" onclick="changeQty(${item.id}, -1)" aria-label="${t("Kurangi jumlah")}">−</button>
                        ${item.qty}
                        <button class="qty-btn" onclick="changeQty(${item.id}, 1)" aria-label="${t("Tambah jumlah")}">+</button>
                    </div>
                    <b>${rupiah(item.price * item.qty)}</b>
                    <button class="btn btn-outline" onclick="removeCart(${item.id})">${t("Hapus")}</button>
                </div>
            `).join("")}
        </div>
        <div class="cart-total">
            <span>${t("Total Pembayaran")}</span>
            <strong>${rupiah(total)}</strong>
            <button class="btn btn-brown full" onclick="checkout()">${t("Buat Pesanan")}</button>
        </div>
    `;
}

function changeQty(id, amount) {
    const item = cart.find(product => product.id === id);
    if (!item) return;

    const product = products.find(product => product.id === id);
    if (amount > 0 && (!product || item.qty >= product.stock)) {
        alert(t("Stok produk tidak mencukupi!"));
        return;
    }

    item.qty += amount;
    cart = cart.filter(item => item.qty > 0);

    save("skansaba_cart", cart);
    updateCartCount();
    renderCart();
}

function removeCart(id) {
    cart = cart.filter(item => item.id !== id);
    save("skansaba_cart", cart);
    updateCartCount();
    renderCart();
}

function checkout() {
    if (!cart.length) return;

    const name = prompt(t("Masukkan nama pemesan:"));
    if (!name || !name.trim()) return;

    for (const item of cart) {
        const product = products.find(product => product.id === item.id);
        if (!product || product.stock < item.qty) {
            alert(t("Stok produk tidak mencukupi!") + " (" + item.name + ")");
            return;
        }
    }

    const order = {
        id: "SKS-" + Date.now().toString().slice(-6),
        name: name.trim(),
        items: cart.map(item => ({ ...item })),
        date: new Date().toLocaleDateString("id-ID"),
        total: cart.reduce((sum, item) => sum + item.price * item.qty, 0),
        status: "Menunggu"
    };

    cart.forEach(item => {
        const product = products.find(product => product.id === item.id);
        if (product) product.stock -= item.qty;
    });

    orders.unshift(order);
    save("skansaba_orders", orders);
    save("skansaba_products", products);

    cart = [];
    save("skansaba_cart", cart);
    updateCartCount();
    renderCart();

    alert(t("Pesanan berhasil dibuat! ID:") + " " + order.id);
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".lang-btn").forEach(button => {
        button.addEventListener("click", () => applyLanguage(button.dataset.lang));
    });
    updateCartCount();
    renderFeatured();
    renderCatalog();
    renderCart();
    applyLanguage(currentLanguage());

    document.getElementById("searchProduct")?.addEventListener("input", renderCatalog);
    document.getElementById("categoryFilter")?.addEventListener("change", renderCatalog);

    document.getElementById("contactForm")?.addEventListener("submit", event => {
        event.preventDefault();

        const form = event.currentTarget;
        const nama = form.elements.namedItem("nama").value.trim();
        const email = form.elements.namedItem("email").value.trim();
        const subjek = form.elements.namedItem("subjek").value.trim();
        const pesan = form.elements.namedItem("pesan").value.trim();
        const nomorAdmin = "6289524738289";

        const isiPesan = [
            t("Halo Admin Skansaba Store, saya ingin menyampaikan pesan/komplain."),
            "",
            `${t("Nama")}: ${nama}`,
            `Email: ${email}`,
            `${t("Subjek")}: ${subjek}`,
            `${t("Pesan")}: ${pesan}`
        ].join("\n");

        const urlWhatsApp = `https://wa.me/${nomorAdmin}?text=${encodeURIComponent(isiPesan)}`;
        const tabWhatsApp = window.open(urlWhatsApp, "_blank");

        // Jika browser memblokir tab baru, buka WhatsApp di tab yang sama.
        if (!tabWhatsApp) {
            window.location.href = urlWhatsApp;
            return;
        }

        const status = document.getElementById("contactMessage");
        if (status) {
            status.textContent = t("WhatsApp berhasil disiapkan. Silakan tekan tombol Kirim di WhatsApp untuk mengirim pesan ke admin.");
        }

        form.reset();
    });

    document.getElementById("menuToggle")?.addEventListener("click", () => {
        document.getElementById("mainNav")?.classList.toggle("open");
    });
});

function togglePassword(id, button) {
    const input = document.getElementById(id);

    if (input.type === "password") {
        input.type = "text";
        button.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
    } else {
        input.type = "password";
        button.innerHTML = '<i class="fa-solid fa-eye"></i>';
    }
}