@if (Session::has('success'))
<!-- Alerts-->
<div class="alert alert-success alert-dismissible fade show non-printable" role="alert">
    <strong>Successfully Done!</strong> {{ Session::get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissible fade show non-printable" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
        <li> {{ $error }}</li>
        @endforeach
    </ul>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show non-printable" role="alert">
    <ul>

        <li> {{ Session::get('error') }}</li>

    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif


