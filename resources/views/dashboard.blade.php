@extends('layouts.app')

@section('content')
    <div class="container-jumbotron mt-4 p-3">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        Add Your Todo Item {{ Str::title(Auth::user()->name) }}
                    </div>
                    <div class="card-body">
                        @if (session()->has('errors'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <br />
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form action="{{ route('todo.store') }}" method="post">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="Name" class="mb-2">Title:</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="Name" class="mb-2">Description:</label>
                                <textarea name="desc" class="form-control" rows="10" required></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="Name" class="mb-2">Status:</label>
                                <select name="status" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="progress">Progress</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>
                            {{-- <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="is_priority" value="1"
                                    id="is_priority">
                                <label class="form-check-label" for="is_priority">
                                    Is on Priority <span class="text-warning">(By checking this it will be on
                                        priority)</span>
                                </label>
                            </div> --}}
                            <input type="submit" class="form-control btn btn-success mb-2 mt-4">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-8 mx-auto mt-2">
                <div class="card shadow">
                    <div class="card-header text-center d-flex">
                        Here is your to do list {{ Str::title(Auth::user()->name) }}
                        <form class="d-flex ms-auto" role="search" action="{{ route('todo.index') }}" method="get">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                name="search">
                            <button class="btn btn-success" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @isset($todos)
                                @if (!empty($todos))
                                    @foreach ($todos as $item)
                                        <div class="col-12 mb-3">
                                            <div class="card shadow p-2">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-lg-9 col-md-6">
                                                            <div class="flex">
                                                                <strong>
                                                                    {{ $item->title != null ? Str::title($item->title) : Str::limit($item->desc, 15, '..') }}
                                                                </strong>
                                                                <span
                                                                    class=" badge {{ $item->status == 'pending' ? 'bg-danger' : '' }} {{ $item->status == 'progress' ? 'bg-warning' : 'bg-success' }}">{{ Str::ucfirst($item->status) }}</span>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="flex">
                                                                <a href="javascript:void(0)" class="btn text-primary edit"
                                                                    id="edit" data-todo-id={{ $item->id }}>Edit</a>
                                                                <a href="javascript:void(0)" class="btn text-primary show_view"
                                                                    id="show" data-todo-id={{ $item->id }}>View</a>
                                                                <a href="{{ route('todo.destroy', $item->id) }}"
                                                                    class="btn text-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    {{ $item->desc != null ? Str::ucfirst($item->desc) : '' }}
                                                </div>
                                                <div class="card-footer text-muted">
                                                    @php
                                                        $last_date = $item->created_at;
                                                        $current_date = \Carbon\Carbon::now()->toDateTimeString();
                                                        
                                                        //NUMBER DAYS BETWEEN TWO DATES CALCULATOR
                                                        $start_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $last_date);
                                                        $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $current_date);
                                                        $different_days = $start_date->diffInDays($end_date);
                                                        $time = 'days';
                                                        if ($different_days == 0) {
                                                            $different_days = $start_date->diffInHours($end_date);
                                                            $time = 'hours';
                                                            if ($different_days == 0) {
                                                                $different_days = $start_date->diffInMinutes($end_date);
                                                                $time = 'minutes';
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="d-flex">
                                                        <p>  Added {{ $different_days }} {{ $time }} Ago
                                                        </p>
                                                        <div class="form-check mt-2 ms-auto">
                                                            <form action="{{ route('todo.change_status') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="todo_id" value="{{ $item->id }}">

                                                                <input class="form-check-input" type="checkbox" name="is_priority" onchange="this.form.submit();"
                                                                value="1" id="is_priority" {{ $item->is_priority == '1' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="is_priority">
                                                                Is on Priority <span class="text-warning">(By checking this it
                                                                    will be on
                                                                    priority)</span>
                                                            </label>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center">No Todo List Found</p>
                                @endif
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('todo.update') }}" method="post">
        @csrf
        <div id="edit_model">

        </div>
    </form>
    <script>
        $("body").on("click", ".edit", function(e) {
            let todo_id = $(this).attr('data-todo-id')
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: '/todo-edit' + '/' + todo_id,
                dataType: "html",
                success: function(data) {
                    // console.log(data);
                    $("#edit_model").html(data);
                    $('#editModal').modal('show');
                },
                error: function(err) {
                    console.log('Modal noyt found');
                }
            });
        });
        $("body").on("click", ".show_view", function(e) {
            let todo_id = $(this).attr('data-todo-id')
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: '/todo-show' + '/' + todo_id,
                dataType: "html",
                success: function(data) {
                    // console.log(data);
                    $("#edit_model").html(data);
                    $('#editModal').modal('show');
                },
                error: function(err) {
                    console.log('Modal noyt found');
                }
            });
        });
        $('#hide_modal').click(function(e) {
            e.preventDefault();
            alert("Hello")
            $('#editModal').modal('hide');

        });
    </script>
@endsection
