<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MLP To-Do</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Correct way to load external CSS -->
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
</head>
<body class="py-4">

<!-- Logo -->
<div class="text-center mb-4">
    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
</div>

<!-- Main layout: input left, table right -->
<div class="container">
    <div class="row justify-content-center align-items-start">
        <!-- Left: Form -->
        <div class="col-md-4">
            <form method="POST" action="{{ route('tasks.store') }}" class="mb-4">
                @csrf
                <input type="text" name="name" class="form-control mb-2" placeholder="Insert task name" required>
                <button class="btn btn-primary w-100">Add</button>
            </form>
        </div>

        <!-- Right: Table -->
        <div class="col-md-7">
            <div class="card shadow-sm">
                <table class="table mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="task-list">
                    @foreach($tasks as $task)
                        <tr id="task-{{ $task->id }}">
                            <td>{{ $task->id }}</td>
                            <td class="{{ $task->completed ? 'text-decoration-line-through text-muted' : '' }}">
                                {{ $task->name }}
                            </td>
                            <td class="text-center">
                                @if (!$task->completed)
                                    <form method="POST" action="{{ route('tasks.complete', $task->id) }}" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-success btn-sm">✔</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">✖</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<p class="text-center mt-4 text-muted small">
    Copyright © 2020 All Rights Reserved.
</p>

<!-- Echo (optional) -->
<script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pusher-js@7.2/dist/web/pusher.min.js"></script>

</body>
</html>
