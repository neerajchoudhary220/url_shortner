@if (session('error'))
<div class="alert alert-danger alert-msg mt-3">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success alert-msg mt-3">
    {{ session('success') }}
</div>
@endif

