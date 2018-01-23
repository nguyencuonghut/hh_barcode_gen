<html lang="en">
<head>
    <title>HH Barcode Generator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
</head>

<body>
<br/>
<br/>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title" style="padding:12px 0px;font-size:25px; "><strong>Website tạo và in mã vạch sản phẩm</strong></h3>
        </div>
        <div class="panel-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <h3 class="moveup">Tạo mã vạch
                <span class="pull-right">
                    <a href="{{route('barcode.create', $id)}}"><button type="button" class="btn btn-success">Tạo mã vạch mới</button></a>
                </span>
                </h3>
                <div style="border: 4px solid #a1a1a1;margin-top: 15px;margin-bottom: 15px;padding: 10px;">
                    <div class="form-inline">
                        <div class="form-group col-sm-6 removeleft">
                            {!! Form::label('client_name', 'Khách hàng:', ['class' => 'control-label']) !!}
                            {{$client->code}} - {{$client->name}}
                        </div>

                        <div class="form-group col-sm-6 removeleft">
                            {!! Form::label('selling_month', 'Tháng xuất hàng:', ['class' => 'control-label']) !!}
                            {{date("M", mktime(0, 0, 0, $info->selling_month, 10))}}
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>



                    <div class="container text-center" style="border: 1px solid #a1a1a1;padding: 15px;width: 70%;">
                        <?php
                        $barcode_info = $info->client_name . ' ' . date("M", mktime(0, 0, 0, $info->selling_month, 10));
                        ?>
                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcode_info, 'C128')}}" alt="barcode" />
                    </div>
                </div>
            <br/>

            <!--
            <h3>In mã vạch</h3>
            <div style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;">
                <a target="_blank" href="{{route('barcode.print', $id)}}"><button class="btn btn-success btn-lg">In</button></a>
            </div>
            -->
            <h3>Tải file mẫu in mã vạch:</h3>
            <div style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;">
                <a href="{{ url('barcode/export', $id) }}"><button class="btn btn-success btn-lg">Tải file</button></a>
            </div>
            <h3>Tra cứu mã vạch:</h3>
            <div style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;">
                <table class="table table-hover" id="clients-table">
                    <thead>
                    <tr>
                        <th>{{ __('Số TT') }}</th>
                        <th>{{ __('Mã KH') }}</th>
                        <th>{{ __('Tên') }}</th>
                        <th>{{ __('Địa chỉ') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</div>
</table>

<script src="//code.jquery.com/jquery.js"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
</body>

<script>
    $(function () {
        $('#clients-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('client.data') !!}',
            columns: [

                {data: 'id', name: 'id'},
                {data: 'code', name: 'code', searchable:false},
                {data: 'name', name: 'name', searchable:false},
                {data: 'address', name: 'address', searchable:false},
            ]
        });
    });
</script>

<p class="text-center">Copyright Nguyen Van Cuong - All Rights Reserved</p>
</html>