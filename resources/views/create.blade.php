<!-- resources/views/product_types/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product Type</title>
</head>
<body>
    <h1>Create Product Type</h1>
    <form action="create" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        
        <label for="icon">Icon:</label><br>
        <input type="file" id="icon" name="icon"><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
