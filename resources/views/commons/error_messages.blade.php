@if (count($errors) > 0)
    <div class="alert alert-danger w-75 mx-auto mb-3 text-left" role="alert">
       <ul class="mb-0 pl-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
       </ul>
    </div>
@endif