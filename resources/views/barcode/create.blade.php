<html lang="en">
<head>
    <title>HH Barcode Generator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
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
                        <div class="form-group col-sm-6 removeleft">
                            {!! Form::label('client_name', 'Số thứ tự khách hàng:', ['class' => 'control-label']) !!}
                            {!!
                                Form::text('client_name',
                                null,
                                ['class' => 'form-control'])
                            !!}
                        </div>

                        <div class="form-group col-sm-6 removeleft">
                            {!! Form::label('selling_date', 'Ngày xuất hàng:', ['class' => 'control-label']) !!}
                            {!!
                                Form::date('selling_date',
                                \Carbon\Carbon::now(),
                                ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <!--
                    <div class="form-inline">
                        <div class="form-group col-sm-3 removeleft">
                            {!! Form::label('client_name', 'Tên khách hàng:', ['class' => 'control-label']) !!}
                            {!!
                                Form::text('client_name',
                                null,
                                ['class' => 'form-control'])
                            !!}
                        </div>

                        <div class="form-group col-sm-3 col-sm-offset-1 removeleft removeright">
                            {!! Form::label('region', 'Vùng kinh doanh:', ['class' => 'control-label']) !!}
                            {!!
                                Form::text('region',
                                null,
                                ['class' => 'form-control'])
                            !!}
                        </div>
                        <div class="form-group col-sm-3  col-sm-offset-1 removeleft">
                            {!! Form::label('product_name', 'Tên sản phẩm:', ['class' => 'control-label']) !!}
                            {!!
                                Form::text('product_name',
                                null,
                                ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="form-inline">
                        <div class="form-group col-sm-3 removeleft">
                            {!! Form::label('product_date', 'Ngày sản xuất:', ['class' => 'control-label']) !!}
                            {!!
                                Form::date('product_date',
                                \Carbon\Carbon::now()->addDays(7),
                                ['class' => 'form-control'])
                            !!}
                        </div>

                        <div class="form-group col-sm-3 col-sm-offset-1 removeleft removeright">
                            {!! Form::label('expired_date', 'Ngày hết hạn:', ['class' => 'control-label']) !!}
                            {!!
                                Form::date('expired_date',
                                \Carbon\Carbon::now()->addDays(7),
                                ['class' => 'form-control'])
                            !!}
                        </div>

                        <div class="form-group col-sm-3  col-sm-offset-1 removeleft removeright">
                            {!! Form::label('selling_date', 'Ngày bán:', ['class' => 'control-label']) !!}
                            {!!
                                Form::date('selling_date',
                                \Carbon\Carbon::now()->addDays(7),
                                ['class' => 'form-control'])
                            !!}
                        </div>
                    </div>
                    -->
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
        </div>
    </div>
</div>
</table>

</body>


<p class="text-center">Copyright Nguyen Van Cuong - All Rights Reserved</p>
</html>