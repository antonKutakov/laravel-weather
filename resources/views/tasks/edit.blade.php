@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
                {{ csrf_field() }}
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ $task->title }}" placeholder="Title here">
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline" value="{{ date('Y-m-d' , strtotime($task->deadline)) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="category_id"  class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $task->category_id)
                                selected
                            @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="status" @if ($task->status) checked @endif id="status"  class="form-check-input">
                    <label for="status" class="form-check-label">Status</label>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
