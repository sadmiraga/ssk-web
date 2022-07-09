@extends('layouts.home')

@section('content')
    <div class="container d-flex justify-content-center">

        <div class="card w-50">

            <div class="card-header">
                Invite subscribers to {{ $event->name }}
            </div>
            <div class="card-body">

                <form action="{{ route('subscribers.send-email') }}" method="POST">
                    @csrf

                    <input type="hidden" name="eventID" value="{{ $event->id }}">


                    <div class="form-group mb-4">
                        <input class="form-control" name="subject" required placeholder="Email Subject">
                    </div>

                    <div class="form-group mb-4">
                        <textarea placeholder="Invitation message" rows="10" class="form-control" required name="message"></textarea>
                    </div>

                    <input type="hidden" name="limit" value="{{ count($subscribers) }}">

                    <div onclick="toggleEmails({{ count($subscribers) }});" class="btn btn-primary btn-sm mb-3"
                        id="toggle-emails">
                        Oznaci vse
                    </div>

                    @foreach ($subscribers as $subscriber)
                        <div class="form-group">

                            <input type="checkbox" class="form-check-input" name="emails-{{ $loop->iteration }}"
                                value="{{ $subscriber->email }}" id="{{ $loop->iteration }}">
                            <label for="{{ $loop->iteration }}"> {{ $subscriber->email }} </label>

                        </div>
                    @endforeach

                    <div class="form-group mt-3 text-center">
                        <button type="submit" class="btn btn-success w-50">POŠLJI</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection



@push('js')
    <script>
        function toggleEmails(count) {
            for (var i = 1; i <= count; i++) {
                document.getElementById(i).checked = true;
            }
        }
    </script>
@endpush
