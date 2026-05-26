document.querySelectorAll('.favorite-btn').forEach(function (button) {
    button.addEventListener('click', function () {
        const productId = this.dataset.productId;

        fetch('/favorites/' + productId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        })
            .then(function (response) {
                if (response.status === 401) {
                    response.json().then(function (data) {
                        window.location.href = data.redirect;
                    });
                    return;
                }
                if (response.ok) {
                    if (this.classList.contains('active')) {
                        this.classList.remove('active');
                        this.textContent = '♡';
                    } else {
                        this.classList.add('active');
                        this.textContent = '♥';
                    }
                }
            }.bind(this));
    });
});