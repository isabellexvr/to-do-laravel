<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="header">
            <h1 class="mb-4">{{auth()->user()->name }}',s To-Do List</h1>
            <form action="" method="post"></form>
        </div>

        <!-- Display Existing To-Do Items -->
        <div class="mb-4">
            <h2>Minhas Tasks:</h2>
            <ul class="list-group" style="max-height: 40vh; overflow: scroll;" >
                @if ($todos != null)
                    @foreach ($todos as $index => $todo)
                        <li class="  w-100 list-group-item d-flex align-items-center justify-content-between">
                            <div class="" style="width: 80%;" >
                                {{--  <h1>{{ $loop->iteration }}. {{ $todo->title }}</h1> --}}
                                <h1>{{ $index + 1 }}. {{ $todo->title }}</h1>
                                <h3>Criada em: {{ $todo->created_at }}</h3>
                                <h3>Completar até: {{ $todo->endsAt }}</h3>
                                <p>{{ $todo->description }}</p>

                            </div>
                            <form action="{{ route('tasks.destroy', $todo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="task_id" value="{{ $todo->id }}">
                                <button type="submit" class="btn btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                    </svg>
                                </button>
                            </form>
                            
                            <form action="{{ route('tasks.check', $todo->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <!-- Other input fields for the task -->
                            
                                <button type="submit" class="btn btn-primary">{{ $todo->done ? "Desmarcar" : "Marcar" }}</button>
                            </form>


                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <!-- Add New To-Do Form -->
        <div>
            <h2>Criar uma nova task:</h2>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>

                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" required>

                    <label for="endsAt">Prazo pra ser cumprida:</label>
                    <input type="date" class="form-control" id="endsAt" name="endsAt">

                    

                </div>
                <button type="submit" class="btn btn-primary"  >Add</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for Bootstrap features like modals) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
