<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Excel;
use Datatables;

class ClientsController extends Controller
{
    /**
 * Import file into database Code
 *
 * @var array
 */
    public function import(Request $request)
    {
        Client::truncate();
        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();

            //$data = Excel::load($path, function($reader) {})->get();
            $extension = $request->file('import_file')->getClientOriginalExtension();
            $destinationPath = 'upload';
            $fileName = 'Danh sach dai ly' . date('m Y').'.'.$extension; // rename the file
            $request->file('import_file')->move($destinationPath, $fileName);
            $data = Excel::load('public/upload/'.$fileName, function($reader) {})->get();

            if(!empty($data) && $data->count()){
                //dd($data->toArray());
                foreach ($data->toArray() as $key => $value) {
                    $insert[] = ['code' => $value['code'],
                        'name' => $value['name'],
                        'address' => $value['address'],
                    ];
                }


                if(!empty($insert)){
                    Client::insert($insert);
                    return back()->with('success','Đã import danh sách đại lý thành công.');
                }

            }

        }

        return back()->with('error','Vui lòng kiểm tra file của bạn. Có lỗi xảy ra.');
    }

    public function anyData()
    {
        $clients = Client::select(['id', 'name', 'code', 'address']);
        return Datatables::of($clients)
            ->addColumn('id', function ($clients) {
                return $clients->id;
            })
            ->addColumn('name', function ($clients) {
                return $clients->name;
            })
            ->addColumn('code', function ($clients) {
                return $clients->code;
            })
            ->addColumn('address', function ($clients) {
                return $clients->address;
            })->make(true);
    }
}
