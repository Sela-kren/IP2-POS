<!-- resources/views/order_form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        h1 { text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        button { display: block; width: 100%; padding: 10px; background-color: #28a745; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Order</h1>
        <form id="orderForm">
            <div class="form-group">
                <label for="cart">Cart (JSON format):</label>
                <textarea id="cart" name="cart" rows="10">{"1": 2}</textarea>
            </div>
            <button type="button" onclick="submitOrder()">Submit Order</button>
        </form>
        <div id="response"></div>
    </div>

    <script>
        async function submitOrder() {
            const cart = document.getElementById('cart').value;
            const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzE4NjMwMTU2LCJleHAiOjE3MTg3MDIxNTYsIm5iZiI6MTcxODYzMDE1NiwianRpIjoiQjdVR3UwZFVSc3R2RGlpRSIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.MVPcLNV5rvLWg4UQJql-BB-b_XG_2rRegUWjxp9UsgE'; // Replace with your JWT token

            const response = await fetch('/api/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({ cart })
            });

            const data = await response.json();
            document.getElementById('response').innerText = JSON.stringify(data, null, 2);
        }
    </script>
</body>
</html>
