<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="createUserForm" method="POST" action="{{ url('/create-user') }}" enctype="multipart/form-data">
        @csrf
        <label for="type_id">Type ID:</label>
        <input type="number" id="type_id" name="type_id" required min="1" max="20"><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required minlength="1" maxlength="20"><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required minlength="6" maxlength="20"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="image">Avatar:</label>
        <input type="file" id="image" name="image"><br><br>

        <button type="submit">Create User</button>
    </form>
</body>
</html>
