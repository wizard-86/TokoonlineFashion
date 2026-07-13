document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');
    const cartRows = document.querySelectorAll('.cart-row');

    cartRows.forEach(row => {
        const editToggle = row.querySelector('.cart-edit-toggle');
        const cancelEdit = row.querySelector('.cart-cancel-edit');
        const quantityInput = row.querySelector('.quantity-input');
        const quantityIncrease = row.querySelector('.quantity-increase');
        const quantityDecrease = row.querySelector('.quantity-decrease');
        const sizeSelect = row.querySelector('.cart-edit-size');
        const hiddenQuantity = row.querySelector('.cart-edit-form input[name="quantity"]');
        const hiddenSize = row.querySelector('.cart-edit-form input[name="size"]');
        const viewQuantity = row.querySelector('.cart-view-quantity');
        const viewSize = row.querySelector('.cart-view-size');
        const editQuantity = row.querySelector('.cart-edit-quantity');
        const editActions = row.querySelector('.cart-edit-actions');

        if (!editToggle || !cancelEdit || !quantityInput || !hiddenQuantity || !hiddenSize) {
            return;
        }

        const syncInputs = () => {
            hiddenQuantity.value = quantityInput.value;
            hiddenSize.value = sizeSelect?.value || hiddenSize.value;
        };

        const showEditMode = () => {
            viewQuantity.classList.add('d-none');
            viewSize.classList.add('d-none');
            editQuantity.classList.remove('d-none');
            sizeSelect?.classList.remove('d-none');
            editActions.classList.remove('d-none');
            editToggle.classList.add('d-none');
            syncInputs();
        };

        const hideEditMode = () => {
            viewQuantity.classList.remove('d-none');
            viewSize.classList.remove('d-none');
            editQuantity.classList.add('d-none');
            sizeSelect?.classList.add('d-none');
            editActions.classList.add('d-none');
            editToggle.classList.remove('d-none');
        };

        editToggle.addEventListener('click', showEditMode);
        cancelEdit.addEventListener('click', hideEditMode);

        quantityIncrease.addEventListener('click', () => {
            const nextValue = Math.max(1, Math.min(Number(quantityInput.value || 1) + 1, Number(quantityInput.max || 999)));
            quantityInput.value = nextValue;
            syncInputs();
        });

        quantityDecrease.addEventListener('click', () => {
            const nextValue = Math.max(1, Number(quantityInput.value || 1) - 1);
            quantityInput.value = nextValue;
            syncInputs();
        });

        quantityInput.addEventListener('input', syncInputs);
        sizeSelect?.addEventListener('change', syncInputs);
    });
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.padding = '10px 0';
                navbar.style.background = 'rgba(10, 10, 10, 0.95) !important';
            } else {
                navbar.style.padding = '20px 0';
                navbar.style.background = 'rgba(15, 15, 15, 0.8) !important';
            }
        });
    }

    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach(el => {
        observer.observe(el);
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    const productDetailModal = document.getElementById('productDetailModal');
    const productDetailModalBody = document.getElementById('productDetailModalBody');
    const cartToastContainer = document.getElementById('cartToastContainer');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    function showToast(type, message) {
        if (!cartToastContainer) {
            return;
        }

        const toast = document.createElement('div');
        toast.className = 'toast show border-0 shadow-lg';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        toast.style.maxWidth = '420px';
        toast.style.width = '420px';
        toast.style.backgroundColor = type === 'success' ? '#ffffff' : '#ffffff';
        toast.style.color = type === 'success' ? '#198754' : '#dc3545';
        toast.style.borderLeft = `6px solid ${type === 'success' ? '#198754' : '#dc3545'}`;
        toast.innerHTML = `
            <div class="d-flex align-items-center p-3">
                <div class="me-3">
                    <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'} fs-4"></i>
                </div>
                <div class="toast-body p-0 fw-semibold">${message}</div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        cartToastContainer.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast, { delay: 3000 });
        bsToast.show();
        toast.addEventListener('hidden.bs.toast', () => toast.remove());
    }

    document.querySelectorAll('[data-product-detail-url]').forEach(trigger => {
        trigger.addEventListener('click', function (event) {
            event.preventDefault();

            fetch(this.getAttribute('data-product-detail-url'))
                .then(response => response.text())
                .then(html => {
                    if (productDetailModalBody) {
                        productDetailModalBody.innerHTML = html;
                    }

                    if (productDetailModal) {
                        const modal = new bootstrap.Modal(productDetailModal);
                        modal.show();
                    }
                });
        });
    });

    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (!form.matches('[data-product-modal-form="true"]')) {
            return;
        }

        event.preventDefault();

        const formData = new FormData(form);
        const url = form.getAttribute('action');

        fetch(url, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken || ''
            },
            body: formData
        })
            .then(async response => {
                const payload = await response.json().catch(() => null);

                if (!response.ok) {
                    throw new Error(payload?.message || 'Terjadi kesalahan saat menambahkan ke keranjang.');
                }

                showToast('success', payload?.message || 'Produk berhasil ditambahkan ke keranjang!');
                const cartCount = document.querySelector('[data-cart-count]');
                if (cartCount && payload?.cart_count !== undefined) {
                    cartCount.textContent = payload.cart_count;
                }
            })
            .catch(error => {
                showToast('error', error.message || 'Gagal menambahkan produk ke keranjang.');
            });
    });
});
