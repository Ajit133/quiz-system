<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->name }} — Questions — Quiz System</title>
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
        .btn-back {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            background: #fff; color: #64748b; font-weight: 600; font-size: 0.875rem;
            border: 1.5px solid #e2e8f0; border-radius: 0.5rem; cursor: pointer;
            transition: background .18s, border-color .18s; text-decoration: none;
        }
        .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
        .question-card {
            border: 1.5px solid #e2e8f0; border-radius: 0.625rem;
            padding: 1.25rem 1.375rem; margin-bottom: 1rem; background: #fff;
        }
        .question-number {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.75rem; height: 1.75rem; border-radius: 50%;
            background: #4f46e5; color: #fff; font-size: 0.75rem; font-weight: 700;
            margin-right: 0.625rem; flex-shrink: 0;
        }
        .option-row {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.6rem 0.875rem; border-radius: 0.4rem; margin-top: 0.5rem;
            border: 1.5px solid #e2e8f0; background: #f8fafc;
            font-size: 0.9rem; color: #374151;
        }
        .option-row.correct {
            border-color: #86efac; background: #f0fdf4; color: #166534; font-weight: 600;
        }
        .option-letter {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.5rem; height: 1.5rem; flex-shrink: 0; border-radius: 50%;
            background: #e2e8f0; color: #475569; font-size: 0.75rem; font-weight: 700;
        }
        .option-row.correct .option-letter {
            background: #22c55e; color: #fff;
        }
        .marks-badge {
            display: inline-flex; align-items: center;
            padding: 0.15rem 0.55rem; border-radius: 9999px;
            background: #fef9c3; color: #854d0e; font-size: 0.7rem; font-weight: 700;
        }
    </style>
</head>
<body style="background: linear-gradient(135deg, #f1f5f9 0%, #e8eaf6 100%); min-height: 100vh;">

    <x-navbar name={{ $name }}></x-navbar>

    <div style="max-width: 760px; margin: 0 auto; padding: 2.5rem 1.25rem 4rem;">

        {{-- Page Header --}}
        <div class="page-header">
            <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.6rem;height:1.6rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h1 style="font-size:1.5rem; font-weight:700; color:#1e293b; margin:0;">
                    {{ $quiz->name }}
                    <span class="badge">{{ $questions->count() }} {{ Str::plural('Question', $questions->count()) }}</span>
                </h1>
            </div>
            <p style="color:#64748b; font-size:0.9rem; margin:0.5rem 0 0 2.35rem;">
                Category:
                <strong style="color:#4f46e5;">
                    {{ optional($quiz->category)->name ?? '—' }}
                </strong>
            </p>
        </div>

        {{-- Back Button --}}
        <div style="margin-bottom:1.5rem;">
            <a href="javascript:history.back()" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Back
            </a>
        </div>

        {{-- Questions --}}
        @if($questions->isEmpty())
            <div class="card" style="padding:2.5rem 2rem; text-align:center;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:3rem;height:3rem;color:#cbd5e1;margin:0 auto 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p style="color:#94a3b8; font-size:0.9rem; font-weight:500;">No questions have been added to this quiz yet.</p>
                <a href="/add-quiz" class="btn-back" style="margin-top:1rem; display:inline-flex;">Add Questions</a>
            </div>
        @else
            @php
                $optionLabels = ['option_a' => 'A', 'option_b' => 'B', 'option_c' => 'C', 'option_d' => 'D'];
            @endphp

            @foreach($questions as $index => $question)
                <div class="question-card">
                    {{-- Question Header --}}
                    <div style="display:flex; align-items:flex-start; gap:0.625rem; margin-bottom:1rem;">
                        <span class="question-number">{{ $index + 1 }}</span>
                        <div style="flex:1;">
                            <p style="margin:0; font-weight:600; color:#1e293b; font-size:0.9875rem; line-height:1.5;">
                                {{ $question->question }}
                            </p>
                            <span class="marks-badge" style="margin-top:0.4rem;">
                                {{ $question->marks }} {{ Str::plural('mark', $question->marks) }}
                            </span>
                        </div>
                    </div>

                    {{-- Options --}}
                    @foreach(['option_a','option_b','option_c','option_d'] as $key)
                        <div class="option-row {{ $question->correct_answer === $key ? 'correct' : '' }}">
                            <span class="option-letter">{{ $optionLabels[$key] }}</span>
                            <span>{{ $question->$key }}</span>
                            @if($question->correct_answer === $key)
                                <span style="margin-left:auto; font-size:0.75rem; color:#16a34a; font-weight:700; white-space:nowrap;">
                                    ✓ Correct
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif

    </div>
</body>
</html>
