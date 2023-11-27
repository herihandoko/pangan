@if (session('success'))
    <div class="alert alert-success m-b-10">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger m-b-10">
        {{ session('error') }}
    </div>
@endif
