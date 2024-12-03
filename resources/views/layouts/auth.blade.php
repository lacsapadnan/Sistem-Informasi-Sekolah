<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; {{ $pengaturan->name ?? config('app.name') }}</title>
    @include('includes.style')
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3">
                        <div class="login-brand">
                            <img src="{{ URL::asset($pengaturan->logo) ?? 'https://via.placeholder.com/300' }}" alt="logo" width="100" class="shadow-lights">
                            <p class="mt-4">{{ $pengaturan->name ?? config('app.name') }}</p>
                        </div>
                        @if(session()->has('info'))
                        <div class="alert alert-primary">
                            {{ session()->get('info') }}
                        </div>
                        @endif
                        @if(session()->has('status'))
                        <div class="alert alert-info">
                            {{ session()->get('status') }}
                        </div>
                        @endif
                        @yield('content')
                        <div class="simple-footer">
                            Copyright &copy; Pixel Overture {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('includes.style')
</body>
</html>
