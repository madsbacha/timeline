@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Event</div>

                    <div class="card-body">
                        <div>
                            <div>{{$event->date}} {{$event->time}}</div>
                            <div>{{$event->description}}</div>
                        </div>
                        <form action="{{route('events.destroy', $event)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
