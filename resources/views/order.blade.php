<!-- resources/views/products.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Type</th>
                <th>Unit Price</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody id="productTableBody">
            <!-- Products will be inserted here -->
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/api/getproduct')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('productTableBody');
                    data.forEach(type => {
                        type.products.forEach(product => {
                            const row = document.createElement('tr');

                            const idCell = document.createElement('td');
                            idCell.textContent = product.id;
                            row.appendChild(idCell);

                            const nameCell = document.createElement('td');
                            nameCell.textContent = product.name;
                            row.appendChild(nameCell);

                            const imageCell = document.createElement('td');
                            const img = document.createElement('img');
                            img.src = product.image;
                            img.alt = product.name;
                            img.style.width = '50px';
                            imageCell.appendChild(img);
                            row.appendChild(imageCell);

                            const typeCell = document.createElement('td');
                            typeCell.textContent = type.name;
                            row.appendChild(typeCell);

                            const priceCell = document.createElement('td');
                            priceCell.textContent = product.unit_price;
                            row.appendChild(priceCell);

                            const stockCell = document.createElement('td');
                            stockCell.textContent = product.stock;
                            row.appendChild(stockCell);

                            tbody.appendChild(row);
                        });
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        });
    </script>
</body>
</html>
