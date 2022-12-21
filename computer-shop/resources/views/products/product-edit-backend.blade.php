<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{asset('../staff/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/home">Electro</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/staff/info">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Management</div>
                            <a class="nav-link" href="/customer/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Customer
                            </a>
                           
                            <a class="nav-link" href="/product/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Products
                            </a>
                            <a class="nav-link" href="/category/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Categories
                            </a>
                            <a class="nav-link" href="/staff/index">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Staffs
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Staff
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="row">
                            <h1 class="mt-4">Products</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="/staff/info">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="/category/index">Products</a></li>
                                <li class="breadcrumb-item active">Edit Products</li>
                            </ol>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Edit product</h2>
                
                                    @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                                     @endif
                
                                        <form action="{{url('product/update')}}" method="POST">
                                        @csrf
                                        <hr>
                                        <div class="md-3">
                                            <label class="form-label">Product ID: {{$product->productID}}</label>   
                                            <input type="hidden" name="productID" value="{{$product->productID}}">
                                        </div>
                                        <hr>
                                        <div class="md-3">
                                            <label class="form-label">Product name</label>
                                            <input type="text" class="form-control" name="productName" value="{{$product->productName}}">
                                            <span class="text-danger">@error('productName'){{$message}}@enderror</span>
                                        </div>
                                        <hr>
                                        <div class="md-3">
                                            <label class="form-label">Product price</label>
                                            <input type="text" class="form-control" name="productPrice" value="{{$product->productPrice}}">
                                            <span class="text-danger">@error('productPrice'){{$message}}@enderror</span>
                                        </div>
                                        <hr>
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
                                        <hr>
                                        <div class="md-3">
                                            <label class="form-label">Product image</label>
                                            <input type="file" class="form-control" name="productImage" >
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn button-primary">Update</button>
                
                                        <a href="{{url('product/index')}}" class="btn btn-danger">Back</a>
                                    
                                    </form>
                                </div>
                            </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Electro 2022</div>
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('../staff/js/scripts.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{asset('../staff/js/datatables-simple-demo.js')}}"></script>
    </body>
</html>
