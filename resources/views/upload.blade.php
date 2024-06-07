<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h1>Create Product</h1>
    <form action="upload" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="type_id">Type ID:</label><br>
        <input type="text" id="type_id" name="type_id"><br><br>
        
        <label for="code">Code:</label><br>
        <input type="text" id="code" name="code"><br><br>
        
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br><br>
        
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br><br>
        
        <label for="unit_price">Unit Price:</label><br>
        <input type="text" id="unit_price" name="unit_price"><br><br>
        
        <label for="discount">Discount:</label><br>
        <input type="text" id="discount" name="discount"><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br><br>
        
        <button type="submit">Create Product</button>
    </form>
</body>
</html>
