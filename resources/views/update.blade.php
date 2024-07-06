<!-- resources/views/update_user.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>
    <form action="/user/update" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $user->name }}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ $user->email }}">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" value="{{ $user->password }}">
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</body>
</html>
