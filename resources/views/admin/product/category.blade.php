<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style type="text/css">
    </style>
    <title>Thêm nhóm sản  phẩm</title>
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
                    <h2 class="h2-font">Thêm tên nhóm sản phẩm</h2>
                    <form action="{{route('add.category')}}" method="POST">
                      @csrf
                        <input type="text" class="form-control mb-5" name="category" placeholder="Viết tên nhóm sản phẩm">
                        <input type="submit" name="submit" class="btn btn-primary " value="Thêm">
                    </form>
                </div>
                <table class="table table-hover border text-center mt-5">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Tên nhóm sản phẩm</th>
                      <th scope="col">Hành động</th>
                    </tr>
                    <tbody>
                      @foreach ($data as $index => $item)
                      <tr class="align-middle">
                        <td>{{$index +1}} </td>
                        <td>{{$item->category_name}}</td>
                        <td>                        
                          <a type="button" onclick="return confirm('Bạn có chắc rằng muốn xoá? Dữ liệu sẽ không thể phục hồi.')" href="{{route('delete.category', $item->id)}}" title="Xoá" class="btn btn-danger shadow-none btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </thead>
                </table>
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