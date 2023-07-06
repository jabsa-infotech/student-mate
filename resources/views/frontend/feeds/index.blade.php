<!doctype html>
<html lang="en">

<head>
    <title>Student Mate</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-light px-4">
            <a class="navbar-brand" href="{{ route('frontend.index') }}">Student Mate</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navId"
                aria-controls="navId" aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="navId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <form class="d-flex my-2 my-lg-0">
                            <input class="form-control me-sm-2" type="text" placeholder="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </li>
                </ul>
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">My Account</a>
                <div class="dropdown-menu" aria-labelledby="dropdownId">

                    @auth
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Change password</a>

                        <form action="{{ route('logout') }}" method="post">
                            @csrf

                            <button type="submit" class="dropdown-item">Log out</button>
                        </form>
                    @else
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                        <a class="dropdown-item" href="#">Signup</a>

                    @endauth

                </div>

            </div>
        </nav>
    </header>

    <main class="bg-light">
        <div class="container-fluid py-3">
            <div class="row">
                <div class="col-4">
                    <!-- Hover added -->
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">Name</a>
                        <a href="#" class="list-group-item list-group-item-action">Friends</a>
                        @for ($i = 0; $i < 5; $i++)
                            <a href="#" class="list-group-item list-group-item-action">Feeds</a>
                        @endfor
                    </div>
                    <hr>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">Name</a>
                        <a href="#" class="list-group-item list-group-item-action">Friends</a>
                        @for ($i = 0; $i < 5; $i++)
                            <a href="#" class="list-group-item list-group-item-action">Feeds</a>
                        @endfor
                        <a href="#" class="list-group-item list-group-item-action text-danger">Logout</a>

                    </div>
                </div>
                <div class="col-6">
                    <div class="card p-4 mb-3">
                        <form action="{{ route('frontend.feeds.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Title of your post">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Choose Photo</label>
                                <input type="file" class="form-control" name="photo" id="photo" placeholder=""
                                    aria-describedby="fileHelpId">
                                @error('photo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Post</button>
                        </form>
                    </div>

                    @foreach ($feeds as $feed)
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div>{{ $feed->title }}</div>
                                    <div>

                                        <a href="{{ route('frontend.feeds.edit', $feed) }}" class="btn">edit</a>
                                        <form action="{{ route('frontend.feeds.destroy', $feed) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn">X</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                {{ $feed->description }}
                            </div>
                            <img class="card-img-top" src="{{ asset('storage/' . $feed->photo) }}" alt="Title">
                            <div class="card-footer">
                                <button class="btn">Like</button>
                                <button class="btn">Comment</button>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-2">
                    <!-- Hover added -->
                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active"
                            aria-current="true">Contacts</button>
                        <button type="button" class="list-group-item list-group-item-action">Rohan</button>
                        @for ($i = 0; $i < 15; $i++)
                            <button type="button" class="list-group-item list-group-item-action">Pratik</button>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
