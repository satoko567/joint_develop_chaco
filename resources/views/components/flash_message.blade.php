@if (session('success'))
    <div>
        <span style="background-color: #99FFFF;">
            {{ session('success') }}
        </span>
    </div>
@endif

@if (session('error'))
    <div>
        <span style="background-color: #FFCCCC;">
            {{ session('error') }}
        </span>
    </div>
@endif
