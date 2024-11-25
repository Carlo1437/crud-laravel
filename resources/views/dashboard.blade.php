<x-app-layout>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-1/5 bg-gray-800 text-white flex flex-col">
            <div class="p-4 text-center text-xl font-bold border-b border-gray-700">
                <img src="{{ asset('build/images/mcdo.png') }}" alt="Logo" class="w-1/2 mx-auto">
            </div>
            <nav class="flex-1">
                <ul class="space-y-2 p-4">
                    <li>
                        <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">
                            Products
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Products</h1>
                <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Add Product
                </a>
            </div>

            <!-- Table -->
            <div class="bg-white rounded shadow p-4">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Product_image</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <tr class="hover:bg-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">{{ $product->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $product->product_name }}</td>
                                    <td class="">@if ($product->image !== "")
                                        <img width="50" src="{{ asset('upload/products/'.$product->image) }}" alt="">
                                 @endif</td>
                                    <td class="border border-gray-300 px-4 py-2">${{ number_format($product->price, 2) }}</td>
                                    <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                            Edit
                                        </a>
                                        <button onclick="deleteProduct({{ $product->id }})" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                        <form id="delete-product-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post" style="display: none;">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <button onclick="archiveProduct({{ $product->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                            Archive
                                        </button>
                                        <form id="archive-product-form-{{ $product->id }}" action="{{ route('products.softDelete', $product->id) }}" method="post" style="display: none;">
                                            @csrf
                                            @method('patch')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">No products available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                document.getElementById('delete-product-form-' + id).submit();
            }
        }

        function archiveProduct(id) {
            if (confirm("Are you sure you want to archive this product?")) {
                document.getElementById('archive-product-form-' + id).submit();
            }
        }
    </script>
</x-app-layout>
