<header>
    
<div class="max-w-lg mx-auto">

    @if(session()->has('success'))
        <div class="alert alert-success text-center mb-5" role="alert">
            {{ session('success')}}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger text-center mb-5" role="alert">
            {{ session('error')}}
        </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>