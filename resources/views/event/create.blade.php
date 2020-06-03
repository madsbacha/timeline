@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create event</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('events.store')}}" method="POST">
                            @csrf
                            <input type="date" name="date" required>
                            <input type="time" name="time">
                            <textarea name="description" required>
                            </textarea>
                            <input type="submit" value="Create">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
