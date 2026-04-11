<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzes - Quiz System</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Space+Grotesk:wght@500;700&display=swap');

        :root {
            --page-bg: #ecf4ea;
            --frame-bg: #f6faf2;
            --hero-bg: #45bb67;
            --hero-bg-dark: #33a958;
            --ink: #06110b;
            --ink-soft: #244437;
            --pill: #e9f7ed;
            --line: rgba(9, 27, 17, 0.14);
            --white: #ffffff;
            --yellow: #f7df43;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Manrope', sans-serif;
            background:
                radial-gradient(circle at 10% 10%, #f9ffef 0%, #ecf4ea 48%, #e2efde 100%);
            color: var(--ink);
            min-height: 100vh;
            padding: 1rem;
        }

        /* .landing-frame {
            width: min(1180px, 100%);
            margin: 0 auto;
            border-radius: 18px;
            background: transparent;
            border: 1px solid #d2e8cc;
            box-shadow: 0 22px 60px rgba(32, 69, 42, 0.16);
            overflow: hidden;
        } */

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1.1rem 1.5rem;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            color: var(--ink);
            text-decoration: none;
            font-weight: 800;
            font-size: 0.95rem;
        }

        .brand-mark {
            width: 1.6rem;
            height: 1.1rem;
            border-radius: 999px;
            background: linear-gradient(135deg, #0f1d13, #273e2f);
            position: relative;
        }

        .brand-mark::before,
        .brand-mark::after {
            content: '';
            position: absolute;
            background: #ffffff;
            width: 0.22rem;
            height: 0.22rem;
            border-radius: 999px;
            top: 50%;
            transform: translateY(-50%);
        }

        .brand-mark::before {
            left: 0.45rem;
        }

        .brand-mark::after {
            left: 0.9rem;
        }

        .top-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .top-links a {
            text-decoration: none;
            color: #1a2f23;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .top-links .cta {
            border: 1px solid #1f3528;
            border-radius: 999px;
            padding: 0.55rem 1rem;
            background: var(--white);
        }

        .hero {
            background: linear-gradient(180deg, var(--hero-bg), var(--hero-bg-dark));
            margin: 0 0.7rem;
            border-radius: 14px;
            padding: 2.6rem 2.2rem;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 2rem;
            position: relative;
            overflow: hidden;
            animation: reveal 620ms ease;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 22rem;
            height: 22rem;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.17), rgba(255, 255, 255, 0));
            right: -6rem;
            top: -7rem;
        }

        .hero-left {
            position: relative;
            z-index: 2;
        }

        .story-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            font-weight: 800;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .story-badge small {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--ink-soft);
            margin-top: 0.1rem;
        }

        .hero-title {
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.9rem, 7vw, 5.2rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
        }

        .hero-copy {
            margin: 1.3rem 0;
            max-width: 29rem;
            font-size: 1.1rem;
            line-height: 1.5;
            color: #123422;
            font-weight: 500;
        }

        .hero-metrics {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            padding: 0.8rem 0;
            font-weight: 700;
            color: #112f20;
            margin-bottom: 1.1rem;
        }

        .hero-search {
            display: flex;
            gap: 0.6rem;
            width: min(36rem, 100%);
            margin-bottom: 1.3rem;
        }

        .hero-search input {
            flex: 1;
            border: 1px solid rgba(8, 29, 16, 0.25);
            border-radius: 999px;
            padding: 0.8rem 1rem;
            background: rgba(255, 255, 255, 0.96);
            font: inherit;
            color: #163724;
        }

        .hero-search button {
            border: none;
            border-radius: 999px;
            background: #06110b;
            color: #ffffff;
            padding: 0.8rem 1.2rem;
            font-weight: 800;
            cursor: pointer;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .hero-actions a {
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 800;
            border-radius: 999px;
            padding: 0.66rem 1.1rem;
            border: 1px solid #193628;
            color: #0f281c;
            background: rgba(255, 255, 255, 0.32);
        }

        .hero-actions a.primary {
            background: #07110b;
            color: #ffffff;
            border-color: #07110b;
        }

        .hero-right {
            position: relative;
            min-height: 28rem;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            z-index: 2;
        }

        .portrait-card {
            width: min(22rem, 100%);
            height: 25.6rem;
            background: #c6ecf4;
            border-radius: 1.8rem;
            overflow: hidden;
            box-shadow: 0 18px 36px rgba(15, 47, 31, 0.24);
            animation: float 4.2s ease-in-out infinite;
        }

        .portrait-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .query-chip {
            position: absolute;
            left: -2.6rem;
            background: #ffffff;
            border-radius: 999px;
            min-width: 14rem;
            padding: 0.5rem 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 10px 22px rgba(18, 37, 27, 0.16);
            font-size: 0.86rem;
            font-weight: 700;
        }

        .query-chip b {
            width: 1.32rem;
            height: 1.32rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: #08120d;
            font-size: 0.73rem;
        }

        .chip-1 { top: 8.2rem; }
        .chip-2 { top: 11.2rem; }
        .chip-3 { top: 14.2rem; }
        .chip-4 { top: 17.2rem; }

        .metric-card {
            position: absolute;
            right: -0.7rem;
            bottom: 1.2rem;
            background: var(--yellow);
            border-radius: 1.1rem;
            padding: 0.85rem 1rem;
            width: 7.8rem;
            line-height: 1.15;
            box-shadow: 0 12px 20px rgba(30, 24, 0, 0.2);
        }

        .metric-card span {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .metric-card strong {
            display: block;
            margin: 0.35rem 0;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
        }

        .partners {
            margin: 0.8rem;
            border-radius: 12px;
            background: rgba(12, 125, 58, 0.3);
            padding: 1rem;
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 0.5rem;
            text-align: center;
        }

        .partners span {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: #112f20;
            font-size: clamp(1.1rem, 2vw, 1.55rem);
        }

        .content {
            width: min(1180px, 100%);
            margin: 1.2rem auto 0;
            padding: 0 0.2rem 2rem;
        }

        .panel {
            background: #ffffff;
            border: 1px solid #dcebdd;
            border-radius: 16px;
            padding: 1.2rem;
            box-shadow: 0 12px 36px rgba(19, 53, 31, 0.07);
        }

        .panel h2 {
            margin: 0 0 1rem;
            font-size: 1.25rem;
            font-family: 'Space Grotesk', sans-serif;
        }

        .results-grid,
        .category-grid {
            display: grid;
            gap: 0.85rem;
        }

        .result-card,
        .category-card {
            border: 1px solid #e2efe1;
            border-radius: 12px;
            padding: 0.9rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.8rem;
        }

        .result-card h3,
        .category-card h3 {
            margin: 0;
            font-size: 1rem;
            color: #122d20;
        }

        .result-card p,
        .category-card p {
            margin: 0.26rem 0 0;
            color: #4f6f5f;
            font-size: 0.86rem;
            font-weight: 600;
        }

        .result-card a,
        .category-card a,
        .search-clear {
            text-decoration: none;
            background: #08120c;
            color: #ffffff;
            padding: 0.48rem 0.92rem;
            border-radius: 999px;
            font-size: 0.81rem;
            font-weight: 800;
            white-space: nowrap;
        }

        .search-label {
            margin-bottom: 0.8rem;
            display: flex;
            gap: 0.6rem;
            align-items: center;
            color: #244838;
            font-weight: 700;
        }

        .empty {
            border: 1px dashed #c5dcc4;
            padding: 1.3rem;
            border-radius: 12px;
            text-align: center;
            color: #577364;
            font-weight: 700;
        }

        @media (max-width: 990px) {
            .top-links a:not(.cta) {
                display: none;
            }

            .hero {
                grid-template-columns: 1fr;
                padding: 2rem 1.3rem;
            }

            .hero-right {
                min-height: 22rem;
            }

            .query-chip {
                left: 0.6rem;
            }

            .chip-1 { top: 1.5rem; }
            .chip-2 { top: 4.25rem; }
            .chip-3 { top: 7rem; }
            .chip-4 { top: 9.75rem; }

            .partners {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                row-gap: 0.8rem;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 0.45rem;
            }

            .topbar {
                padding: 0.95rem;
            }

            .hero-search,
            .hero-actions,
            .result-card,
            .category-card {
                flex-direction: column;
                align-items: stretch;
            }

            .result-card a,
            .category-card a {
                text-align: center;
            }

            .query-chip {
                position: static;
                margin-top: 0.55rem;
                width: 100%;
            }

            .hero-right {
                min-height: auto;
                align-items: stretch;
            }

            .metric-card {
                right: 0.6rem;
                bottom: 0.8rem;
            }

            .portrait-card {
                height: 22rem;
            }
        }

        @keyframes reveal {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-8px);
            }
        }
    </style>
