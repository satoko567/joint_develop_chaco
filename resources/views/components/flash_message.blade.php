@if (session('success'))
    <div>
        <span style="background-color: #99FFFF;">
            {{ session('success') }}
        </span>
    </div>
@endif

@if (session('error'))
    <p>{{ session('error') }}</p>
@endif