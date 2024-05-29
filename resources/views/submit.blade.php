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
        <header class="col-md-8 mb-5">

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

        <main class="col-md-8 mb-5">
            <h1>Submit Job Posting</h1>
            <form method="POST" action="{!! route('positions.submit') !!}" class="form">
                @csrf
                <div class="form-group mb-1">
                    <label for="email">Your Email Address</label>
                    <input class="form-control" name="email" id="email" type="email" required />
                </div>
                <div class="form-group mb-1">
                    <label for="company">Company</label>
                    <input class="form-control" name="company" id="company" required />
                </div>
                <div class="form-group mb-1">
                    <label for="office">Office</label>
                    <input class="form-control" name="office" id="office" required />
                </div>
                <div class="form-group mb-1">
                    <label for="department">Department</label>
                    <input class="form-control" name="department" id="department" required />
                </div>
                <div class="form-group mb-1">
                    <label for="recruitingCategory">Recruiting Category</label>
                    <input class="form-control" name="recruitingCategory" id="recruitingCategory" required />
                </div>
                <div class="form-group mb-1">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" id="name" required />
                </div>
                <!-- Job Description Here -->
                <div class="form-group mb-3">
                    <label for="employmentType">Employment Type</label>
                    <select class="form-control" name="employmentType" id="employmentType" required>
                        <option value="permanent">Permanent</option>
                        <option value="temporary">Temporary</option>
                        <option value="contractual">Contractual</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="seniority">Seniority</label>
                    <select class="form-control" name="seniority" id="seniority" required>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="experienced">Experienced</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="schedule">Schedule</label>
                    <select class="form-control" name="schedule" id="schedule" required>
                        <option value="part-time">Part-time</option>
                        <option value="full-time">Full-time</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="yearsOfExperience">Years Of Experience</label>
                    <input class="form-control" name="yearsOfExperience" id="yearsOfExperience" required placeholder="3-5" />
                    <small>Format should be {MinimumYear}-{MaximumYear}</small>
                </div>
                <!-- Keywords Here -->
                <div class="form-group mb-3">
                    <label for="occupation">Occupation</label>
                    <input class="form-control" name="occupation" id="occupation" required />
                </div>
                <div class="form-group mb-3">
                    <label for="occupationCategory">Occupation Category</label>
                    <input class="form-control" name="occupationCategory" id="occupationCategory" required />
                </div>

                <div class="form-group mb-3" id="descriptions">
                    <label>Job Description/s</label>
                    <div class="descriptions" id="description1">
                        <input class="form-control" name="descriptionNames[]" placeholder="e.g. Your Tasks:">
                        <textarea class="form-control" name="descriptionValues[]" placeholder="Your job description here..."></textarea>
                        <a href="#" onclick="return addDescription()">+ Add Description</a>
                    </div>
                </div>

                <div class="form-group mb-3" id="keywords">
                    <label>Job Keyword/s</label>
                    <div class="keywords" id="keyword1">
                        <input class="form-control" name="keywords[]">
                        <a href="#" onclick="return addKeyword()">+ Add Keyword</a>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-dark"><span>Submit</span></button>
                </div>

            </form>
        </main>

        <footer class="col-md-8">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>

        <script>

            var descriptionCount = 1;
            function addDescription()
            {
                descriptionCount++;
                let html = '<div class="descriptions" id="description' + descriptionCount + '">';
                html += '<input class="form-control" name="descriptionNames[]" placeholder="e.g. Your Tasks:">';
                html += '<textarea class="form-control" name="descriptionValues[]"></textarea>';
                html += '<a href="#" onclick="return addDescription()">+ Add Description</a>';
                html += ' | <a href="#" onclick="return removeDescription(' + descriptionCount + ')">+ Remove</a>'

                $("#descriptions").append(html);
                return false;

            }

            function removeDescription(count)
            {
                $("#description" + count).remove();
                descriptionCount--;

                return false;
            }

            var keywordCount = 1;
            function addKeyword()
            {
                keywordCount++;

                let html = '<div class="keywords" id="keyword' + keywordCount + '">';
                html += '<input class="form-control" name="keywords[]">';
                html += '<a href="#" onclick="return addKeyword()">+ Add Keyword</a>';
                html += ' | <a href="#" onclick="return removeKeyword(' + keywordCount + ')">+ Remove</a>'

                $("#keywords").append(html);
                return false;

            }

            function removeKeyword(count)
            {
                $("#keyword" + count).remove();
                keywordCount--;

                return false;
            }
        </script>
    </div>
</body>
</html>