</head>
<body>
    <div class="landing-frame">
        <header class="topbar">
            <a href="/" class="brand">
                <span class="brand-mark" aria-hidden="true"></span>
                <span>/ QuizSystem</span>
            </a>

            <nav class="top-links">
                <a href="/">Product</a>
                <a href="/">Solutions</a>
                <a href="/">Pricing</a>
                <a href="/">Developers</a>
                <a href="/admin-login" class="cta">Log in</a>
            </nav>
        </header>

        <section class="hero">
            <div class="hero-left">
                <div class="story-badge">
                    20M+ User
                    <small>Read Our Success Stories</small>
                </div>

                <h1 class="hero-title">Quizzes</h1>
                <p class="hero-copy">
                    Attract customers and increase time on brand recall with polls, quizzes, and more.
                </p>

                <div class="hero-metrics">
                    <span>Chance to close deal <strong>4X</strong></span>
                    <span>/</span>
                    <span><strong>5.0</strong> rated</span>
                </div>

                <form action="/" method="GET" class="hero-search">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Search quiz by name"
                        autocomplete="off"
                    >
                    <button type="submit">Find Quiz</button>
                </form>

                <div class="hero-actions">
                    <a href="/" class="primary">Download - It's Free</a>
                    <a href="/">Our Pricing</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="portrait-card">
                    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=80" alt="Quiz engagement">
                </div>

                <div class="query-chip chip-1"><b>A</b> How is the fit?</div>
                <div class="query-chip chip-2"><b>B</b> Do you like the design?</div>
                <div class="query-chip chip-3"><b>C</b> What would you recommend?</div>
                <div class="query-chip chip-4"><b>D</b> Is it comfortable?</div>

                <div class="metric-card">
                    <span>UP TO</span>
                    <strong>40%</strong>
                    <span>increased user engagement</span>
                </div>
            </div>
        </section>

        <div class="partners">
            <span>Rakuten</span>
            <span>NCR</span>
            <span>monday.com</span>
            <span>Disney</span>
            <span>Dropbox</span>
        </div>
    </div>

    <main class="content">
        <section class="panel">
            @if($quizResults !== null)
                <div class="search-label">
                    <span>Results for "{{ $search }}"</span>
                    <a class="search-clear" href="/">Clear</a>
                </div>

                <h2>Quiz Results ({{ $quizResults->count() }})</h2>

                @if($quizResults->isEmpty())
                    <div class="empty">No quizzes matched "{{ $search }}". Try another keyword.</div>
                @else
                    <div class="results-grid">
                        @foreach($quizResults as $quiz)
                            <article class="result-card">
                                <div>
                                    <h3>{{ $quiz->name }}</h3>
                                    <p>Category: {{ optional($quiz->category)->name ?? '-' }}</p>
                                </div>
                                <a href="/quizzes/{{ $quiz->id }}">View Quiz</a>
                            </article>
                        @endforeach
                    </div>
                @endif
            @else
                <h2>Browse Categories ({{ $categories->count() }} {{ \Illuminate\Support\Str::plural('Category', $categories->count()) }})</h2>

                @if($categories->isEmpty())
                    <div class="empty">No categories available yet. Check back soon.</div>
                @else
                    <div class="category-grid">
                        @foreach($categories as $category)
                            <article class="category-card">
                                <div>
                                    <h3>{{ $category->name }}</h3>
                                    <p>{{ $category->quizzes_count }} {{ \Illuminate\Support\Str::plural('quiz', $category->quizzes_count) }} available</p>
                                </div>
                                <a href="/quizzes/category/{{ $category->id }}">Explore</a>
                            </article>
                        @endforeach
                    </div>
                @endif
            @endif
        </section>
    </main>
</body>
</html>
