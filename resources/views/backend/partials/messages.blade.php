@if ($errors->any())
    <div class="alert alert-danger">
        <div>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>
@endif