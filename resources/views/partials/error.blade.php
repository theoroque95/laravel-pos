@if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div><strong>Error! </strong> {{ $error }}</div>
        @endforeach
    </div>
@endif