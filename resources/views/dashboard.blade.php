@extends('backend.app')

@section('title', 'Dashboard')

@include('backend.navbar_top')

@section('content')
    <div id="app">
        <div class="container typewriter-container">
            <span id="typewriter"></span><span class="cursor">|</span>
        </div>
    </div>
@endsection
<style>
    .typewriter-container {
        font-size: 2rem;
    }

    .cursor {
        display: inline-block;
        margin-left: 5px;
        animation: blink 0.7s infinite;
    }

    @keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }
</style>
@push('scripts')
    <script>
        $(document).ready(function () {
            const textArray = ["Chào, tôi là Hoàng Long.", "Tôi thích JavaScript, PHP.", "Tôi yêu lập trình.", "Tôi thích viết những thứ hay ho."];
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
    </script>
@endpush

