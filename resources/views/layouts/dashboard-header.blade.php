<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <a href="{{ route('patient.form') }}" class="btn btn-primary">Add Patient</a>
            &nbsp;
            <a href="{{ route('list.patients') }}" class="btn btn-primary">My Patients</a>
        </div>
    </div>
</div>