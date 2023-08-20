@extends('layouts.admin.app')

@section('content')
 

<div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Insert a new Package Income
                                    </div>
                                    <div class="card-body">
                                        
                                       <form action="/updatepackage/{{$package->id}}" method="post">
                                       @csrf
                                            
                                            <div class="form-group mb-4 " id="koderole">
                                            <label for="role">Select Role:</label>
                                            <select name="role" id="role" class="form-control">
    <option value="" disabled selected>Select a role</option> <!-- Hidden option -->
        <!-- Render options from database -->
        @php
        $selectedRoleIds = []; // Array untuk menyimpan role_id yang telah ditambahkan
    @endphp

    @foreach ($produk as $item)
        @if (!in_array($item->role_id, $selectedRoleIds))
            @php
                $selectedRoleIds[] = $item->role_id;
            @endphp
            <option value="{{ $item->Role->id }}" {{ $package->role_id == $item->Role->id ? 'selected' : '' }}>
            {{ $item->Role->kode_role }} - {{ $item->Role->jenis_role }}
        </option>
        @endif
    @endforeach
    </select>


                                               
                                            </div>
        

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Judul Paket</label>
                                                <input name="judul_paket" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{$package->judul_paket}}" required />
                                               
                                            </div>
                                    
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Paket</label>
                                                <textarea name="deskripsi_paket" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required >{{$package->deskripsi_paket}}</textarea>
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>
                                            

                                           
                                            <div class="form-group mb-4">
                                            <div id="product-container">
                                            @foreach ($package->produk as $index => $productData)
            <div class="product-item">
                <label for="product">Select Product:</label>
                <select name="data_produk[{{ $index }}][nama_produk]" class="product-select form-control">
                    @foreach ($produk as $product)
                        @if ($product->role_id == $selectedRoleId)
                            <option value="{{ $product->nama_produk }}" {{ $productData['nama_produk'] == $product->nama_produk ? 'selected' : '' }}>
                                {{ $product->kode_produk }} - {{ $product->nama_produk }}
                            </option>
                        @endif
                    @endforeach
                </select>
                <label for="quantity">Quantity:</label>
                <input type="number" name="data_produk[{{ $index }}][qty_produk]" class="quantity-input form-control" value="{{ $productData['qty_produk'] }}">

                <div class="form-group mb-4">
                    <button type="button" class="remove-product btn btn-danger btn-sm mt-2 mb-2" style="float: right">Remove</button>
                </div>
            </div>
        @endforeach


                   
    
        </div>
    </div>
    </div>
            
    <div class="form-group mb-4 ml-3">
    <button type="button" class="add-product btn btn-success">Add More Product</button>

    </div>                                       

                                            <div class="form-group mb-4  ml-3">
                                                <button type="submit" class="btn " style="background-color: #01004C; color: white;">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
          
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var counter = {{ count($package->produk) }}; // Set counter sesuai dengan jumlah produk yang ada

        $('#role').change(function() {
            var roleId = $(this).val();
            $.ajax({
                url: '/getProduct/' + roleId,
                type: 'GET',
                success: function(data) {
                    var productsSelect = $('.product-select');
                    
                    productsSelect.empty();
                    $.each(data, function(key, produk) {
                        
                        productsSelect.append('<option value="' + produk.nama_produk + '">' + produk.kode_produk + " - " + produk.nama_produk + '</option>');
                    });
                }
            });
        });

        $('.add-product').click(function() {
            var productContainer = $('#product-container');
            var productItem = $('<div class="product-item">');
            
            var existingSelect = $('.product-select').eq(0);
            var productSelect = existingSelect.clone();
            
            var existingQuantityInput = $('.quantity-input').eq(0);
            var quantityInput = existingQuantityInput.clone();

            var existingQuantityInput = $('.remove-product').eq(0);
            var removeProduct = existingQuantityInput.clone();

            var counterElement = $('<span class="counter">' + (counter + 1) + '</span>');



productSelect.attr('name', `data_produk[${counter}][nama_produk]`);
            quantityInput.attr('name', `data_produk[${counter}][qty_produk]`);

            productItem.append('<label for="quantity">Product:</label>');
            productItem.append(productSelect);
            productItem.append('<label for="quantity">Quantity:</label>');
            productItem.append(quantityInput);
           
            productItem.append( removeProduct);


            productContainer.append(productItem);

            counter++;
        });

        $(document).on('click', '.remove-product', function() {
            var productContainer = $('#product-container');
            
            if (productContainer.children('.product-item').length > 1) {
                $(this).closest('.product-item').remove();
            } else {
                alert("You cannot remove the first product.");
            }
        });
    });
</script>
@endsection