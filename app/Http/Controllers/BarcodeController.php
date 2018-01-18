<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Barcode;
use Milon\Barcode\DNS1D;
use Excel;
use PHPExcel_Worksheet_Drawing;

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
        $clients = Client::selectRaw('id, CONCAT(code, " (", name, ")") as codeAndName')->pluck('codeAndName', 'id');
        return view('barcode.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Store information to database
        $barcode_info = new Barcode;
        $barcode_info->client_name = $request->client_name;
        $barcode_info->selling_month = $request->selling_month;
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
        $client = Client::findOrFail($info->client_name);
        return view('barcode.show')
            ->withInfo($info)
            ->withId($id)
            ->withClient($client);
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
        $info = $barcode_info->client_name . date("M", mktime(0, 0, 0, $barcode_info->selling_month, 10));;
        $barcode_file_name =  DNS1D::getBarcodePNGPath($info, "C128");

        return response(file_get_contents(public_path() . "/" . $barcode_file_name,200))
            ->header('Content-type', 'image/png');
    }

    /**
     * Export the barcode image to excel file.
     *
     * @param  int  $type
     * @return \Illuminate\Http\Response
     */
    public function export($id)
    {
        $type = 'xlsx';

        // Create the excel file
        return Excel::create('BarcodeForm', function ($excel) use ($id) {

            $excel->sheet('mysheet', function($sheet) use ($id){
                // Create barcode image (.png)
                $barcode_info = Barcode::find($id);
                $client = Client::findOrFail($barcode_info->client_name);
                $info = $client->code . ' ' . date("M", mktime(0, 0, 0, $barcode_info->selling_month, 10));;
                $barcode_file_name =  DNS1D::getBarcodePNGPath($info, "C128");

                //Import image to A1 and C1
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path($barcode_file_name)); //your image path
                $objDrawing->setCoordinates('A1');
                $objDrawing->setWorksheet($sheet);

                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path($barcode_file_name)); //your image path
                $objDrawing->setCoordinates('E1');
                $objDrawing->setWorksheet($sheet);
            });
        })->download($type);
    }
}
