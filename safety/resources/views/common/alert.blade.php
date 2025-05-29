@if (session('success'))
    <div class="alert alert-primary alert-dismissible alert-solid alert-label-icon fade show" role="alert">
        <i class="ri-check-double-line label-icon"></i><strong>{!! session('success') !!}</strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('fail'))
    <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
        <i class="ri-error-warning-line label-icon"></i><strong>{!! session('fail') !!}</strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
            <i class="ri-error-warning-line label-icon"></i><strong>{{ $error }}</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endforeach
@endif
