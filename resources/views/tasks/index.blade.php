@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="row pt-3 pb-3">
                <div class="col-md-2">
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">New task</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-info">Home</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $key => $task)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $task->title }}</td>
                            <td>{{ date('d.m.Y', strtotime($task->deadline)) }}</td>
                            <td>{{ $task->category->name }}</td>
                            <td>
                                <label for="">
                                @if ($task->status)
                                Done
                                @else
                                Undone
                                @endif
                                </label>
                                <input type="checkbox" @if ($task->status) checked @endif aria-label="Checkbox for following text input">
                            </td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('tasks.edit', ['task' => $task->id]) }}" class="btn btn-warning mr-2">Edit</a>
                                    <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
