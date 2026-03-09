<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Your Skill — Quiz System</title>
    @vite('resources/css/app.css')
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', 'Segoe UI', sans-serif; margin: 0; }

        /* ── Navbar ── */
        .user-nav {
            background: #4338ca;
            padding: 0 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 3.75rem;
            box-shadow: 0 2px 8px rgba(67,56,202,.25);
        }
        .user-nav .brand {
            display: flex; align-items: center; gap: 0.5rem;
            color: #fff; font-size: 1.125rem; font-weight: 700;
            text-decoration: none; letter-spacing: 0.02em;
        }
        .user-nav .brand:hover { color: #c7d2fe; }
        .nav-admin-link {
            font-size: 0.8125rem; font-weight: 600; color: #e0e7ff;
            text-decoration: none; padding: 0.4rem 0.9rem;
            border: 1.5px solid rgba(255,255,255,.35); border-radius: 0.4rem;
            transition: background .18s, border-color .18s;
        }
        .nav-admin-link:hover { background: rgba(255,255,255,.12); border-color: #fff; color: #fff; }

        /* ── Hero ── */
        .hero {
            background: linear-gradient(135deg, #4338ca 0%, #6366f1 50%, #818cf8 100%);
            padding: 4rem 1.25rem 3.5rem;
            text-align: center;
        }
        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.25rem); font-weight: 800;
            color: #fff; margin: 0 0 0.6rem; letter-spacing: -0.03em;
            text-shadow: 0 2px 12px rgba(0,0,0,.18);
        }
        .hero p {
            color: #c7d2fe; font-size: 1.0625rem; margin: 0 0 2rem;
        }

        /* ── Search ── */
        .search-wrap {
            display: flex; gap: 0; max-width: 540px; margin: 0 auto;
            border-radius: 0.65rem; overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,.22);
        }
        .search-input {
            flex: 1; padding: 0.875rem 1.125rem;
            border: none; outline: none;
            font-size: 0.9375rem; color: #1e293b; background: #fff;
        }
        .search-input::placeholder { color: #94a3b8; }
        .search-btn {
            padding: 0 1.5rem; background: #f59e0b; color: #fff;
            font-weight: 700; font-size: 0.9375rem; border: none; cursor: pointer;
            display: flex; align-items: center; gap: 0.45rem;
            transition: background .18s;
        }
        .search-btn:hover { background: #d97706; }

        /* ── Main Content ── */
        .main { max-width: 860px; margin: 0 auto; padding: 2.5rem 1.25rem 5rem; }

        /* ── Section Title ── */
        .section-title {
            font-size: 1.25rem; font-weight: 700; color: #1e293b;
            margin: 0 0 1.25rem;
            display: flex; align-items: center; gap: 0.6rem;
        }
        .section-title span.pill {
            font-size: 0.75rem; font-weight: 700;
            background: #eef2ff; color: #4f46e5;
            padding: 0.15rem 0.6rem; border-radius: 9999px;
        }

        /* ── Table Card ── */
        .table-card {
            background: #fff; border-radius: 0.875rem;
            box-shadow: 0 2px 8px rgba(0,0,0,.07), 0 8px 24px rgba(0,0,0,.05);
            overflow: hidden;
        }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead th {
            background: #f8fafc; padding: 0.8rem 1.25rem;
            text-align: left; font-size: 0.75rem; font-weight: 700;
            color: #64748b; text-transform: uppercase; letter-spacing: 0.06em;
            border-bottom: 1.5px solid #e2e8f0;
        }
        .data-table thead th:last-child { text-align: center; }
        .data-table tbody tr { transition: background .15s; }
        .data-table tbody tr:hover { background: #f8fafc; }
        .data-table tbody tr + tr { border-top: 1px solid #f1f5f9; }
        .data-table tbody td { padding: 0.9rem 1.25rem; vertical-align: middle; }
        .data-table tbody td:last-child { text-align: center; }

        .serial-badge {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.75rem; height: 1.75rem; border-radius: 50%;
            background: #eef2ff; color: #6366f1; font-size: 0.75rem; font-weight: 700;
        }
        .category-name-cell {
            font-weight: 600; color: #1e293b; font-size: 0.9375rem;
        }
        .quiz-count-badge {
            display: inline-flex; align-items: center;
            padding: 0.18rem 0.55rem; border-radius: 9999px;
            background: #dcfce7; color: #166534; font-size: 0.7rem; font-weight: 700;
            margin-left: 0.5rem;
        }
        .btn-view {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.4rem 1rem; font-size: 0.8125rem; font-weight: 600;
            background: #4f46e5; color: #fff; border: none; border-radius: 0.4rem;
            cursor: pointer; text-decoration: none;
            transition: background .18s, box-shadow .18s;
            box-shadow: 0 1px 4px rgba(79,70,229,.3);
        }
        .btn-view:hover { background: #4338ca; box-shadow: 0 3px 10px rgba(79,70,229,.4); }

        /* ── Quiz Results (search) ── */
        .result-card {
            background: #fff; border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.06);
            padding: 1.125rem 1.375rem; margin-bottom: 0.75rem;
            display: flex; align-items: center; justify-content: space-between;
            transition: box-shadow .18s;
        }
        .result-card:hover { box-shadow: 0 4px 18px rgba(79,70,229,.14); }
        .result-info h3 { margin: 0; font-size: 0.9375rem; font-weight: 700; color: #1e293b; }
        .result-info p  { margin: 0.2rem 0 0; font-size: 0.8rem; color: #64748b; }

        .empty-state {
            text-align: center; padding: 3rem 1rem;
            background: #fff; border-radius: 0.875rem;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }
        .empty-state p { color: #94a3b8; font-weight: 500; margin: 0.75rem 0 0; }

        /* Search clear tag */
        .search-tag {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: #eef2ff; color: #4338ca; font-size: 0.8125rem;
            font-weight: 600; padding: 0.3rem 0.8rem; border-radius: 9999px;
            margin-bottom: 1.25rem;
        }
        .search-tag a { color: #4338ca; text-decoration: none; font-size: 1rem; line-height:1; }
        .search-tag a:hover { color: #dc2626; }
    </style>
</head>
<body style="background: linear-gradient(160deg, #f1f5f9 0%, #e8eaf6 100%); min-height: 100vh;">

    {{-- Navbar --}}
    <nav class="user-nav">
        <a href="/" class="brand">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:1.5rem;height:1.5rem;color:#a5b4fc;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            Quiz System
        </a>
        <a href="/admin-login" class="nav-admin-link">Admin Login</a>
    </nav>

    {{-- Hero / Search --}}
    <div class="hero">
        <h1>Test Your Skill</h1>
        <p>Browse categories or search for a quiz to get started</p>

        <form action="/" method="GET">
            <div class="search-wrap">
                <input
                    class="search-input"
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Search quiz by name…"
                    autocomplete="off"
                />
                <button class="search-btn" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    Search
                </button>
            </div>
        </form>
    </div>

    {{-- Main --}}
    <div class="main">

        @if($quizResults !== null)
            {{-- ── Search Results ── --}}

            <div class="search-tag">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.85rem;height:0.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
                Results for "{{ $search }}"
                <a href="/" title="Clear search">&times;</a>
            </div>

            <div class="section-title">
                Quiz Results
                <span class="pill">{{ $quizResults->count() }} found</span>
            </div>

            @if($quizResults->isEmpty())
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:3rem;height:3rem;color:#cbd5e1;margin:0 auto;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p>No quizzes matched "<strong>{{ $search }}</strong>". Try a different keyword.</p>
                </div>
            @else
                @foreach($quizResults as $quiz)
                    <div class="result-card">
                        <div class="result-info">
                            <h3>{{ $quiz->name }}</h3>
                            <p>
                                Category:
                                <strong style="color:#4f46e5;">{{ optional($quiz->category)->name ?? '—' }}</strong>
                            </p>
                        </div>
                        <a href="/quizzes/{{ $quiz->id }}" class="btn-view">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:0.85rem;height:0.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                            View Quiz
                        </a>
                    </div>
                @endforeach
            @endif

        @else
            {{-- ── Category Listing ── --}}

            <div class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.3rem;height:1.3rem;color:#6366f1;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/>
                </svg>
                Browse Categories
                <span class="pill">{{ $categories->count() }} {{ Str::plural('Category', $categories->count()) }}</span>
            </div>

            @if($categories->isEmpty())
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:3rem;height:3rem;color:#cbd5e1;margin:0 auto;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>
                    </svg>
                    <p>No categories available yet. Check back soon!</p>
                </div>
            @else
                <div class="table-card">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width:4rem;">#</th>
                                <th>Category Name</th>
                                <th style="width:7rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $index => $category)
                                <tr>
                                    <td>
                                        <span class="serial-badge">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <span class="category-name-cell">{{ $category->name }}</span>
                                        <span class="quiz-count-badge">
                                            {{ $category->quizzes_count }} {{ Str::plural('quiz', $category->quizzes_count) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/quizzes/category/{{ $category->id }}" class="btn-view">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width:0.8rem;height:0.8rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        @endif

    </div>

</body>
</html>
