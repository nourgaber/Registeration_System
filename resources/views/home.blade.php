@extends('layouts.auth')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                    @if(isset($notification))
    @forelse($notifications as $notification)
        <div class="alert alert-success" role="alert">
            [{{ $notification->created_at }}] User {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) has just registered.
            <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                Mark as read
            </a>
        </div>

        @if($loop->last)
            <a href="#" id="mark-all">
                Mark all as read
            </a>
        @endif
    @empty
        There are no new notifications
    @endforelse
@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection