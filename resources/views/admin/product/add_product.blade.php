<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Thêm sản phẩm</title>
  </head>
  <body id="page-top">
    <div id="wrapper">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
      <!-- partial -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="container-fluid">
            <div class="">
                <div class="div-center">
                    <h2 class="h2-font mb-5">Thêm sản phẩm</h2>
                    <form action="{{route('create.product')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-md-4 mx-3 mb-5">
                          <label class="form-label fw-bold">Tên sản phẩm</label>
                          <input type="text" class="form-control" name="product_name" placeholder="Viết tên sản phẩm" required>
                        </div>
                        <div class="col-md-4 mx-3 mb-5">
                          <label class="form-label fw-bold">Ảnh sản phẩm</label>
                          <input type="file" class="form-control" name="image">
                        </div>
                        <div class="col-md-4 mx-3 mb-5">
                          <label class="form-label fw-bold">Giá</label>
                          <input type="number" class="form-control" name="price" placeholder="Viết giá sản phẩm" required>
                        </div>
                        <div class="col-md-4 mx-3 mb-5">
                          <label class="form-label fw-bold">Nhóm sản phẩm</label>
                          <select class="form-control" name="category_id">
                            @foreach($category as $index =>$item)
                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-9 mx-3 mb-5">
                          <label class="form-label fw-bold">Mô tả</label>
                          <textarea name="decription" class="form-control" rows="10"></textarea>
                        </div>
                        
                      </div>

                        <input type="submit" name="submit" class="btn btn-primary " value="Thêm sản phẩm">
                    </form>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.js')
  </body>
</html>