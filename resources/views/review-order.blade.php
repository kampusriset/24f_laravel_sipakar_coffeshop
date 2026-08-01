<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - Aura Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 antialiased text-stone-800">
    
    <div class="max-w-md mx-auto bg-white min-h-screen shadow-sm border border-stone-100 flex flex-col relative">
        
        <div class="p-4 border-b flex items-center bg-white sticky top-0 z-10">
            <button onclick="history.back()" class="mr-4 text-xl">←</button>
            <h1 class="font-bold text-lg">Pesanan</h1>
        </div>

        <div id="cart-items" class="p-4 space-y-4 flex-1">
            <!-- Item dirender via JS -->
        </div>

        <div class="p-4 bg-stone-50 border-t">
            <div class="border rounded-xl p-4 bg-white shadow-sm space-y-3">
                <h3 class="font-bold text-sm border-b pb-2">Rincian Pembayaran</h3>
                <div class="flex justify-between text-sm text-stone-600">
                    <span>Subtotal</span>
                    <span id="subtotal-display" class="font-medium text-stone-900">Rp0</span>
                </div>
                <div class="flex justify-between text-sm text-stone-600">
                    <span>PPN (10%)</span>
                    <span id="ppn-display" class="font-medium text-stone-900">Rp0</span>
                </div>
                <div class="flex justify-between font-bold text-stone-900 border-t pt-2">
                    <span>Total</span>
                    <span id="total-display" class="text-amber-900">Rp0</span>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border-t sticky bottom-0">
    <!-- Di review-order.blade.php -->
<button 
    onclick="window.location.href='{{ url('/pembayaran') }}'" 
    class="w-full bg-[#2c1d11] text-amber-50 py-3 rounded-xl font-bold hover:bg-[#3d2a1a] transition">
    Lanjut Pembayaran
