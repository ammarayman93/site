let cart = [];

function addToCart(id, name, price) {
    cart.push({ id, name, price });
    updateCart();
}

function updateCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCart() {
    const cartData = localStorage.getItem('cart');
    if (cartData) {
        cart = JSON.parse(cartData);
    }
}

function checkout() {
    $.ajax({
        url: 'pages/checkout.php',
        method: 'POST',
        data: { cart: JSON.stringify(cart) },
        success: function(response) {
            alert('تمت عملية الشراء بنجاح!');
            cart = [];
            updateCart();
        },
        error: function() {
            alert('حدث خطأ أثناء عملية الشراء.');
        }
    });
}

$(document).ready(function() {
    loadCart();
});