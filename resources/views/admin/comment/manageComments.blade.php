<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('comments/css/comments.css') }}">
</head>
<body>
    <section class="vh-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-10">

                    <div class="card mask-custom" style="background-color: #7e40f6; linear-gradient(to right, rgba(126, 64, 246, 1), rgba(80, 139, 252, 1))">
                        <div class="card-body p-4 text-white">

                            <div class="text-center pt-3 pb-2">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-todo-list/check1.webp"
                                     alt="Check" width="60">
                                <h2 class="my-4">Manage Comments</h2>
                            </div>

                            <table class="table text-white mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Comment ID</th>
                                        <th scope="col">Seller name</th>
                                        <th scope="col">Customer name</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comments as $comment)
                                        <tr class="align-middle">
                                            <th>
                                                <span class="ms-4">{{ $comment->id }}</span>
                                            </th>
                                            <td class="align-middle">
                                                <span>{{ $comment->food->restaurant->user->name }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span>{{ $comment->user->name }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="">{{ $comment->message }}</span>
                                            </td>
                                            <td class="align-middle d-flex">
                                                <form method="post" action="{{ route('comments.admin.delete', ['id' => $comment->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn bi bi-trash3-fill text-danger" type="submit" style="font-size: 20px"></button>
                                                </form>

                                                <form method="post" action="{{ route('comments.admin.restore', ['id' => $comment->id]) }}">
                                                    @csrf
                                                    <button class="btn bi bi-bootstrap-reboot text-warning text" type="submit" style="font-size: 20px"></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="mt-3 d-flex justify-content-center">
                                {{ $comments->links() }}
                            </div>

                        </div>

                    </div>

                    <div class="text-center mt-2 mb-3">
                        <a class="m-auto btn btn-danger" href="{{ route('dashboard') }}">Home</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>

