@extends('layouts.dashboard')

@section('content')
<div class="h-[calc(100vh-100px)] overflow-y-auto px-4 py-6">
  <div class="flex flex-col lg:flex-row gap-6">

    <!-- Product Panel -->
    <div class="w-full lg:w-2/3 space-y-4">
      <!-- Filter -->
      <div class="flex flex-col sm:flex-row gap-3">
        <input type="text" id="search" placeholder="🔍 Cari produk..." onkeyup="filterProducts()"
          class="w-full sm:w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
        <select id="categoryFilter" onchange="filterProducts()"
          class="w-full sm:w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
          <option value="">Semua Kategori</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Product Grid -->
      <div id="productList" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($products as $product)
          <div class="bg-white border rounded-lg p-3 hover:shadow-md transition relative
                      {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
               data-id="{{ $product->id }}"
               data-name="{{ strtolower($product->name) }}"
               data-category="{{ $product->category_id }}"
               data-stock="{{ $product->stock }}"
               onclick="{{ $product->stock > 0 ? "addToCart({$product->id}, '".addslashes($product->name)."', {$product->price}, {$product->stock})" : 'null' }}">
            <img src="{{ $product->photo ? asset('storage/' . $product->photo) : 'https://via.placeholder.com/150' }}"
                 class="w-full h-32 object-cover rounded">
            <div class="mt-2">
              <h3 class="font-semibold text-sm truncate">{{ $product->name }}</h3>
              <p class="text-green-600 text-sm font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
              <p class="text-xs text-gray-500">Stok: {{ $product->stock }}</p>
              @if ($product->stock <= 0)
                <p class="text-red-500 text-xs mt-1">❌ Stok habis</p>
              @endif
            </div>
          </div>
        @empty
          <div class="col-span-full text-center text-gray-500">Tidak ada produk tersedia.</div>
        @endforelse
      </div>
    </div>

    <!-- Cart + Scanner Panel -->
    <div class="w-full lg:w-1/3 space-y-4">

      <!-- Scanner QRCode -->
      <div class="bg-white border rounded-lg p-4 space-y-3">
        <h3 class="text-lg font-bold text-gray-700 border-b pb-2">📷 Scan Produk</h3>
        <div id="qr-reader" style="width:100%"></div>
        <div id="qr-result" class="text-sm text-gray-600 mt-2">Hasil scan akan muncul di sini...</div>
      </div>

      <!-- Cart Panel -->
      <div class="bg-white border rounded-lg p-4 space-y-4 h-full sticky top-4">
        <h3 class="text-lg font-bold text-gray-700 border-b pb-2">🛒 Keranjang Belanja</h3>

        @if (session('success'))
          <div class="bg-green-100 text-green-700 text-sm p-2 rounded">{{ session('success') }}</div>
        @endif

        @if (session('error'))
          <div class="bg-red-100 text-red-700 text-sm p-2 rounded">{{ session('error') }}</div>
        @endif

        <ul id="cartItems" class="divide-y divide-gray-200"></ul>

        <div class="flex justify-between text-lg font-semibold text-gray-800 border-t pt-4">
          <span>Total:</span>
          <span id="cartTotal">Rp 0</span>
        </div>

        <form id="checkoutForm" action="{{ route('sales.store') }}" method="POST">
          @csrf
          <input type="hidden" name="cart_data" id="cartData">
          <button type="submit"
            class="w-full bg-green-600 text-white py-2 rounded-md font-semibold hover:bg-green-700 transition">
            Cetak Struk
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Library QRCode Scanner -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let cart = [];

// ====================
// Update stok grid
// ====================
function updateProductStock(id, qtyChange) {
    const productCard = document.querySelector(`#productList > div[data-id='${id}']`);
    if (!productCard) return;

    let stock = parseInt(productCard.getAttribute('data-stock'));
    stock += qtyChange;

    productCard.setAttribute('data-stock', stock);
    productCard.querySelector('p.text-xs.text-gray-500').textContent = `Stok: ${stock}`;

    if (stock <= 0) {
        productCard.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        productCard.classList.remove('opacity-50', 'cursor-not-allowed');
    }

    const cartItem = cart.find(item => item.id === id);
    if (cartItem) {
        cartItem.stock = stock + cartItem.qty;
    }
}

// ====================
// Tambah ke cart
// ====================
function addToCart(id, name, price, stock) {
    const index = cart.findIndex(item => item.id === id);
    const productCard = document.querySelector(`#productList > div[data-id='${id}']`);
    const currentStock = parseInt(productCard.getAttribute('data-stock'));

    if (currentStock <= 0) {
        alert("❌ Stok habis. Tidak bisa ditambahkan.");
        return;
    }

    if (index >= 0) {
        if (cart[index].qty < currentStock + cart[index].qty) {
            cart[index].qty++;
            updateProductStock(id, -1);
        } else {
            alert("⚠️ Stok tidak mencukupi.");
            return;
        }
    } else {
        cart.push({ id, name, price, stock: currentStock, qty: 1 });
        updateProductStock(id, -1);
    }
    renderCart();
}

function increaseQty(index) {
    const id = cart[index].id;
    const productCard = document.querySelector(`#productList > div[data-id='${id}']`);
    const currentStock = parseInt(productCard.getAttribute('data-stock'));

    if (currentStock > 0) {
        cart[index].qty++;
        updateProductStock(id, -1);
    } else {
        alert("⚠️ Stok maksimal tercapai.");
    }
    renderCart();
}

function decreaseQty(index) {
    const id = cart[index].id;
    const qty = cart[index].qty;

    if (qty > 1) {
        cart[index].qty--;
        updateProductStock(id, 1);
    } else {
        updateProductStock(id, qty);
        cart.splice(index, 1);
    }
    renderCart();
}

// ====================
// Render cart
// ====================
function renderCart() {
    const cartList = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');
    const cartData = document.getElementById('cartData');

    cartList.innerHTML = '';
    let total = 0;

    cart.forEach((item, index) => {
        total += item.price * item.qty;
        cartList.innerHTML += `
        <li class="py-3 flex justify-between items-center">
          <div>
            <p class="text-sm font-medium">${item.name}</p>
            <div class="flex items-center gap-2 mt-1">
              <button class="bg-gray-200 px-2 rounded" type="button" onclick="decreaseQty(${index})">−</button>
              <span>${item.qty}</span>
              <button class="bg-gray-200 px-2 rounded" type="button" onclick="increaseQty(${index})">+</button>
            </div>
            <p class="text-xs text-gray-500">Stok: ${item.stock}</p>
          </div>
          <div class="text-right text-sm font-semibold text-gray-800">
            Rp ${(item.price * item.qty).toLocaleString()}
          </div>
        </li>`;
    });

    cartTotal.textContent = 'Rp ' + total.toLocaleString();
    cartData.value = JSON.stringify(cart);
}

// ====================
// Filter produk
// ====================
function filterProducts() {
    const search = document.getElementById('search').value.toLowerCase();
    const category = document.getElementById('categoryFilter').value;
    const products = document.querySelectorAll('#productList > div');

    products.forEach(card => {
        const name = card.getAttribute('data-name');
        const cat = card.getAttribute('data-category');
        const matchName = name.includes(search);
        const matchCategory = !category || cat === category;

        card.style.display = matchName && matchCategory ? 'block' : 'none';
    });
}

// ====================
// Checkout form
// ====================
document.getElementById('checkoutForm').addEventListener('submit', function () {
    document.getElementById('cartData').value = JSON.stringify(cart);
});

// ====================
// QR Scanner
// ====================
let canScan = true;
function onScanSuccess(decodedText, decodedResult) {
    if (!canScan) return;
    canScan = false;

    document.getElementById("qr-result").innerText = "✅ " + decodedText;

    try {
        const data = JSON.parse(decodedText);
        const productCard = document.querySelector(`#productList > div[data-id='${data.id}']`);
        const stock = parseInt(productCard.getAttribute('data-stock'));
        addToCart(data.id, data.name, data.price, stock);
    } catch (e) {
        alert("❌ Format QR tidak dikenali: " + decodedText);
    }

    setTimeout(() => { canScan = true; }, 2000);
}

function onScanError(errorMessage) { console.warn(errorMessage); }

let html5QrcodeScanner = new Html5QrcodeScanner(
    "qr-reader",
    { fps: 10, qrbox: 250 }
);
html5QrcodeScanner.render(onScanSuccess, onScanError);

</script>
@endsection
