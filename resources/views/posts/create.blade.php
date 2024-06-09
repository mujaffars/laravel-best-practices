<!-- resources/views/posts/create.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Create Post</title>
    <!-- Include Bootstrap CSS for styling (optional) -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Create a New Post</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Create Post Form -->
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" id="body" class="form-control" rows="5">{{ old('body') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
</body>

</html>