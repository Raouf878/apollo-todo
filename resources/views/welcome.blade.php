@extends('\layouts.main') <!-- Extending layout\main -->

@push('head')
<title>Todo List App</title>
@endpush

@section('main-section')
<div class="container">

    <!-- Authentication Banner -->
    <div class="d-flex justify-content-between align-items-center my-4">
        @auth
            <!-- Show if user is logged in -->
            <div>
                Welcome, {{ Auth::user()->name }}!
            </div>
            <div>
                <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Access Your Account</a>
                
            </div>
        @endauth

        @guest
            <!-- Show if user is not logged in -->
            <div class="text-end">
                <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            </div>
        @endguest
    </div>
    
    <!-- Existing Todos Section -->
    <div class="d-flex justify-content-between align-items-center my-5"> 
        <div class="h2">All Todos</div>
        <a href="{{route("todo.create")}}" class="btn btn-primary btn-lg">Add Todo</a>
    </div>

    <!-- Todos Table -->
    <table class="table table-stripped table-dark">
        <tr>
            <th>Task Name</th>
            <th>Description</th>
            <th>Due date</th>
            <th>Action</th>
        </tr>
        @foreach($todos as $todo)
            <tr valign="middle">
                <td>{{$todo->name}}</td>
                <td>{{$todo->work}}</td>
                <td>{{$todo->duedate}}</td>
                <td>
                    <a href="{{route("todo.edit",$todo->id)}}" class="btn btn-success btn-sm">Update</a>
                    <a href="{{route("todo.delete",$todo->id)}}" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach        
    </table>
</div>

@endsection
