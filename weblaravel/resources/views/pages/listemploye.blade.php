@extends('index')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1  style="color: white">Danh Sách Nhân Viên</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li   class="breadcrumb-item"><a style="color: white" href="#">Trang Chủ</a></li>
                    <li  style="color: white" class="breadcrumb-item active">Danh Sách Nhân Viên</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        {{-- @include('admin.users.alert') --}}
        {{-- @if(Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif --}}
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
        <div class="row">
            <!-- left column -->
            
            <div class="card card-primary">
            
            {{-- <div class="card-body">
                <button type="button" id="mapbutton" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mapsModal"><i class="fas fa-plus-square"></i></button>
            </div> --}}
            
            <div class="card-body">
                    {{-- <div class="row">
                        <div class="col-sm-12">
                            <table id="employeTable" class="table table-bordered table-striped dataTable dtr-inline"
                                style="text-align:center" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                       
                                        <th  style="text-align:center" class="sorting sorting_asc">STT</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">Tên Nhân Viên</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">SĐT</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">Email</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">Địa Chỉ</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">Trạng Thái</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">Vai Trò</th>
                                        <th  style="text-align:center" class="sorting sorting_asc"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($users))
                                    @foreach ($users as $key=> $item)
                                    <tr class="odd">
                                        
                                        <td class="dtr-control sorting_1">{{$key+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>
                                          @if ($item->status==0)
                                          <span class="badge badge-success">Hoạt dộng</span>
                                          @else
                                          <span class="badge badge-danger">Không hoạt động</span>
                                          @endif
                                        </td>
                                        <td>
                                          @if ($item->roll==0)
                                          <span class="badge badge-primary">QTV</span>
                                          @else
                                          <span class="badge badge-info">NV</span>
                                          @endif
                                        </td>
                                        <td>
                                            <a href="{{route('addemploye')}}" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i></a>
                                            <a href="{{route('employe_edit',['id'=>$item->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('employe_delete',['id'=>$item->id])}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7">Không có người dùng</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                

                    <div class="event-schedule-area-two bg-color pad100">
                        <div class="container" style="max-width: 100%; margin-bottom: 10px;">
                            <!-- row end-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                                            <div class="table-responsive">
                                                <table id="employeTable" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%;" class="text-center" scope="col">STT</th>
                                                            <th style="width: 12%;" class="text-center" scope="col">Ảnh Đại Diện</th>
                                                            <th style="width: 43%;" class="text-center" scope="col">Thông Tin Nhân Viên</th>
                                                            <th style="width: 10%;" class="text-center" scope="col">Vai Trò</th>
                                                            <th style="width: 15%;" class="text-center" scope="col">Trạng Thái</th>
                                                            <th style="width: 15%;" class="text-center" class="text-center" scope="col"><a title="Thêm Nhân Viên Mới" href="{{route('addemploye')}}" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> Thêm Nhân Viên</a></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($users))
                                                        @foreach ($users as $key=> $item)
                                                        <tr class="inner-box">
                                                            <td class="text-center" scope="row">
                                                                <div class="event-date">
                                                                    <h3>{{$key+1}}</h3>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="event-img">
                                                                    <img src="{{$item->avatar}}" alt="" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h5 style=" margin-bottom: 0;color:#0561d5;">{{$item->name}}</h5>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <i class="fas fa-phone-square-alt" style="padding: 5px 5px; color:green"></i><span>{{$item->phone}}</span>
                                                                        </div>
                                                                        <div class="categories">
                                                                            <i class="fas fa-envelope" style="padding: 5px 5px; color:darkgray"></i><span>{{$item->email}}</span>
                                                                        </div>
                                                                        <div class="time">
                                                                            <i class="fas fa-map-marker-alt" style="padding: 5px 5px;color:red"></i><span>{{$item->address}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="r-no">
                                                                    @if ($item->roll==0)
                                                                    <span class="badge badge-primary" style="font-size: 13px;">QTV</span>
                                                                    @else
                                                                    <span class="badge badge-info" style="font-size: 13px;">NV</span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="r-no">
                                                                    @if ($item->status==0)
                                                                    <span class="badge badge-success" style="font-size: 13px;">Hoạt dộng</span>
                                                                    @else
                                                                    <span class="badge badge-danger" style="font-size: 13px;">Không hoạt động</span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                
                                                                <a title="Chỉnh Sửa Thông Tin Nhân Viên" href="{{route('employe_edit',['id'=>$item->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                                                                <a title="Xóa Nhân Viên" href="{{route('employe_delete',['id'=>$item->id])}}" id="deleteemploye" class="deleteemploye btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Xóa</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="7">Không có người dùng</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /col end-->
                            </div>
                            <!-- /row end-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-body">

                    <div id="map"  style="height: 500px"></div>
                </div>
                <script>
                    goongjs.accessToken = 'Kg2es1ieNqsjTkaZe34jPyl0UiBITLiKa1LUi8zt';
                        var map = new goongjs.Map({
                        container: 'map', // container id
                        style: 'https://tiles.goong.io/assets/goong_map_web.json', // stylesheet location
                        center: [106.774048,  10.827710], // starting position [lng, lat]
                        zoom: 11 // starting zoom
                    });

                        // Add the control to the map.
                        map.addControl(
                        new GoongGeocoder({
                        accessToken: 'BnXQ3RfXH58z86RM5OJ4zrv1pnbV5A34I9cfHcTN',
                        goongjs: goongjs
                        })
                        );                   
                        
                       // Duyệt qua các nhân viên và thêm marker tương ứng trên bản đồ
                        @foreach ($usermaps as $usermap)
                        // Lấy địa chỉ của nhân viên
                        var address = '<?php echo $usermap->address; ?>';

                        // Tìm kiếm tọa độ của địa chỉ trên Goong API Map
                    //     goongjs.geocode(address, 'place').then(function(results) {
                    //     // Lấy tọa độ đầu tiên của kết quả
                    //     var lngLat = results.features[0].center;

                    //     // Tạo marker trên bản đồ
                    //     new goongjs.Marker()
                    //         .setLngLat(lngLat)
                    //         .addTo(map);
                    // });
                        fetch('https://rsapi.goong.io/Geocode?address='+address+'&api_key=BnXQ3RfXH58z86RM5OJ4zrv1pnbV5A34I9cfHcTN')
                        .then(response => response.json())
                        .then(data => {
                            // Lấy tọa độ đầu tiên của kết quả
                            var lat = data.results[0].geometry.location.lat;
                            var lng = data.results[0].geometry.location.lng;
                            console.log(lng);

                            // Tạo marker trên bản đồ
                            
                            // var marker = new goongjs.Marker()
                            // .setLngLat([lng,lat])
                            
                            // .addTo(map);     
                            
                            // create the popup
                            let thongBao = "Hello Java!"+"<br>"+"How r u?";
                            var popup = new goongjs.Popup({ offset: 25 }).setHTML('<span style="font-size: 20px;color: #0561d5;"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{$usermap->name}}</span><br>'+
                            '<span style="font-size: 15px;"><i class="fas fa-phone-square-alt" style="color:green; width:20px; text-align: center;"></i> {{$usermap->phone}}</span><br>'+
                            '<span style="font-size: 15px;"><i class="fas fa-envelope" style="color:darkgray; width:20px; text-align: center;"></i> {{$usermap->email}}</span><br>'+
                            '<span style="font-size: 15px;"><i class="fas fa-map-marker-alt" style="color:red; width:20px; text-align: center;"></i> {{$usermap->address}}</span>');

                            // create DOM element for the marker
                            var el = document.createElement("div");
                            el.id = "marker";
                            el.style.backgroundImage ='url({{$usermap->avatar}})';

                            // create the marker
                            new goongjs.Marker(el)
                                .setLngLat([lng,lat])
                                .setPopup(popup) // sets a popup on this marker
                                .addTo(map);                           
                        });                   
                        @endforeach
                </script>
            </div>
            
        </div>
        
        <!--/.col (right) -->
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<div id="mapsModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">Bản đồ</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
      </div>
    </div>
  </div>


@endsection