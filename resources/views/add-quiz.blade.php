<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quizDetails ? 'Add Question — '.$quizDetails['name'] : 'Create Quiz' }} — Quiz System</title>
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }
        .card { background: #fff; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 4px 16px rgba(0,0,0,.06); }
        .input-field {
            width: 100%; padding: 0.625rem 0.875rem;
            border: 1.5px solid #e2e8f0; border-radius: 0.5rem;
            font-size: 0.9375rem; color: #1e293b; background: #f8fafc;
            transition: border-color .2s, box-shadow .2s; outline: none;
            box-sizing: border-box;
        }
        .input-field:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.15); background: #fff; }
        .input-field::placeholder { color: #94a3b8; }
        textarea.input-field { resize: vertical; min-height: 100px; }
        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.7rem 1.75rem;
            background: #4f46e5; color: #fff; font-weight: 600; font-size: 0.9375rem;
            border: none; border-radius: 0.5rem; cursor: pointer;
            transition: background .2s, transform .1s, box-shadow .2s;
            box-shadow: 0 2px 6px rgba(79,70,229,.35); text-decoration: none;
        }
        .btn-primary:hover { background: #4338ca; box-shadow: 0 4px 12px rgba(79,70,229,.4); }
        .btn-primary:active { transform: scale(.98); }
        .btn-secondary {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.7rem 1.5rem;
            background: #fff; color: #64748b; font-weight: 600; font-size: 0.9375rem;
            border: 1.5px solid #e2e8f0; border-radius: 0.5rem; cursor: pointer;
            transition: background .18s, border-color .18s; text-decoration: none;
        }
        .btn-secondary:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
        .option-card {
            border: 1.5px solid #e2e8f0; border-radius: 0.5rem; padding: 0.875rem 1rem;
            display: flex; align-items: center; gap: 0.75rem;
            background: #f8fafc; transition: border-color .2s, background .2s;
        }
        .option-card:has(input[type="radio"]:checked) {
            border-color: #6366f1; background: #eef2ff;
        }
        .option-letter {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.75rem; height: 1.75rem; flex-shrink: 0;
            border-radius: 50%; background: #e2e8f0; color: #475569;
            font-size: 0.75rem; font-weight: 700; transition: background .2s, color .2s;
        }
        .option-card:has(input[type="radio"]:checked) .option-letter {
            background: #6366f1; color: #fff;
        }
        .section-label {
            font-size: 0.8125rem; font-weight: 600; color: #64748b;
            text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.75rem;
        }
        .alert-error {
            display: flex; align-items: flex-start; gap: 0.625rem;
            padding: 0.75rem 1rem; border-radius: 0.5rem;
            background: #fef2f2; border: 1.5px solid #fca5a5; color: #991b1b;
            font-size: 0.875rem; font-weight: 500; margin-bottom: 1.25rem;
        }
        .alert-success {
            display: flex; align-items: center; gap: 0.625rem;
            padding: 0.75rem 1rem; border-radius: 0.5rem;
            background: #f0fdf4; border: 1.5px solid #86efac; color: #166534;
            font-size: 0.9rem; font-weight: 500; margin-bottom: 1.5rem;
        }
        .page-header { border-bottom: 1px solid #e2e8f0; padding-bottom: 1.25rem; margin-bottom: 2rem; }
        .field-group { margin-bottom: 1.375rem; }
        .field-label { display: block; font-size: 0.9rem; font-weight: 600; color: #374151; margin-bottom: 0.45rem; }
        .required-star { color: #ef4444; margin-left: 0.15rem; }
        .divider { border: none; border-top: 1px solid #f1f5f9; margin: 1.75rem 0; }
        select.input-field { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 0.75rem center; padding-right: 2.5rem; }
        .btn-danger {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            background: #fff; color: #dc2626; font-weight: 600; font-size: 0.875rem;
            border: 1.5px solid #fca5a5; border-radius: 0.5rem; cursor: pointer;
            transition: background .18s, border-color .18s; text-decoration: none;
        }
        .btn-danger:hover { background: #fef2f2; border-color: #f87171; }
        .quiz-banner {
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;
            padding: 1rem 1.25rem; border-radius: 0.625rem;
            background: #eef2ff; border: 1.5px solid #c7d2fe; margin-bottom: 1.75rem;
        }
        .badge { display: inline-flex; align-items: center; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge-indigo { background: #e0e7ff; color: #4338ca; }
        .badge-green  { background: #dcfce7; color: #166534; }
        .question-list-item { padding: 0.875rem 1rem; border: 1.5px solid #e2e8f0; border-radius: 0.5rem; background: #f8fafc; margin-bottom: 0.625rem; font-size: 0.9rem; color: #374151; }
        .question-list-item .q-meta { font-size: 0.8rem; color: #94a3b8; margin-top: 0.25rem; }
    </style>
</head>
<body style="background: linear-gradient(135deg, #f1f5f9 0%, #e8eaf6 100%); min-height: 100vh;">

    <x-navbar name={{$name}}></x-navbar>

    <div style="max-width: 720px; margin: 0 auto; padding: 2.5rem 1.25rem 4rem;">

        {{-- Flash / Validation Messages --}}
        @if(session('quiz_success'))
            <div class="alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('quiz_success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;flex-shrink:0;margin-top:0.05rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
                <ul style="margin:0; padding-left:1rem; list-style:disc;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(!$quizDetails)
        {{-- ============================================================ --}}
        {{-- STATE 1: No active quiz — show quiz creation form            --}}
        {{-- ============================================================ --}}
        <div class="page-header">
            <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.6rem;height:1.6rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                <h1 style="font-size:1.5rem; font-weight:700; color:#1e293b; margin:0;">Create a New Quiz</h1>
            </div>
            <p style="color:#64748b; font-size:0.9rem; margin:0; padding-left:2.35rem;">
                Give your quiz a name and choose its category. You can add questions after saving.
            </p>
        </div>

        <div class="card" style="padding: 2rem 2.25rem;">
            <form action="/add-quiz" method="POST">
                @csrf

                <div class="field-group">
                    <label class="field-label" for="quiz">
                        Quiz Name <span class="required-star">*</span>
                    </label>
                    <input type="text" class="input-field" id="quiz" name="quiz"
                        placeholder="e.g. General Knowledge Round 1"
                        value="{{ old('quiz') }}">
                    @error('quiz')
                        <p style="color:#dc2626; font-size:0.8125rem; margin-top:0.35rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="category_id">
                        Category <span class="required-star">*</span>
                    </label>
                    <select class="input-field" id="category_id" name="category_id">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p style="color:#dc2626; font-size:0.8125rem; margin-top:0.35rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display:flex; align-items:center; justify-content:flex-end; gap:0.875rem; border-top:1px solid #f1f5f9; padding-top:1.5rem;">
                    <a href="/dashboard" class="btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Quiz
                    </button>
                </div>
            </form>
        </div>

        @else
        {{-- ============================================================ --}}
        {{-- STATE 2: Quiz active — show question-adding form             --}}
        {{-- ============================================================ --}}

        {{-- Active quiz banner --}}
        <div class="quiz-banner">
            <div style="display:flex; align-items:center; gap:0.75rem; flex-wrap:wrap;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.2rem;height:1.2rem;color:#4f46e5;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <div>
                    <p style="margin:0; font-size:0.75rem; color:#6366f1; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Active Quiz</p>
                    <p style="margin:0; font-size:1rem; font-weight:700; color:#1e293b;">{{ $quizDetails['name'] }}</p>
                </div>
                <span class="badge badge-indigo">
                    {{ $categories->firstWhere('id', $quizDetails['category_id'])?->name ?? 'Unknown Category' }}
                </span>
                <span class="badge badge-green">{{ $questions->count() }} question{{ $questions->count() === 1 ? '' : 's' }}</span>
            </div>
            <a href="/finish-quiz" class="btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Finish &amp; New Quiz
            </a>
        </div>

        {{-- Page header --}}
        <div class="page-header">
            <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.6rem;height:1.6rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h1 style="font-size:1.5rem; font-weight:700; color:#1e293b; margin:0;">Add a Question</h1>
            </div>
            <p style="color:#64748b; font-size:0.9rem; margin:0; padding-left:2.35rem;">
                Fill in the question, all four options, and mark the correct answer.
            </p>
        </div>

        {{-- Question form --}}
        <div class="card" style="padding: 2rem 2.25rem;">
            <form action="/add-question" method="POST">
                @csrf

                <div class="field-group">
                    <label class="field-label" for="question">
                        Question <span class="required-star">*</span>
                    </label>
                    <textarea class="input-field" id="question" name="question" rows="3"
                        placeholder="Enter the question here...">{{ old('question') }}</textarea>
                    @error('question')
                        <p style="color:#dc2626; font-size:0.8125rem; margin-top:0.35rem;">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="divider">

                <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:1.25rem;">
                    <div style="width:2rem;height:2rem;background:#eef2ff;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <h2 style="font-size:1rem; font-weight:700; color:#1e293b; margin:0;">Answer Options</h2>
                </div>
                <p style="color:#64748b; font-size:0.875rem; margin:-0.5rem 0 1.25rem 2.5rem;">
                    Click the radio button to mark the correct answer.
                </p>

                @foreach([['A','option_a'],['B','option_b'],['C','option_c'],['D','option_d']] as [$letter, $field])
                <div class="field-group">
                    <label class="option-card" for="{{ $field }}_radio" style="cursor:pointer;">
                        <input type="radio" name="correct_answer" value="{{ $field }}"
                            id="{{ $field }}_radio"
                            style="accent-color:#6366f1; width:1rem; height:1rem; flex-shrink:0;"
                            {{ old('correct_answer') == $field ? 'checked' : '' }}>
                        <span class="option-letter">{{ $letter }}</span>
                        <input type="text" class="input-field" id="{{ $field }}" name="{{ $field }}"
                            style="background:transparent; border:none; box-shadow:none; padding:0; font-size:0.9375rem;"
                            placeholder="Option {{ $letter }}" value="{{ old($field) }}"
                            onclick="event.stopPropagation()">
                    </label>
                    @error($field)
                        <p style="color:#dc2626; font-size:0.8125rem; margin-top:0.35rem;">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach

                @error('correct_answer')
                    <p style="color:#dc2626; font-size:0.8125rem; margin-top:-0.5rem; margin-bottom:1rem;">{{ $message }}</p>
                @enderror

                <hr class="divider">

                <div class="field-group" style="max-width:200px;">
                    <label class="field-label" for="marks">
                        Marks <span class="required-star">*</span>
                    </label>
                    <input type="number" class="input-field" id="marks" name="marks"
                        placeholder="e.g. 5" min="1" max="100" value="{{ old('marks', 1) }}">
                    @error('marks')
                        <p style="color:#dc2626; font-size:0.8125rem; margin-top:0.35rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display:flex; align-items:center; justify-content:flex-end; gap:0.875rem; border-top:1px solid #f1f5f9; padding-top:1.5rem;">
                    <a href="/dashboard" class="btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Dashboard
                    </a>
                    <button type="submit" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Question
                    </button>
                </div>
            </form>
        </div>

        {{-- Questions added so far --}}
        @if($questions->count() > 0)
        <div style="margin-top: 2rem;">
            <h3 style="font-size:1rem; font-weight:700; color:#374151; margin-bottom:1rem;">
                Questions Added ({{ $questions->count() }})
            </h3>
            @foreach($questions as $index => $q)
            <div class="question-list-item">
                <p style="margin:0; font-weight:600;">{{ $index + 1 }}. {{ $q->question }}</p>
                <div class="q-meta" style="display:flex; flex-wrap:wrap; gap:0.75rem; margin-top:0.4rem;">
                    <span>A: {{ $q->option_a }}</span>
                    <span>B: {{ $q->option_b }}</span>
                    <span>C: {{ $q->option_c }}</span>
                    <span>D: {{ $q->option_d }}</span>
                    <span style="color:#4f46e5; font-weight:600;">
                        Correct: {{ strtoupper(str_replace('option_', '', $q->correct_answer)) }}
                    </span>
                    <span>Marks: {{ $q->marks }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @endif

    </div>

</body>
</html>
