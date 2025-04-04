// Document Ready
document.addEventListener('DOMContentLoaded', function() {
    // Update cart count
    updateCartCount();
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});

// Cart Functions
function updateCartCount() {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        fetch('ajax/get_cart_count.php')
            .then(response => response.json())
            .then(data => {
                cartCount.textContent = data.count;
                if (data.count > 0) {
                    cartCount.style.display = 'block';
                } else {
                    cartCount.style.display = 'none';
                }
            });
    }
}

function addToCart(productId, quantity = 1) {
    fetch('ajax/add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartCount();
            showAlert('success', 'Sản phẩm đã được thêm vào giỏ hàng');
        } else {
            showAlert('danger', data.message);
        }
    });
}

function removeFromCart(productId) {
    fetch('ajax/remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartCount();
            document.querySelector(`#cart-item-${productId}`).remove();
            updateCartTotal();
            showAlert('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
        } else {
            showAlert('danger', data.message);
        }
    });
}

function updateCartQuantity(productId, quantity) {
    if (quantity > 0) {
        fetch('ajax/update_cart_quantity.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount();
                updateCartTotal();
            } else {
                showAlert('danger', data.message);
            }
        });
    } else {
        removeFromCart(productId);
    }
}

function updateCartTotal() {
    fetch('ajax/get_cart_total.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('.cart-total').textContent = data.total;
        });
}

// Alert Functions
function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const alertContainer = document.querySelector('.alert-container');
    if (alertContainer) {
        alertContainer.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
}

// Form Validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (form) {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                event.preventDefault();
                showAlert('danger', 'Vui lòng điền đầy đủ thông tin');
            }
        });
    }
}

// Search Function
function searchProducts(query) {
    if (query.length >= 2) {
        fetch(`ajax/search_products.php?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                const resultsContainer = document.querySelector('.search-results');
                if (resultsContainer) {
                    resultsContainer.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(product => {
                            const productElement = document.createElement('div');
                            productElement.className = 'search-result-item';
                            productElement.innerHTML = `
                                <a href="product.php?id=${product.id}">
                                    <img src="assets/images/products/${product.image}" alt="${product.name}">
                                    <div>
                                        <h6>${product.name}</h6>
                                        <p>${product.price}</p>
                                    </div>
                                </a>
                            `;
                            resultsContainer.appendChild(productElement);
                        });
                    } else {
                        resultsContainer.innerHTML = '<p class="text-muted">Không tìm thấy sản phẩm</p>';
                    }
                }
            });
    }
}

// Image Preview
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (preview && input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Password Strength Check
function checkPasswordStrength(password) {
    const strength = {
        0: "Rất yếu",
        1: "Yếu",
        2: "Trung bình",
        3: "Mạnh",
        4: "Rất mạnh"
    };
    
    let score = 0;
    if (password.length >= 8) score++;
    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) score++;
    if (password.match(/\d/)) score++;
    if (password.match(/[^a-zA-Z\d]/)) score++;
    
    return strength[score];
}

// Quantity Input
function incrementQuantity(inputId) {
    const input = document.getElementById(inputId);
    if (input) {
        input.value = parseInt(input.value) + 1;
    }
}

function decrementQuantity(inputId) {
    const input = document.getElementById(inputId);
    if (input && input.value > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

// Smooth Scroll
function smoothScroll(target) {
    const element = document.querySelector(target);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth'
        });
    }
}

// Lazy Loading Images
document.addEventListener('DOMContentLoaded', function() {
    const lazyImages = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });
    
    lazyImages.forEach(img => imageObserver.observe(img));
}); 