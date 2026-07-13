document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');
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
