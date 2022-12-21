<div class="col-md-12">
    <h2>Add product</h2>

    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
    @endif

    <form action="{{url('product/save')}}" method="POST">
        @csrf

        <div class="md-3">
            <label class="form-label">Product ID</label>
            <input type="text" class="form-control" name="productID" placeholder="enter product ID">
            <span class="text-danger">@error('productID'){{$message}}@enderror</span>
        </div>

        <div class="md-3">
            <label class="form-label">Product name</label>
            <input type="text" class="form-control" name="productName" placeholder="enter product name">
            <span class="text-danger">@error('productName'){{$message}}@enderror</span>
        </div>

        <div class="md-3">
            <label class="form-label">Product price</label>
            <input type="text" class="form-control" name="productPrice" placeholder="enter product price">
            <span class="text-danger">@error('productPrice'){{$message}}@enderror</span>
        </div>

        <div class="md-3">
            <label class="form-label">Product category</label>
            <select name="categoryID" class="from-control">
                @foreach ($data as $category)
                <option value="{{$category->categoryID}}">
                    {{$category->categoryName}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="md-3">
            <label class="form-label">Product image</label>
            <input type="file" class="form-control" name="productImage" placeholder="select product image">
            <!--<span class="text-danger">@ error('productImage'){ {$message}}@ enderror</span>-->
        </div>

        <button type="submit" class="btn button-primary">Submit</button>

        <a href="{{url('product/index')}}" class="btn btn-danger">Back</a>

    </form>
</div>
</div>