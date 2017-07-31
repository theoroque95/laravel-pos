@if (Session::has('notification'))
<div class="alert alert-success">
    <strong>Success!</strong> <span>{{ Session::get('notification') }}</span>
</div>
@endif