@if(session('flash-message'))
    <div id="flash-message" class="alert alert-success">
        {{ session('flash-message') }}
    </div>
@endif

@section('scripts')
<script>
    window.onload = function() {
        const flashMessage = document.getElementById("flash-message");
        if (flashMessage) {
            setTimeout(function() {
                flashMessage.classList.add("fade-out");

                setTimeout(function() {
                    flashMessage.style.display = "none";
                }, 1000);
            }, 3000);
        }
    };
</script>
@endsection