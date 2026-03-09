<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} — Quizzes — Quiz System</title>
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }
        .card { background: #fff; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 4px 16px rgba(0,0,0,.06); }
        .page-header { border-bottom: 1px solid #e2e8f0; padding-bottom: 1.25rem; margin-bottom: 2rem; }
        .badge {
            display: inline-flex; align-items: center;
            padding: 0.2rem 0.65rem; border-radius: 9999px;
            background: #eef2ff; color: #4f46e5; font-size: 0.75rem; font-weight: 700;
            margin-left: 0.5rem;
        }
        .badge-green { background: #dcfce7; color: #166534; }
        .quiz-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 0;
        }
        .quiz-row + .quiz-row { border-top: 1px solid #f1f5f9; }
        .quiz-index {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.75rem; height: 1.75rem; border-radius: 50%;
            background: #eef2ff; color: #6366f1; font-size: 0.75rem; font-weight: 700;
            margin-right: 0.75rem; flex-shrink: 0;
        }
        .btn-back {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            background: #fff; color: #64748b; font-weight: 600; font-size: 0.875rem;
            border: 1.5px solid #e2e8f0; border-radius: 0.5rem; cursor: pointer;
            transition: background .18s, border-color .18s; text-decoration: none;
        }
        .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
    </style>
</head>
<body style="background: linear-gradient(135deg, #f1f5f9 0%, #e8eaf6 100%); min-height: 100vh;">

    <x-navbar name={{ $name }}></x-navbar>

    <div style="max-width: 700px; margin: 0 auto; padding: 2.5rem 1.25rem 4rem;">

        {{-- Page Header --}}
        <div class="page-header">
            <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.6rem;height:1.6rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <h1 style="font-size:1.5rem; font-weight:700; color:#1e293b; margin:0;">
                    {{ $category->name }}
                    <span class="badge badge-green">{{ $quizzes->count() }} {{ Str::plural('Quiz', $quizzes->count()) }}</span>
                </h1>
            </div>
            <p style="color:#64748b; font-size:0.9rem; margin:0.5rem 0 0 2.35rem;">All quizzes under this category.</p>
        </div>

        {{-- Back Button --}}
        <div style="margin-bottom:1.5rem;">
            <a href="/admin-categories" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Categories
            </a>
        </div>

        {{-- Quizzes Card --}}
        <div class="card" style="padding: 2rem;">

            @if($quizzes->isEmpty())
                <div style="text-align:center; padding: 2.5rem 1rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:3rem;height:3rem;color:#cbd5e1;margin:0 auto 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>
                    </svg>
                    <p style="color:#94a3b8; font-size:0.9rem; font-weight:500;">No quizzes found for this category.</p>
                </div>
            @else
                @foreach($quizzes as $index => $quiz)
                    <div class="quiz-row">
                        <div style="display:flex; align-items:center;">
                            <span class="quiz-index">{{ $index + 1 }}</span>
                            <div>
                                <a href="/quiz/{{ $quiz->id }}"
                                   style="margin:0; font-weight:600; color:#4f46e5; font-size:0.9375rem; text-decoration:none;"
                                   onmouseover="this.style.textDecoration='underline'"
                                   onmouseout="this.style.textDecoration='none'">
                                    {{ $quiz->name }}
                                </a>
                                <p style="margin:0; font-size:0.75rem; color:#94a3b8;">Created {{ $quiz->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <span class="badge" style="background:#eef2ff;color:#4338ca;">Quiz #{{ $quiz->id }}</span>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
</body>
</html>
