@if (session('flash_message'))
    <ul class="alert alert-success" role="alert">
        <li class="ml-4">{{ session('flash_message') }}</li>
    </ul>
@endif