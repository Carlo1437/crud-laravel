<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>creating product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
  <body>
     <div class="bg-dark py-3">
        <h3 class="text-white text-center"> My first Crud</h3>
     </div>
     <div class="cotainer">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10 mt-4">
                {{Session::get('success')}}
            </div>
                @endif
                <div class="card border-0 shadow-lg my-4" >
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Hello Welcome</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Product Description</th>
                                <th>Product Image</th>
                                <th>created_at</th>
                                <th>Action</th>
                            </tr>
                                @if ($products->count() > 0)
                                @foreach ($products as $product)

                                <tr>
                                <td>{{ $product->id}}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                <td>@if ($product->image !== "")
                                       <img width="50" src="{{ asset('upload/products/'.$product->image) }}" alt="">
                                @endif</td>
                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>
                                    <a href="#" onclick="deleteProduct({{ $product->id }})" class="btn btn-dark">Delete</a>
                                    <form id="delete-product-form-{{$product->id  }}" action="{{ route('products.destroy', $product->id)}}" method="post">
                                    @method('delete')
                                    @csrf
                                </form>
                                <a href="#" onclick="archiveProduct({{ $product->id }})" class="btn btn-warning">Archive</a>
                                <form id="archive-product-form-{{ $product->id }}" action="{{ route('products.softDelete', $product->id) }}" method="post" style="display: none;">
                                    @csrf
                                    @method('patch') <!-- Use PATCH for updating a specific field -->
                                </form>
                                </td>
                                </tr>
                                @endforeach
                                @endif
                        </table>
                    </div>
            </div>
        </div>
         </div>
         <script>
            function deleteProduct(id){
                if(confirm("Are you sure you want to delete this product?")){
                    document.getElementById('delete-product-form-'+id).submit();
                }
            }
            function archiveProduct(id){
                if(confirm("Are you sure you want to delete this product?")){
                    document.getElementById('archive-product-form-'+id).submit();
                }
            }
         </script>
  </body>
</html>
