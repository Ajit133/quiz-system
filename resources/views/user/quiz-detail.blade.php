<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->name }} — Quiz System</title>
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
        .main { max-width: 780px; margin: 0 auto; padding: 2.5rem 1.25rem 5rem; }

        /* Page header */
        .page-header {
            border-bottom: 1.5px solid #e2e8f0;
            padding-bottom: 1.25rem; margin-bottom: 2rem;
            display: flex; align-items: flex-start; gap: 0.85rem;
        }
        .page-header .icon-wrap {
            width: 2.75rem; height: 2.75rem; border-radius: 0.625rem;
            background: #eef2ff; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-top: 0.15rem;
        }
        .page-header h1 { font-size: 1.4rem; font-weight: 700; color: #1e293b; margin: 0 0 0.3rem; }
        .page-header p  { font-size: 0.875rem; color: #64748b; margin: 0; }

        .badge {
            display: inline-flex; align-items: center;
            padding: 0.2rem 0.65rem; border-radius: 9999px;
            background: #eef2ff; color: #4f46e5; font-size: 0.73rem; font-weight: 700;
            margin-left: 0.45rem;
        }

        /* Back button */
        .btn-back {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1.1rem; background: #fff; color: #475569;
            font-weight: 600; font-size: 0.875rem;
            border: 1.5px solid #e2e8f0; border-radius: 0.5rem;
            cursor: pointer; text-decoration: none; margin-bottom: 1.75rem;
            transition: background .18s, border-color .18s;
        }
        .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }

        /* Question card */
        .question-card {
            background: #fff; border-radius: 0.75rem;
            border: 1.5px solid #e2e8f0;
            padding: 1.375rem 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
            transition: box-shadow .18s;
        }
        .question-card:hover { box-shadow: 0 4px 16px rgba(79,70,229,.1); border-color: #c7d2fe; }

        .question-header {
            display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 1rem;
        }
        .question-number {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.85rem; height: 1.85rem; border-radius: 50%;
            background: #4f46e5; color: #fff; font-size: 0.75rem; font-weight: 700;
            flex-shrink: 0; margin-top: 0.05rem;
        }
        .question-text {
            font-weight: 600; color: #1e293b; font-size: 0.9625rem; line-height: 1.55;
            flex: 1;
        }
        .marks-pill {
            display: inline-flex; align-items: center;
            padding: 0.15rem 0.55rem; border-radius: 9999px;
            background: #fef9c3; color: #854d0e; font-size: 0.7rem; font-weight: 700;
            flex-shrink: 0; margin-top: 0.05rem;
        }

        /* Options */
        .options-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;
            margin-top: 0.25rem;
        }
        @media (max-width: 520px) { .options-grid { grid-template-columns: 1fr; } }

        .option-row {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.6rem 0.875rem; border-radius: 0.45rem;
            border: 1.5px solid #e2e8f0; background: #f8fafc;
            font-size: 0.875rem; color: #374151;
            transition: border-color .15s, background .15s;
            cursor: default;
        }
        .option-row:hover { border-color: #a5b4fc; background: #eef2ff; }
        .option-letter {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.5rem; height: 1.5rem; flex-shrink: 0; border-radius: 50%;
            background: #e2e8f0; color: #475569; font-size: 0.72rem; font-weight: 700;
        }

        /* Empty state */
        .empty-state-card {
            background: #fff; border-radius: 0.875rem;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
            padding: 3rem 1rem; text-align: center;
        }
        .empty-state-card p { color: #94a3b8; font-weight: 500; margin: 0.75rem 0 0; }

        /* Info bar */
        .info-bar {
            background: #fff; border-radius: 0.625rem;
            border: 1.5px solid #e2e8f0;
            padding: 0.75rem 1.25rem; margin-bottom: 1.5rem;
            display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;
            font-size: 0.85rem; color: #475569;
        }
        .info-bar .info-item { display: flex; align-items: center; gap: 0.4rem; font-weight: 600; }
        .info-bar .info-item span.label { font-weight: 400; color: #64748b; }
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
        @if($quiz->category_id)
            <a href="/quizzes/category/{{ $quiz->category_id }}" class="nav-back-link">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.85rem;height:0.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Quizzes
            </a>
        @else
            <a href="/" class="nav-back-link">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.85rem;height:0.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Home
            </a>
        @endif
    </nav>

    <div class="main">

        {{-- Page Header --}}
        <div class="page-header">
            <div class="icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.4rem;height:1.4rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h1>
                    {{ $quiz->name }}
                    <span class="badge">{{ $questions->count() }} {{ Str::plural('Question', $questions->count()) }}</span>
                </h1>
                <p>
                    Category:
                    <strong style="color:#4f46e5;">{{ optional($quiz->category)->name ?? '—' }}</strong>
                </p>
            </div>
        </div>

        {{-- Back Button --}}
        <a href="javascript:history.back()" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:0.875rem;height:0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>

        {{-- Quiz info bar --}}
        @if($questions->isNotEmpty())
            @php
                $totalMarks = $questions->sum('marks');
            @endphp
            <div class="info-bar">
                <div class="info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span class="label">Total Questions:</span>
                    {{ $questions->count() }}
                </div>
                <div class="info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;color:#f59e0b;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    <span class="label">Total Marks:</span>
                    {{ $totalMarks }}
                </div>
            </div>
        @endif

        {{-- Questions --}}
        @if($questions->isEmpty())
            <div class="empty-state-card">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:3rem;height:3rem;color:#cbd5e1;margin:0 auto;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p>No questions have been added to this quiz yet.</p>
            </div>
        @else
            @php
                $optionLabels = ['option_a' => 'A', 'option_b' => 'B', 'option_c' => 'C', 'option_d' => 'D'];
            @endphp

            @foreach($questions as $index => $question)
                <div class="question-card">
                    <div class="question-header">
                        <span class="question-number">{{ $index + 1 }}</span>
                        <p class="question-text">{{ $question->question }}</p>
                        <span class="marks-pill">{{ $question->marks }} {{ Str::plural('mark', $question->marks) }}</span>
                    </div>

                    <div class="options-grid">
                        @foreach(['option_a','option_b','option_c','option_d'] as $key)
                            <div class="option-row">
                                <span class="option-letter">{{ $optionLabels[$key] }}</span>
                                <span>{{ $question->$key }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif

    </div>

</body>
</html>