</button>
</div>

        <!-- ============ MODAL EDIT ADD-ON (INLINE) ============ -->
        <div id="edit-options-modal" class="hidden fixed inset-0 bg-black/60 z-50 flex items-end justify-center">
            <div class="w-full max-w-md bg-white rounded-t-2xl max-h-[85%] flex flex-col overflow-hidden shadow-2xl">

                <!-- Sticky Header -->
                <div class="p-5 border-b border-stone-100 bg-white sticky top-0 flex justify-between items-start">
                    <div class="pr-6">
                        <h3 id="edit-item-name" class="text-lg font-serif font-bold text-stone-900 tracking-wide">Nama Item</h3>
                        <div id="edit-item-price" class="text-sm font-semibold text-amber-900 mt-0.5">Rp0</div>
                    </div>
                    <button onclick="closeEditModal()" class="text-stone-400 hover:text-stone-700 p-1 bg-stone-50 rounded-full transition shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- Scrollable Options Area -->
                <div class="overflow-y-auto p-5 space-y-6 flex-1 bg-stone-50/50">

                    <!-- 1. TEMPERATURE -->
                    <div id="edit-temp-group" class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900">Temperature</h4>
                            <span class="text-[10px] font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded">Must be selected max. 1</span>
                        </div>
                        <div class="space-y-3 text-sm">
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Ice</span>
                                <input type="radio" name="edit_temp_opt" value="Ice" data-price="0" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Hot</span>
                                <input type="radio" name="edit_temp_opt" value="Hot" data-price="0" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                        </div>
                    </div>

                    <!-- 2. SUGAR LEVEL -->
                    <div id="edit-sugar-group" class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900">Sugar Level</h4>
                            <span class="text-[10px] font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded">Must be selected max. 1</span>
                        </div>
                        <div class="space-y-3 text-sm">
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">No Sugar</span>
                                <input type="radio" name="edit_sugar_opt" value="No Sugar" data-price="0" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Less Sugar</span>
                                <input type="radio" name="edit_sugar_opt" value="Less Sugar" data-price="0" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Normal Sugar</span>
                                <input type="radio" name="edit_sugar_opt" value="Normal Sugar" data-price="0" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                        </div>
                    </div>

                    <!-- 3. SIZE -->
                    <div id="edit-size-group" class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900">Cup Size</h4>
                            <span class="text-[10px] font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded">Must be selected max. 1</span>
                        </div>
                        <div class="space-y-3 text-sm">
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Reguler</span>
                                <input type="radio" name="edit_size_opt" value="Reguler" data-price="0" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Large <span class="text-xs text-amber-800 font-semibold">(+Rp4.000)</span></span>
                                <input type="radio" name="edit_size_opt" value="Large" data-price="4000" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Extra Large <span class="text-xs text-amber-800 font-semibold">(+Rp8.000)</span></span>
                                <input type="radio" name="edit_size_opt" value="Extra Large" data-price="8000" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                        </div>
                    </div>

                    <!-- 4. MILK OPTION -->
                    <div id="edit-milk-group" class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900">Milk Option</h4>
                            <span class="text-[10px] font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded">Must be selected max. 1</span>
                        </div>
                        <div class="space-y-3 text-sm">
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Standard Milk</span>
                                <input type="radio" name="edit_milk_opt" value="Milk" data-price="0" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Oatside Milk <span class="text-xs text-amber-800 font-semibold">(+Rp3.000)</span></span>
                                <input type="radio" name="edit_milk_opt" value="Oatside" data-price="3000" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300">
                            </label>
                        </div>
                    </div>

                    <!-- 5. EXTRA TOPPING -->
                    <div id="edit-topping-group" class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900">Extra Topping</h4>
                            <span class="text-[10px] font-semibold text-stone-500 bg-stone-100 px-2 py-0.5 rounded">Optional (Multiple select)</span>
                        </div>
                        <div class="space-y-3 text-sm">
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Extra Shot Espresso <span class="text-xs text-amber-800 font-semibold">(+Rp5.000)</span></span>
                                <input type="checkbox" name="edit_topping_opt" value="Extra Shot" data-price="5000" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300 rounded">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Whipped Cream <span class="text-xs text-amber-800 font-semibold">(+Rp4.000)</span></span>
                                <input type="checkbox" name="edit_topping_opt" value="Whipped Cream" data-price="4000" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300 rounded">
                            </label>
                            <label class="flex items-center justify-between cursor-pointer py-1">
                                <span class="text-stone-700 font-medium">Caramel Drizzle <span class="text-xs text-amber-800 font-semibold">(+Rp3.000)</span></span>
                                <input type="checkbox" name="edit_topping_opt" value="Caramel Drizzle" data-price="3000" onchange="calculateEditTotal()" class="w-4 h-4 text-amber-800 focus:ring-amber-800 border-stone-300 rounded">
                            </label>
                        </div>
                    </div>

                    <!-- CATATAN -->
                    <div class="bg-white rounded-xl p-4 border border-stone-100 shadow-xs">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-stone-900 mb-2">Notes</h4>
                        <textarea id="edit-item-notes" rows="2" placeholder="Contoh: Es sedikit aja ya, atau pisah saus..." class="w-full bg-stone-50 border border-stone-200 rounded-lg p-2.5 text-xs focus:outline-hidden focus:ring-1 focus:ring-stone-400 focus:bg-white transition"></textarea>
                    </div>
                </div>

                <!-- Sticky Bottom Action Bar -->
                <div class="p-4 border-t border-stone-100 bg-white sticky bottom-0 flex flex-col space-y-3 shadow-md">
                    <div class="flex justify-between items-center px-1">
                        <div>
                            <span class="text-[10px] uppercase text-stone-400 tracking-wider">Total Item</span>
                            <div id="edit-total-display" class="text-base font-bold text-stone-900">Rp0</div>
                        </div>
                        <div class="flex items-center bg-stone-100 border border-stone-200 rounded-xl p-1 font-semibold text-stone-900 text-sm">
                            <button onclick="changeEditQty(-1)" class="w-8 h-7 flex items-center justify-center font-bold text-stone-600 hover:text-stone-900 transition">-</button>
                            <span id="edit-qty-count" class="px-3 font-bold">1</span>
                            <button onclick="changeEditQty(1)" class="w-8 h-7 flex items-center justify-center font-bold text-stone-600 hover:text-stone-900 transition">+</button>
                        </div>
                    </div>

                    <button id="edit-submit-btn" onclick="saveEditToCart()" class="w-full bg-[#2c1d11] hover:bg-[#3d2a1a] text-amber-50 py-3 rounded-xl text-xs font-bold tracking-wider uppercase transition shadow-md active:scale-[0.99]">
                        Simpan Perubahan - Rp0
                    </button>
                </div>

            </div>
        </div>

    </div>

    <script>
        let editingIndex = null;
        let editingItem = null;
        let editQty = 1;

        function getCart() { return JSON.parse(localStorage.getItem('aura_cart')) || []; }
        function saveCart(cart) { localStorage.setItem('aura_cart', JSON.stringify(cart)); renderCart(); }

        function updateQty(index, delta) {
            let cart = getCart();
            cart[index].qty = Math.max(1, cart[index].qty + delta);
            saveCart(cart);
        }

        function removeItem(index) {
            let cart = getCart();
            cart.splice(index, 1);
            saveCart(cart);
        }

        // ============ Klasifikasi kategori (harus sinkron dengan halaman menu) ============
        const NO_ADDON_KATEGORI = ['non kopi', 'non-kopi', 'minuman segar', 'pastry & dessert', 'pastry &amp; dessert', 'pastry', 'dessert', 'makanan berat'];
        const HOT_COFFEE_KATEGORI = ['kopi panas'];
        const ICE_COFFEE_KATEGORI = ['es kopi'];

        function normalizeKategori(str) {
            return (str || '').toString().trim().toLowerCase();
        }
        function isNoAddonKategori(kategori) {
            const k = normalizeKategori(kategori);
            return NO_ADDON_KATEGORI.some(item => k.includes(item));
        }
        function isHotCoffeeKategori(kategori) {
            const k = normalizeKategori(kategori);
            return HOT_COFFEE_KATEGORI.some(item => k.includes(item));
        }
        function isIceCoffeeKategori(kategori) {
            const k = normalizeKategori(kategori);
            return ICE_COFFEE_KATEGORI.some(item => k.includes(item));
        }

        function renderCart() {
            const cart = getCart();
            const container = document.getElementById('cart-items');
            container.innerHTML = '';
            let subtotal = 0;

            cart.forEach((item, index) => {
                let price = parseInt(item.finalPrice) || 0; 
                subtotal += (price * item.qty);
                let details = [item.temp, item.sugar, item.size, item.milk, ...(item.toppings || [])].filter(Boolean).join(', ');

                // Tombol Edit hanya muncul kalau kategori item ini memang punya add-on
                const kategori = item.kategori || '';
                const showEditBtn = !isNoAddonKategori(kategori);

                container.innerHTML += `
                    <div class="border-b pb-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-stone-900">${item.nama}</p>
                                <p class="text-xs text-stone-500">${details}</p>
                                ${item.notes ? `<p class="text-xs text-stone-400 italic mt-0.5">Catatan: ${item.notes}</p>` : ''}
                            </div>
                            ${showEditBtn ? `<button onclick="openEditModal(${index})" class="text-xs font-semibold text-amber-900 border border-amber-900/30 rounded-lg px-2.5 py-1 hover:bg-amber-50 transition shrink-0 ml-2">Edit</button>` : ''}
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <p class="font-bold text-stone-900">Rp${(price * item.qty).toLocaleString('id-ID')}</p>
                            <div class="flex items-center gap-3 border rounded-lg px-2 py-1">
                                <button onclick="updateQty(${index}, -1)" class="text-stone-400 font-bold">-</button>
                                <span class="font-bold text-stone-900">${item.qty}</span>
                                <button onclick="updateQty(${index}, 1)" class="text-amber-900 font-bold">+</button>
                                <button onclick="removeItem(${index})" class="text-red-400 text-xs ml-2">Hapus</button>
                            </div>
                        </div>
                    </div>
                `;
            });

            const ppn = subtotal * 0.10;
            document.getElementById('subtotal-display').innerText = 'Rp' + subtotal.toLocaleString('id-ID');
            document.getElementById('ppn-display').innerText = 'Rp' + ppn.toLocaleString('id-ID');
            document.getElementById('total-display').innerText = 'Rp' + (subtotal + ppn).toLocaleString('id-ID');
        }

        // ============ Buka modal Edit untuk item tertentu ============
        function openEditModal(index) {
            const cart = getCart();
            const item = cart[index];
            if (!item) return;

            editingIndex = index;
            editingItem = item;
            editQty = item.qty || 1;

            document.getElementById('edit-item-name').innerText = item.nama;
            document.getElementById('edit-item-price').innerText = 'Rp' + (parseInt(item.baseHarga) || 0).toLocaleString('id-ID');
            document.getElementById('edit-qty-count').innerText = editQty;
            document.getElementById('edit-item-notes').value = item.notes || '';

            // Set pilihan sesuai data item yang sudah tersimpan (fallback ke default)
            document.querySelector(`input[name="edit_temp_opt"][value="${item.temp || 'Ice'}"]`)?.setAttribute('checked', 'checked');
            document.querySelectorAll('input[name="edit_temp_opt"]').forEach(el => el.checked = (el.value === (item.temp || 'Ice')));
            document.querySelectorAll('input[name="edit_sugar_opt"]').forEach(el => el.checked = (el.value === (item.sugar || 'Normal Sugar')));
            document.querySelectorAll('input[name="edit_size_opt"]').forEach(el => el.checked = (el.value === (item.size || 'Reguler')));
            document.querySelectorAll('input[name="edit_milk_opt"]').forEach(el => el.checked = (el.value === (item.milk || 'Milk')));
            document.querySelectorAll('input[name="edit_topping_opt"]').forEach(el => {
                el.checked = (item.toppings || []).includes(el.value);
            });

            const tipe = item.tipe || 'drink';
            const kategori = item.kategori || '';

            // Tampilkan/sembunyikan grup berdasarkan tipe (food = tanpa drink options sama sekali)
            const groups = ['edit-temp-group', 'edit-sugar-group', 'edit-size-group', 'edit-milk-group', 'edit-topping-group'];
            groups.forEach(gid => {
                document.getElementById(gid).style.display = (tipe === 'food') ? 'none' : 'block';
            });

            // Untuk kategori "Kopi Panas" & "Es Kopi": sembunyikan grup Temperature saja
            if (isHotCoffeeKategori(kategori) || isIceCoffeeKategori(kategori)) {
                document.getElementById('edit-temp-group').style.display = 'none';
            }

            calculateEditTotal();
            document.getElementById('edit-options-modal').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('edit-options-modal').style.display = 'none';
            editingIndex = null;
            editingItem = null;
        }

        function calculateEditTotal() {
            if (!editingItem) return;

            let baseHarga = parseInt(editingItem.baseHarga) || 0;
            let tambahanHarga = 0;

            document.querySelectorAll('#edit-options-modal input:checked').forEach(input => {
                tambahanHarga += parseInt(input.getAttribute('data-price')) || 0;
            });

            let totalPerItem = baseHarga + tambahanHarga;
            let finalTotal = totalPerItem * editQty;

            document.getElementById('edit-total-display').innerText = 'Rp' + finalTotal.toLocaleString('id-ID');
            document.getElementById('edit-submit-btn').innerText = 'Simpan Perubahan - Rp' + finalTotal.toLocaleString('id-ID');
        }

        function changeEditQty(delta) {
            editQty = Math.max(1, editQty + delta);
            document.getElementById('edit-qty-count').innerText = editQty;
            calculateEditTotal();
        }

        // ============ Simpan hasil edit ke item cart yang sama (update in place) ============
        function saveEditToCart() {
            if (editingIndex === null || !editingItem) return;

            const tipe = editingItem.tipe || 'drink';
            const kategori = editingItem.kategori || '';

            let selectedTemp = null;
            let selectedSugar = null;
            let selectedSize = null;
            let selectedMilk = null;
            let selectedToppings = [];
            let tambahanHarga = 0;

            if (tipe === 'drink') {
                const tempGroupVisible = document.getElementById('edit-temp-group').style.display !== 'none';
                selectedTemp = tempGroupVisible
                    ? (document.querySelector('input[name="edit_temp_opt"]:checked')?.value || null)
                    : null;
                selectedSugar = document.querySelector('input[name="edit_sugar_opt"]:checked')?.value || null;

                const sizeEl = document.querySelector('input[name="edit_size_opt"]:checked');
                if (sizeEl) {
                    selectedSize = sizeEl.value;
                    tambahanHarga += parseInt(sizeEl.getAttribute('data-price')) || 0;
                }

                const milkEl = document.querySelector('input[name="edit_milk_opt"]:checked');
                if (milkEl) {
                    selectedMilk = milkEl.value;
                    tambahanHarga += parseInt(milkEl.getAttribute('data-price')) || 0;
                }

                document.querySelectorAll('input[name="edit_topping_opt"]:checked').forEach(el => {
                    selectedToppings.push(el.value);
                    tambahanHarga += parseInt(el.getAttribute('data-price')) || 0;
                });
            }

            const notes = document.getElementById('edit-item-notes').value;
            const finalPricePerItem = (parseInt(editingItem.baseHarga) || 0) + tambahanHarga;

            const cart = getCart();
            cart[editingIndex] = {
                ...cart[editingIndex],
                finalPrice: finalPricePerItem,
                qty: editQty,
                temp: selectedTemp,
                sugar: selectedSugar,
                size: selectedSize,
                milk: selectedMilk,
                toppings: selectedToppings,
                notes: notes,
                kategori: kategori,
                tipe: tipe
            };

            saveCart(cart);
            closeEditModal();
        }

        // Jalankan saat load
        renderCart();
    </script>
</body>
</html>