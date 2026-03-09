<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} — Quizzes — Quiz System</title>
    @vite('resources/css/app.css')
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', 'Segoe UI', sans-serif; margin: 0; }

        /* Navbar */
        .user-nav {
            background: #4338ca; padding: 0 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 3.75rem; box-shadow: 0 2px 8px rgba(67,56,202,.25);
        }
        .user-nav .brand {
            display: flex; align-items: center; gap: 0.5rem;
            color: #fff; font-size: 1.125rem; font-weight: 700;
            text-decoration: none; letter-spacing: 0.02em;
        }
        .user-nav .brand:hover { color: #c7d2fe; }
        .nav-back-link {
            font-size: 0.8125rem; font-weight: 600; color: #e0e7ff;
            text-decoration: none; padding: 0.4rem 0.9rem;
            border: 1.5px solid rgba(255,255,255,.35); border-radius: 0.4rem;
            transition: background .18s; display: flex; align-items: center; gap: 0.35rem;
        }
        .nav-back-link:hover { background: rgba(255,255,255,.12); border-color: #fff; color: #fff; }

        /* Main */
        .main { max-width: 820px; margin: 0 auto; padding: 2.5rem 1.25rem 5rem; }

        /* Page header */
        .page-header {
            border-bottom: 1.5px solid #e2e8f0; padding-bottom: 1.25rem; margin-bottom: 2rem;
            display: flex; align-items: flex-start; gap: 0.85rem;
        }
        .page-header .icon-wrap {
            width: 2.75rem; height: 2.75rem; border-radius: 0.625rem;
            background: #eef2ff; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .page-header h1 { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin: 0 0 0.3rem; }
        .page-header p  { font-size: 0.875rem; color: #64748b; margin: 0; }
        .badge {
            display: inline-flex; align-items: center;
            padding: 0.2rem 0.65rem; border-radius: 9999px;
            background: #eef2ff; color: #4f46e5; font-size: 0.73rem; font-weight: 700;
            margin-left: 0.5rem;
        }

        /* Table card */
        .table-card {
            background: #fff; border-radius: 0.875rem;
            box-shadow: 0 2px 8px rgba(0,0,0,.07), 0 8px 24px rgba(0,0,0,.05);
            overflow: hidden;
        }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead th {
            background: #f8fafc; padding: 0.8rem 1.25rem;
            text-align: left; font-size: 0.72rem; font-weight: 700;
            color: #64748b; text-transform: uppercase; letter-spacing: 0.06em;
            border-bottom: 1.5px solid #e2e8f0;
        }
        .data-table thead th:last-child { text-align: center; }
        .data-table tbody tr { transition: background .15s; }
        .data-table tbody tr:hover { background: #f8fafc; }
        .data-table tbody tr + tr { border-top: 1px solid #f1f5f9; }
        .data-table tbody td { padding: 0.95rem 1.25rem; vertical-align: middle; }
        .data-table tbody td:last-child { text-align: center; }

        .serial-badge {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.75rem; height: 1.75rem; border-radius: 50%;
            background: #eef2ff; color: #6366f1; font-size: 0.75rem; font-weight: 700;
        }
        .quiz-name { font-weight: 600; color: #1e293b; font-size: 0.9375rem; }
        .quiz-date { font-size: 0.75rem; color: #94a3b8; margin-top: 0.15rem; }

        .btn-view {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.42rem 1rem; font-size: 0.8125rem; font-weight: 600;
            background: #4f46e5; color: #fff; border: none; border-radius: 0.4rem;
            cursor: pointer; text-decoration: none;
            transition: background .18s, box-shadow .18s;
            box-shadow: 0 1px 4px rgba(79,70,229,.3);
        }
        .btn-view:hover { background: #4338ca; box-shadow: 0 3px 10px rgba(79,70,229,.4); }

        .btn-back {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1.1rem; background: #fff; color: #475569;
            font-weight: 600; font-size: 0.875rem;
            border: 1.5px solid #e2e8f0; border-radius: 0.5rem;
            cursor: pointer; text-decoration: none; margin-bottom: 1.5rem;
            transition: background .18s, border-color .18s;
        }
        .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }

        .empty-state {
            text-align: center; padding: 3rem 1rem;
        }
        .empty-state p { color: #94a3b8; font-weight: 500; margin: 0.75rem 0 0; }
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
        <a href="/" class="nav-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:0.85rem;height:0.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12l6-6M3 12l6 6"/>
            </svg>
            All Categories
        </a>
    </nav>

    <div class="main">

        {{-- Page Header --}}
        <div class="page-header">
            <div class="icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.4rem;height:1.4rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <h1>
                    {{ $category->name }}
                    <span class="badge">{{ $quizzes->count() }} {{ Str::plural('Quiz', $quizzes->count()) }}</span>
                </h1>
                <p>Select a quiz below and start testing your knowledge.</p>
            </div>
        </div>

        {{-- Back Button --}}
        <a href="/" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:0.875rem;height:0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Categories
        </a>

        {{-- Quizzes Table --}}
        @if($quizzes->isEmpty())
            <div class="table-card" style="padding:3rem 1rem;">
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:3rem;height:3rem;color:#cbd5e1;margin:0 auto;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>
                    </svg>
                    <p>No quizzes available in this category yet.</p>
                </div>
            </div>
        @else
            <div class="table-card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width:4rem;">#</th>
                            <th>Quiz Name</th>
                            <th style="width:7rem;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quizzes as $index => $quiz)
                            <tr>
                                <td>
                                    <span class="serial-badge">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <div class="quiz-name">{{ $quiz->name }}</div>
                                    <div class="quiz-date">Added {{ $quiz->created_at->format('M d, Y') }}</div>
                                </td>
                                <td>
                                    <a href="/quizzes/{{ $quiz->id }}" class="btn-view">
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

    </div>

</body>
</html>
