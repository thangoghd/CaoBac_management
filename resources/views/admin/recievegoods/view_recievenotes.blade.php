<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Danh sách phiếu nhập kho</title>
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
                  <h2 class="h2-font mb-5">Danh sách phiếu nhập kho</h2>
                </div>
                <table id="tableProduct" class="table table-hover border table-striped text-center mt-5">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Ngày khởi tạo</th>
                      <th scope="col">Người giao hàng</th>
                      <th scope="col">Công ty</th>
                      <th scope="col">Số phiếu</th>
                      <th scope="col">Thanh toán</th>
                      <th>Trạng thái</th>
                      <td scope="col">Hành động</td>
                    </tr>
                    <tbody>
                      @foreach ($recieveNotes as $index => $item)
                      
                      <tr class="align-middle">
                        <td>{{$index +1}} </td>
                        <td>{{$item->datetime}}</td>
                        <td style="max-width: 250px">{{$item->deliver_name}}</td>
                        <td>{{$item->company_name}}</td>
                        <td>{{$item->note_id}}</td>
                        <td>{{ number_format($item->calculateTotalAmount(), 0, ",", ",");}} </td>
                        <td>{{$item->status}}</td>
                        <td> 
                          <a href="{{ route('detailed.recievenote', ['id' => $item->id])}}" title="Xem chi tiết" class="btn btn-success shadow-none btn-sm"><i class="fa-solid fa-eye"></i></a>
                          <a href="{{route('pdf.recienote',  ['id' => $item->id])}}" title="Tải xuống dưới dạng PDF" class="btn btn-primary shadow-none btn-sm edit"><i class="fa-solid fa-file-pdf"></i></a>               
                          <a type="button" onclick="return confirm('Bạn có chắc rằng muốn xoá? Dữ liệu sẽ không thể phục hồi.')" href="" title="Xoá" class="btn btn-danger shadow-none btn-sm"><i class="fa-solid fa-trash"></i></a>
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

  </body>


  @include('admin.js')
</html>