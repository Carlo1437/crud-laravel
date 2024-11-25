<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>creating product</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center"> My  Crud</h3>
    </div>
        <div class="container">
            <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('dashboard') }}" class="btn btn-dark">back</a>
            </div>
            <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card borde-0 shadow-lg">
                <div class="card-header">
                    <h3> Update Product</h3>
                </div>
                <form  action="{{route('products.update', $product->id) }}" method="post">
                    @method('PUT')
                    @csrf
                <div class="card-body">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" value="{{ old('product_name', $product->product_name) }}" class="@error ('product_name') is-invalid @enderror form-control" id="name" placeholder="Product Name" name="product_name">
                    @error('product_name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sku</label>
                    <input type="text" value="{{ old('sku', $product->sku) }}"  class="@error ('sku') is-invalid @enderror form-control" id="name" placeholder="SKU" name="sku">
                    @error('sku')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input type="text" value="{{ old('price', $product->price) }}" class="@error ('price') is-invalid @enderror form-control" id="name" placeholder="Input Price" name="price">
                    @error('price')
                    <p class="invalid-feedback">{{ $message }}</p>

                @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea value="{{ old('description', $product->description) }}" class="@error ('description') is-invalid @enderror form-control" id="name" placeholder="Input Description" name="description" cols="30" rows="5">
                        @error('desicription')
                        <p class="invalid-feedback">{{ $message }}</p>

                    @enderror
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file"   class="form-control form-control-lg" id="name" placeholder="Input Description" name="image">
                    @if ($product->image !== "")
                                       <img class="w-50 my-3" src="{{ asset('upload/products/'.$product->image) }}" alt="">
                                @endif
                </div>
                <div class="d-grid">
                    <button class="btn btn-lg bg-dark text-white">Submit</button>
                </div>
            </div>
        </form>
            </div>
            </div>
        </div>
        </div>
  </body>
</html>
