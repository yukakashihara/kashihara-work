document.addEventListener('click', function (e) {
    if (e.target.closest('.cart-btn')) {
        const productId = e.target.closest('.cart-btn').dataset.productId;

        fetch('/cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ product_id: productId }),
        })
            .then(function (response) {
                if (response.status === 422) {
                    alert('この商品は在庫切れです。');
                    return;
                }
                if (response.ok) {
                    response.json().then(function (data) {
                        alert('商品をカートに追加しました。');
                        document.getElementById('cart-total-price').textContent = data.tax_included_total.toLocaleString();

                        // カート追加ボタンを数量表示に切り替え
                        const cartBtn = e.target.closest('.cart-btn');
                        if (cartBtn) {
                            cartBtn.outerHTML = `
                        <div class="d-flex align-items-center justify-content-between border rounded-pill px-3 py-1 mb-2" id="cart-item-${productId}">
                    <button type="button" class="cart-remove-btn btn btn-link p-0 text-danger" data-product-id="${productId}">🗑️</button>
                    <span id="cart-quantity-${productId}">1</span>
                    <button type="button" class="cart-plus-btn btn btn-link p-0 text-dark" data-product-id="${productId}">＋</button>
                    </div>
                 `;
                        }
                    });
                }
            });
    }
});

// 🗑️削除ボタン
document.addEventListener('click', function (e) {
    if (e.target.closest('.cart-remove-btn')) {
        const productId = e.target.closest('.cart-remove-btn').dataset.productId;

        fetch('/cart/' + productId, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        })
            .then(function (response) {
                if (response.ok) {
                    response.json().then(function (data) {
                        // 数量コントローラーをカートに追加ボタンに戻す
                        const cartItem = document.getElementById('cart-item-' + productId);
                        if (cartItem) {
                            cartItem.outerHTML = `
                        <button type="button" class="cart-btn btn btn-dark rounded-0 w-100 mb-2" data-product-id="${productId}">
                            カートに追加
                        </button>
                        `;
                        }
                        document.getElementById('cart-total-price').textContent = data.tax_included_total.toLocaleString();
                    });
                }
            });
    }
});

// 数量変更ボタン
document.addEventListener('click', function (e) {
    if (e.target.closest('.cart-plus-btn')) {
        const productId = e.target.closest('.cart-plus-btn').dataset.productId;
        const quantityEl = document.getElementById('cart-quantity-' + productId);
        const newQuantity = parseInt(quantityEl.textContent) + 1;

        fetch('/cart/' + productId, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ quantity: newQuantity }),
        })
            .then(function (response) {
                if (response.status === 422) {
                    alert('在庫が不足しています。');
                    return;
                }
                if (response.ok) {
                    response.json().then(function (data) {
                        quantityEl.textContent = newQuantity;
                        document.getElementById('cart-total-price').textContent = data.tax_included_total.toLocaleString();

                        // 数量に応じてボタンを切り替え
                        const leftBtn = quantityEl.previousElementSibling;
                        if (newQuantity >= 2) {
                            leftBtn.outerHTML = `<button type="button" class="cart-minus-btn btn btn-link p-0 text-dark" data-product-id="${productId}">－</button>`;
                        }
                    });
                }
            });
    }
});

// －数量減少ボタン
document.addEventListener('click', function (e) {
    if (e.target.closest('.cart-minus-btn')) {
        const productId = e.target.closest('.cart-minus-btn').dataset.productId;
        const quantityEl = document.getElementById('cart-quantity-' + productId);
        const newQuantity = parseInt(quantityEl.textContent) - 1;

        fetch('/cart/' + productId, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ quantity: newQuantity }),
        })
            .then(function (response) {
                if (response.ok) {
                    response.json().then(function (data) {
                        quantityEl.textContent = newQuantity;
                        document.getElementById('cart-total-price').textContent = data.tax_included_total.toLocaleString();

                        // 数量1になったら－を🗑️に切り替え
                        const leftBtn = quantityEl.previousElementSibling;
                        if (newQuantity === 1) {
                            leftBtn.outerHTML = `<button type="button" class="cart-remove-btn btn btn-link p-0 text-danger" data-product-id="${productId}">🗑️</button>`;
                        }
                    });
                }
            });
    }
});