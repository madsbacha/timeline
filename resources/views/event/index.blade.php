@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Events</div>

                    <div class="card-body">
                        @forelse($events as $event)
                            <div>
                                <div>{{$event->date}} {{$event->time}}</div>
                                <div>{{$event->description}}</div>
                                <a href="{{route('events.show', $event)}}">Show</a>
                            </div>
                        @empty
                            <div>You have no events in your timeline</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
