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
    const imagePreview = document.getElementById('mediaPreviewImage');
    const videoPreview = document.getElementById('mediaPreviewVideo');
    const filePreview = document.getElementById('mediaPreviewFile');
    const fileNameSpan = document.getElementById('fileName');

    // Reset preview
    imagePreview.style.display = 'none';
    videoPreview.style.display = 'none';
    filePreview.style.display = 'none';

    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileType = file.type;

        if (fileType.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else if (fileType.startsWith('video/')) {
            const videoUrl = URL.createObjectURL(file);
            videoPreview.querySelector('source').src = videoUrl;
            videoPreview.load();
            videoPreview.style.display = 'block';
        } else {
            fileNameSpan.textContent = file.name;
            filePreview.style.display = 'flex';
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

$(document).ready(function () {
    const textArray = ["Hey, I'm Tim.", "I like JavaScript.", "I love to Develop.", "I like this Typewriter."];
    const $typeWriterElement = $('#typewriter');

    let textIndex = 0;
    let charIndex = 0;
    let isDeleting = false;

    function typeEffect() {
        const currentText = textArray[textIndex];
        if (!isDeleting) {
            $typeWriterElement.text(currentText.substring(0, charIndex + 1));
            charIndex++;

            if (charIndex === currentText.length) {
                isDeleting = true;
                setTimeout(typeEffect, 1500);
                return;
            }
        } else {
            $typeWriterElement.text(currentText.substring(0, charIndex - 1));
            charIndex--;

            if (charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % textArray.length;
            }
        }

        setTimeout(typeEffect, isDeleting ? 60 : 120);
    }

    setTimeout(typeEffect, 500);
});
