@extends('index')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        @if(Session::has('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{Session::get('error')}}',
                showConfirmButton: false,
                timer: 1500
                })
            })
        </script>
        @endif
        @if(Session::has('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function (event) {
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{Session::get('success')}}',
                    showConfirmButton: false,
                    timer: 1500
                    })
                })
            </script>
        @endif
        
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="color: white">Nhập / Xuất Excel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a  style="color: white" href="#">Trang chủ</a></li>
            <li  style="color: white" class="breadcrumb-item active">Nhập / Xuất Excel</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    
    <div class="container-fluid col-md-12">
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      {{-- @include('admin.users.alert') --}}
      
      <div class="row" style="    margin: 5% 0%">
        <!-- left column -->
        <div class="col-md-6" style="padding: 0 10px 0 0">
          <!-- jquery validation -->
          <div class="card card-primary" >
            <div class="container">
              <div class="">
                <div class="card-body">
                    <h3 style="margin: 10px 0 25px 0;text-align: center;">Nhân Viên</h3>
                      <form action="{{ route('importEmploye') }}" method="POST" enctype="multipart/form-data">
                        <h6>Xuất File Excel Nhân Viên:</h6>
                        <a class="btn btn-success" style="margin-bottom:25px;" href="{{ route('exportEmploye') }}"><i class="fa fa-download" aria-hidden="true"></i> Xuất File</a>
                          @csrf
                          <h6>Thêm Nhân Viên Bằng File Excel:</h6>
                          <span>Chọn File Excel Nhân Viên</span>
                          <input type="file" name="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                          <br>
                          

                          
                            <button style="color:white; float: right; margin-bottom:10px;" class="btn btn-warning"><i class="fa fa-upload" aria-hidden="true"></i> Thêm File Excel Nhân Viên</button>
                          
                
                      </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>

        <div class="col-md-6" style="padding: 0 0 0 10px">
          <div class="card card-primary" >
            <div class="card-body">
              <h3 style="margin: 10px 0 25px 0; text-align: center;">Khách Hàng</h3>
              <form action="{{route('importCustomer')}}" method="POST" enctype="multipart/form-data">
                <div>
                  <h6>Xuất File Excel Khách Hàng:</h6>
                  <a class="btn btn-success" style="margin-bottom:25px;" href="{{ route('exportCustomer') }}"><i class="fa fa-download" aria-hidden="true"></i> Xuất File</a>
                </div>
                @csrf
                <h6>Thêm Khách Hàng Bằng File Excel:</h6>
                <span>Chọn File Excel Khách Hàng</span>
                <input type="file" name="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                <br>

                  
                  <button style="color:white; float: right;margin-bottom:10px;" class="btn btn-warning"><i class="fa fa-upload" aria-hidden="true"></i> Thêm File Excel Khách Hàng</button>
                
      
            </form>
            </div>
          </div>
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
  </section>
  @endsection