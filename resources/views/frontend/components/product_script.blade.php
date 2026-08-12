<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.heart-btn');
            if (!btn) return;
            const path = btn.querySelector('path');
            const liked = btn.dataset.liked === "true";
            if (liked) {
                // btn.classList.remove('bg-white');
                // btn.classList.add('bg-white');
                path.setAttribute('fill', 'white');
                btn.dataset.liked = "false";
            } else {
                // btn.classList.remove('bg-white');
                // btn.classList.add('bg-white');
                path.setAttribute('fill', 'red');
                btn.dataset.liked = "true";
            }
        });
        document.addEventListener('click', function(e) {
            const heart = e.target.closest('.heart-btn');
            if (!heart) return;
            e.preventDefault();
            e.stopPropagation();
            // prevent double click requests
            if (heart.dataset.loading === 'true') return;
            heart.dataset.loading = 'true';
            const productId = heart.dataset.productId;
            const path = heart.querySelector('path');
            fetch('/save-wishlist', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'unauthenticated') {
                        showToast("Please Sign In!", "error", 2000);
                        path.setAttribute('fill', 'white');
                    } else if (data.status === 'added') {
                        path.setAttribute('fill', 'red');
                        heart.dataset.liked = 'true';
                        showToast("Wishlist Added Successfully!", "success", 1000);
                    } else if (data.status === 'removed') {
                        path.setAttribute('fill', 'white');
                        heart.dataset.liked = 'false';
                        showToast("Wishlist Removed Successfully!", "success", 2000);
                    }
                })
                .finally(() => {
                    heart.dataset.loading = 'false';
                });
        });
    });
</script>
