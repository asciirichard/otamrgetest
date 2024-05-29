<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Datatables -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script type="text/javascript" src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body class="container">
<div class="row">
    <header class="col-md-10 mb-5">

        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">

                <a
                    href="{{ url('/') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Home
                </a>

                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main class="col-md-12 mb-5">
        <h1>{!! $position->name !!}</h1>

        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-subtitle mb-2">{!! $position->company->company_name !!}</h2>
                            <h5 class="card-subtitle mb-2 text-muted">{!! ucfirst($position->employmentType->employment_type) !!}</h5>
                            <a href="#" onclick="return alert('Coming soon.')" class="link">Apply</a>

                            <hr />

                            <ul>
                                <li>Office: <b>{!! $position->office->office_name !!}</b></li>
                                <li>Department: <b>{!! $position->department->department_name !!}</b></li>
                                <li>Category: <b>{!! $position->recruitingCategory->recruiting_category_name !!}</b></li>
                                <li>Seniority: <b>{!! ucfirst($position->seniority->seniority) !!}</b></li>
                                <li>Years of Experience: <b>{!! $position->years_from !!} - {!! $position->years_to !!} years</b></li>
                                <li>Schedule: <b>{!! ucfirst($position->schedule->schedule) !!}</b></li>
                            </ul>

                            <hr />

                            @foreach($position->jobDescriptions as $d)
                                <p class="card-text fw-semibold mb-1">{!! $d->name !!}</p>
                                <p class="card-text">{!! $d->value !!}</p>
                            @endforeach

                            <hr />

                            <p class="card-text text-muted">
                            {!! $position->jobKeywords->pluck('keyword')->implode(', ') !!}
                            </p>

                            <a href="#" onclick="return alert('Coming soon.')" class="link">Apply</a>
                        </div>
                    </div>
                </div>
        </div>

    </main>

    <footer class="col-md-10">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</div>
</body>
</html>
