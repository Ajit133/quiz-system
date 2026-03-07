<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Categories</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">
    <x-navbar name={{$name}}></x-navbar>
    @if(session('category'))
        <div class="max-w-xl mx-auto mt-4 px-4" style="max-width:36rem; margin: 1rem auto 0; padding: 0 1rem;">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
                 style="background-color:#dcfce7; border:1px solid #4ade80; color:#15803d; padding:0.75rem 1rem; border-radius:0.375rem; font-weight:500;">
                ✓ {{ session('category') }}
            </div>
        </div>
    @endif
    <div class="max-w-xl mx-auto  px-4" style="margin-top: 3rem;">
        <div class="bg-white shadow rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Add New Category</h2>

            <form action="/add-category" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-600 mb-1">
                        Subject Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="category"
                        placeholder="e.g. Mathematics, Science, History"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded transition-colors duration-200"
                    style="display:block; width:100%; background-color:#4f46e5; color:#fff; font-weight:600; padding:0.5rem 1rem; border-radius:0.375rem; border:none; cursor:pointer;"
                >
                    Add Category
                </button>
            </form>
        </div>
    </div>
</body>
</html>