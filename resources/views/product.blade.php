<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.3/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto mt-10">
        <h1 class="text-center text-2xl font-bold mb-4">Uploaded Products</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md">
                    <h2 class="text-lg font-bold mt-2">{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <p class="text-gray-600">Price: ${{ $product->unit_price }}</p>
                    <p class="text-gray-600">Discount: ${{ $product->discount }}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
