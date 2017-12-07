<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barcode;
use Milon\Barcode\DNS2D;
use Image;

class BarcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barcode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input data
        $this->validate($request, array(
            'client_name'   => 'required',
            'region'        => 'required',
            'product_name'  => 'required',
            'product_date'  => 'required',
            'expired_date'  => 'required',
            'selling_date'  => 'required'
        ));

        // Store information to database
        $barcode_info = new Barcode;
        $barcode_info->client_name = $request->client_name;
        $barcode_info->region = $request->region;
        $barcode_info->product_name = $request->product_name;
        $barcode_info->product_date = $request->product_date;
        $barcode_info->expired_date = $request->expired_date;
        $barcode_info->selling_date = $request->selling_date;
        $barcode_info->save();


        return redirect()->route('barcode.show', $barcode_info->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = Barcode::find($id);
        return view('barcode.show')
            ->withInfo($info)
            ->withId($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Print the barcode image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function barcodePrint($id)
    {
        // Create barcode image (.png)
        $barcode_info = Barcode::find($id);
        $info = $barcode_info->client_name .
            '|' . $barcode_info->region .
            '|' . $barcode_info->product_name .
            '|' . $barcode_info->product_date .
            '|' . $barcode_info->expired_date .
            '|' . $barcode_info->selling_date;
        $barcode_file_name =  DNS2D::getBarcodePNGPath($info, "QRCODE");

        return response(file_get_contents(public_path() . "/" . $barcode_file_name,200))
            ->header('Content-type', 'image/png');
    }
}
