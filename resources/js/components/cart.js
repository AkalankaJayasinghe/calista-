// Shopping Cart functionality
export function initCart() {
    // Update quantity
    window.updateQuantity = function(itemId, change) {
        const quantityElement = document.querySelector(`[data-item-id="${itemId}"] .quantity`);
        if (quantityElement) {
            let currentQty = parseInt(quantityElement.textContent);
            currentQty = Math.max(1, currentQty + change);
            quantityElement.textContent = currentQty;

            // Update total price
            updateItemTotal(itemId, currentQty);
            updateCartTotal();
        }
    };

    // Remove item from cart
    window.removeItem = function(itemId) {
        if (confirm('Are you sure you want to remove this item?')) {
            const itemElement = document.querySelector(`[data-item-id="${itemId}"]`);
            if (itemElement) {
                itemElement.remove();
                updateCartTotal();
            }
        }
    };

    // Update item total
    function updateItemTotal(itemId, quantity) {
        // Implementation for updating individual item total
        console.log(`Updating item ${itemId} with quantity ${quantity}`);
    }

    // Update cart total
    function updateCartTotal() {
        // Implementation for updating cart total
        console.log('Updating cart total');
    }
}

// Initialize on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCart);
} else {
    initCart();
}
