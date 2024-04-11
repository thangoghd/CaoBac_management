<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Danh sách sản phẩm</title>
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
                  <h2 class="h2-font mb-5">Danh sách sản phẩm</h2>
                </div>
                <table id="tableProduct" class="table table-hover border table-striped text-center mt-5">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Tên sản phẩm</th>
                      <th scope="col">Ảnh</th>
                      <th scope="col">Mã sản phẩm</th>
                      <th scope="col">Tồn kho thực tế</th>
                      <th scope="col">Tồn kho ảo</th>
                      <th scope="col">Nhóm sản phẩm</th>
                      <th scope="col">Giá bán lẻ</th>
                      <th scope="col">Tag</th>
                    </tr>
                    <tbody>
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

  </body>

  @include('admin.js')
</html>