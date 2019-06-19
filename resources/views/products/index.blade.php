@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Products - Listing <button class="btn btn-primary pull-right" id="addProduct"><span class="glyphicon glyphicon-plus"></span> Add</button></h4></div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price (Rs)</th>
                                <th>Action</th>
                            </tr>    
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{ucfirst($product->category->name)}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td><button class="btn btn-warning editProduct" id="{{$product->id}}" data-id="{{$product->category->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}"><span class="glyphicon glyphicon-pencil"></span> Edit</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="productModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product description</h4>
      </div>
      <div class="modal-body">
        <form>
            <input type="hidden" id="productId">
            <div class="form-group">
                <label>Product category</label>
                <select class="form-control" id="category">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Product name</label>
                <input type="text" id="name" class="form-control" placeholder="Product name">
            </div>

            <div class="form-group">
                <label>Product price</label>
                <input type="number" id="price" min="0" class="form-control" placeholder="Product price">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="saveProduct">Save</button>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '#addProduct', function(){
            $('#category').val("");
            $('#name').val("");
            $('#price').val("");
            $('#productModal').modal('show');
        });

        $(document).on('click', '#saveProduct', function(){
            var category = $('#category').val();
            if(!category)
            {
                return alert('Product category is required!');
            }

            var name = $('#name').val();

            if(!name)
            {
                return alert('Product name is required!');
            }

            var price = $('#price').val();

            if(!price)
            {
                return alert('Product price is required!');
            }

            var productId = $('#productId').val();
            var url = "";
            var type = "";
            if(productId)
            {
                url = "{{route('products.update', ':productId')}}";
                url = url.replace(':productId', productId);

            }else{
                url = "{{route('products.store')}}";
            }

            $.ajax({
                url: url,
                type: "POST",
                dataType: "JSON",
                headers: {
                    "Authorization": "Bearer " + "PASTE_THE_ACCESS_TOKEN_HERE"
                },
                data: {
                    category: category,
                    name: name,
                    price: price
                },
                success: function(response, textStatus, xhr)
                {
                    window.location = "{{route('products.index')}}";
                },
                error: function(xhr, textStatus, errorThrown)
                {   
                    console.log(errorThrown);
                }
            });
        });

        $(document).on('click', '.editProduct', function(){
            var categoryId = $(this).data('id');
            var productId = $(this).attr('id');
            var productName = $(this).data('name');
            var productPrice = $(this).data('price');
            $('#category').val(categoryId);
            $('#name').val(productName);
            $('#price').val(productPrice);
            $('#productModal').modal('show');
        });
    });
</script>
@endpush
