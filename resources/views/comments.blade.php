<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Comments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('comments/css/comments.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Snapp Food</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                </li>
            </ul>

            <form action="{{ route('comments') }}" method="get" class="d-flex">

                <div class=" me-2">
                    <select class="form-select" name="food" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option value="" selected disabled>Select Food</option>
                        @foreach($foods as $food)
                            <option value="{{ $food->id }}">{{ $food->name }}</option>
                        @endforeach
                    </select>
                </div>

                <input class="btn btn-outline-primary" type="submit" value="Filter">
            </form>

        </div>
    </div>
</nav>

<div class="container mt-2">



    <div class="review-list">
        <ul>

            @foreach($comments as $comment)
                <li>
                    <div class="d-flex">

                        <div class="right">
                            <h4>
                                <span class="fs-4">{{ $comment->user->name }}</span>
                                <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                        <path
                                            fill="currentColor"
                                            d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
                                        ></path>
                                    </svg>
                                    {{ $comment->score }}
                                </span>
                            </h4>
                            <div class="country d-flex align-items-center">
                                <div class="country-name font-accent">Order: {{ $comment->order->id }}</div>
                            </div>
                            <div class="country d-flex align-items-center">
                                <div class="country-name font-accent">{{ $comment->food->name }}</div>
                            </div>
                            <div class="review-description">
                                <p class="fs-5">
                                    {{ $comment->message }}
                                </p>
                            </div>
                            <span class="publish py-3 d-inline-block w-100">Published On {{ $comment->created_at->format(' d-M-Y') }} At {{ $comment->created_at->format('H:i:s') }}</span>
                        </div>

                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#reply{{ $comment->id }}">
                            <i class="bi bi-reply-all-fill text-primary m-auto" style="font-size: 30px"></i>
                        </button>

                        <div class="modal fade" id="reply{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Answer to comment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('comments.answer') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $comment->id }}">
                                            <input class="form-control" type="text" placeholder="Answer" name="answer">
                                            <div class="mt-1 text-center">
                                                <input class="btn btn-primary" type="submit" value="OK">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <form action="{{ route('comments.delete') }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn mt-5" type="submit" name="id" value="{{ $comment->id }}">
                                <i class="bi bi-trash-fill text-danger m-auto " style="font-size: 30px"></i>
                            </button>
                        </form>

                    </div>


                    @if(!is_null($comment->answer))
                        <div class="response-item mt-4 d-flex">

                            <div class="right-response">
                                <h4>
                                    {{ auth()->user()->name }}
                                </h4>
                                <div class="country d-flex align-items-center">

                                    <div class="country-name font-accent">Answer</div>
                                </div>
                                <div class="review-description">
                                    <p>
                                        {{ $comment->answer }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach

        </ul>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script type="text/javascript">

</script>
</body>
</html>
