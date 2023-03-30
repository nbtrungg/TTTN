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
            
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="7">Không có người dùng</td>
        </tr>
        @endif
    </tbody>
</table>