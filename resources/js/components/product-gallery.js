// Product Gallery functionality
export function initProductGallery() {
    // Change main product image
    window.changeMainImage = function(imageSrc) {
        const mainImage = document.getElementById('mainImage');
        if (mainImage) {
            mainImage.src = imageSrc;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('border-yellow-600');
                thumb.classList.add('border-transparent');
            });

            const activeThumbnail = document.querySelector(`img[src="${imageSrc}"]`);
            if (activeThumbnail) {
                activeThumbnail.classList.remove('border-transparent');
                activeThumbnail.classList.add('border-yellow-600');
            }
        }
    };

    // Image zoom functionality
    const mainImage = document.getElementById('mainImage');
    if (mainImage) {
        mainImage.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const xPercent = (x / rect.width) * 100;
            const yPercent = (y / rect.height) * 100;

            this.style.transformOrigin = `${xPercent}% ${yPercent}%`;
        });

        mainImage.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.5)';
            this.style.cursor = 'zoom-in';
        });

        mainImage.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }
}

// Initialize on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initProductGallery);
} else {
    initProductGallery();
}
