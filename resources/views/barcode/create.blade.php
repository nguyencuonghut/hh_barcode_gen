<html lang="en">
<head>
    <title>HH Barcode Generator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
            <h3>Tạo mã vạch</h3>
                <div style="border: 4px solid #a1a1a1;margin-top: 15px;margin-bottom: 15px;padding: 20px;">
                    {!! Form::open(array('route' => 'barcode.store', 'class' => 'form')) !!}
                    <div class="form-inline">
                        <div class="form-group col-sm-7 removeleft">
                            {!! Form::label('client_name', 'Mã KH:', ['class' => 'control-label']) !!}
                            {!! Form::select('client_name', $clients, null, ['id'=>'client_name', 'name'=>'client_name','class'=>'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-4 col-sm-offset-1 removeleft">
                            {!! Form::label('selling_month', 'Tháng xuất hàng:', ['class' => 'control-label']) !!}
                            {!! Form::selectMonth('selling_month', date('m', strtotime('this month')), ['class' => 'field form-control'], '%m') !!}
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="form-group">
                        {!! Form::submit('Tạo mã vạch',
                          array('class'=>'btn btn-primary')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <h3>Import danh sách khách hàng</h3>
                <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('client/import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

                    <input type="file" name="import_file" />
                    {{ csrf_field() }}
                    <br/>

                    <button class="btn btn-primary">Import CSV hoặc Excel File</button>

                </form>
        </div>
    </div>
</div>
</table>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $("#client_name").select2({
        placeholder: "Chọn mã đại lý",
        allowClear: true
    });
</script>

</body>


<p class="text-center">Copyright Nguyen Van Cuong - All Rights Reserved</p>
</html>