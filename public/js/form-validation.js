document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('post-form');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        let isValid = true;
        const title = document.getElementById('name');
        const slug = document.getElementById('slug');
        const feedback = document.createElement('div');
        feedback.className = 'alert alert-danger mt-2';
        
        // Clear previous error messages
        document.querySelectorAll('.validation-feedback').forEach(el => el.remove());

        // Validate title
        if (title.value.trim().length < 3) {
            isValid = false;
            const titleFeedback = feedback.cloneNode();
            titleFeedback.textContent = 'Title must be at least 3 characters long';
            titleFeedback.className = 'validation-feedback alert alert-danger mt-2';
            title.parentNode.appendChild(titleFeedback);
        }

        // Validate slug
        if (slug.value.trim().length < 3) {
            isValid = false;
            const slugFeedback = feedback.cloneNode();
            slugFeedback.textContent = 'URL must be at least 3 characters long';
            slugFeedback.className = 'validation-feedback alert alert-danger mt-2';
            slug.parentNode.appendChild(slugFeedback);
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Auto-generate slug from title
    const titleInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function() {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        });
    }
});
