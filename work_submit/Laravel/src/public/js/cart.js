document.querySelectorAll('.cart-btn').forEach(function (button) {
    button.addEventListener('click', function () {
        const productId = this.dataset.productId;

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
                    });
                }
            });
    });
}); 
