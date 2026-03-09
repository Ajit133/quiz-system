<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories — Quiz System</title>
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }
        .card { background: #fff; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 4px 16px rgba(0,0,0,.06); }
        .input-field {
            width: 100%; padding: 0.625rem 0.875rem;
            border: 1.5px solid #e2e8f0; border-radius: 0.5rem;
            font-size: 0.9375rem; color: #1e293b; background: #f8fafc;
            transition: border-color .2s, box-shadow .2s; outline: none;
        }
        .input-field:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.15); background:#fff; }
        .input-field::placeholder { color: #94a3b8; }
        .btn-primary {
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            width: 100%; padding: 0.65rem 1rem;
            background: #4f46e5; color: #fff; font-weight: 600; font-size: 0.9375rem;
            border: none; border-radius: 0.5rem; cursor: pointer;
            transition: background .2s, transform .1s, box-shadow .2s;
            box-shadow: 0 2px 6px rgba(79,70,229,.35);
        }
        .btn-primary:hover { background: #4338ca; box-shadow: 0 4px 12px rgba(79,70,229,.4); }
        .btn-primary:active { transform: scale(.98); }
        .btn-delete {
            display: flex; align-items: center; gap: 0.35rem;
            padding: 0.35rem 0.875rem; font-size: 0.8125rem; font-weight: 600;
            color: #dc2626; background: #fff; border: 1.5px solid #fca5a5;
            border-radius: 0.4rem; cursor: pointer;
            transition: background .18s, border-color .18s, color .18s;
        }
        .btn-delete:hover { background: #fef2f2; border-color: #dc2626; }
        .category-row { display: flex; align-items: center; justify-content: space-between; padding: 0.875rem 0; }
        .category-row + .category-row { border-top: 1px solid #f1f5f9; }
        .category-index {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.75rem; height: 1.75rem; border-radius: 50%;
            background: #eef2ff; color: #6366f1; font-size: 0.75rem; font-weight: 700;
            margin-right: 0.75rem; flex-shrink: 0;
        }
        .alert-success {
            display: flex; align-items: center; gap: 0.625rem;
            padding: 0.75rem 1rem; border-radius: 0.5rem;
            background: #f0fdf4; border: 1.5px solid #86efac; color: #166534;
            font-size: 0.9rem; font-weight: 500;
        }
        .page-header { border-bottom: 1px solid #e2e8f0; padding-bottom: 1.25rem; margin-bottom: 2rem; }
        .badge {
            display: inline-flex; align-items: center;
            padding: 0.2rem 0.65rem; border-radius: 9999px;
            background: #eef2ff; color: #4f46e5; font-size: 0.75rem; font-weight: 700;
            margin-left: 0.5rem;
        }
    </style>
</head>
<body style="background: linear-gradient(135deg, #f1f5f9 0%, #e8eaf6 100%); min-height: 100vh;">

    <x-navbar name={{$name}}></x-navbar>

    <div style="max-width: 640px; margin: 0 auto; padding: 2.5rem 1.25rem 4rem;">

        {{-- Page Header --}}
        <div class="page-header">
            <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.6rem;height:1.6rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/>
                </svg>
                <h1 style="font-size:1.5rem; font-weight:700; color:#1e293b; margin:0;">Category Management</h1>
            </div>
            <p style="color:#64748b; font-size:0.9rem; margin:0; padding-left:2.35rem;">Manage quiz subject categories from here.</p>
        </div>

        {{-- Flash Message --}}
        @if(session('category'))
            <div class="alert-success" style="margin-bottom:1.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('category') }}
            </div>
        @endif

        {{-- Add New Category Card --}}
        <div class="card" style="padding: 2rem; margin-bottom: 1.5rem;">
            <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:1.5rem;">
                <div style="width:2.25rem;height:2.25rem;background:#eef2ff;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h2 style="font-size:1.1rem; font-weight:700; color:#1e293b; margin:0;">Add New Category</h2>
            </div>

            <form action="/add-category" method="POST">
                @csrf
                <div style="margin-bottom:1.25rem;">
                    <label for="name" style="display:block; font-size:0.8125rem; font-weight:600; color:#475569; margin-bottom:0.4rem; letter-spacing:0.02em;">
                        SUBJECT NAME
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="category"
                        placeholder="e.g. Mathematics, Science, History"
                        class="input-field"
                        autocomplete="off"
                    >
                    @error('category')
                        <p style="color:#dc2626; font-size:0.8rem; margin-top:0.35rem;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Category
                </button>
            </form>
        </div>

        {{-- All Categories Card --}}
        <div class="card" style="padding: 2rem;">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem;">
                <div style="display:flex; align-items:center; gap:0.6rem;">
                    <div style="width:2.25rem;height:2.25rem;background:#eef2ff;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <h2 style="font-size:1.1rem; font-weight:700; color:#1e293b; margin:0;">
                        All Categories
                        <span class="badge">{{ $categories->count() }}</span>
                    </h2>
                </div>
            </div>

            @if($categories->isEmpty())
                <div style="text-align:center; padding: 2.5rem 1rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:3rem;height:3rem;color:#cbd5e1;margin:0 auto 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>
                    </svg>
                    <p style="color:#94a3b8; font-size:0.9rem; font-weight:500;">No categories yet. Add your first one above.</p>
                </div>
            @else
                <div>
                    @foreach($categories as $index => $category)
                        <div class="category-row">
                            <div style="display:flex; align-items:center;">
                                <span class="category-index">{{ $index + 1 }}</span>
                                <div>
                                    @if($category->quizzes_count > 0)
                                        <a href="/category/{{ $category->id }}/quizzes"
                                           style="margin:0; font-weight:600; color:#4f46e5; font-size:0.9375rem; text-decoration:none;"
                                           onmouseover="this.style.textDecoration='underline'"
                                           onmouseout="this.style.textDecoration='none'">
                                            {{ $category->name }}
                                        </a>
                                        <span class="badge" style="background:#dcfce7;color:#166534;">
                                            {{ $category->quizzes_count }} {{ Str::plural('Quiz', $category->quizzes_count) }}
                                        </span>
                                    @else
                                        <p style="margin:0; font-weight:600; color:#1e293b; font-size:0.9375rem;">{{ $category->name }}</p>
                                    @endif
                                    <p style="margin:0; font-size:0.75rem; color:#94a3b8;">Added by {{ $category->creator }}</p>
                                </div>
                            </div>
                            <form action="/delete-category/{{ $category->id }}" method="POST"
                                  onsubmit="return confirm('Delete \'{{ $category->name }}\'? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:0.875rem;height:0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</body>
</html>