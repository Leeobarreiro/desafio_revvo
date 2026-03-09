document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('welcomeModal');
    const closeBtn = document.getElementById('closeModal');

    if (closeBtn && modal) {
        closeBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    }
});