document.getElementById('toggleSidebar').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('d-none');
});
function previewAvatar(event) {
    const input = event.target;
    const preview = document.getElementById('avatarPreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function previewMedia(event) {
    const input = event.target;
    const preview = document.getElementById('mediaPreview');

    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileType = file.type;

        if (fileType.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        const alerts = document.querySelectorAll('#alert-success, #alert-error');

        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 1000);
});
