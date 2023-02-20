<?php

namespace App\Http\Controllers\AssetManagement;
use App\Http\Controllers\Controller;
use App\Asset;
use App\assetCategory;
use QrCode;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class MonitoringAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['asset'] = Asset::orderBy('updated_at','desc')->get();
        return view('assetmanagement/monitoring_asset/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['asset'] = Asset::all();
        $data['asset_category']= assetCategory::all();
        return view('assetmanagement/monitoring_asset/create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = new Asset();
            $data->asset_name = $request->asset_name;
            $data->asset_category = $request->asset_category;
            $data->acquisition_date = $request->acquisition_date;
            $data->initial_cost = $request->initial_cost;
            $data->uid = Str::uuid()->toString();
            $data->nama_pengguna = $request->nama_pengguna;
            $data->save();

            $ids = $data->id;
            $ktgri = $data->asset_category;
            $name_asst = $data->asset_name;
            $nama_pengguna = $data->nama_pengguna;
            
            
            if($ktgri == 3){
                if($request->jenis_asset == 1){
                    $generate_qrcode = QrCode::size(50)->generate("RII-ASM-ITLP-".$request->no_asset_laptop."-0".$ids.'/'.$name_asst.' Digunakan Oleh : '.$nama_pengguna);
                    Asset::where('id', $ids)->update(
                        [
                            'asset_number'=> "RII-ASM-ITLP-".$request->no_asset_laptop."-0".$ids,
                            'qrcode'=> $generate_qrcode, 
                            // 'file_name' => "1000".$ids.".svg"
                        ]
                    );
                }
                elseif ($request->jenis_asset == 2) {
                    $generate_qrcode = QrCode::size(50)->generate("RII-ASM-ITPR-0".$ids.'/'.$name_asst.' Digunakan Oleh : '.$nama_pengguna);
                    Asset::where('id', $ids)->update(
                        [
                            'asset_number'=> "RII-ASM-ITPR-0".$ids,
                            'qrcode'=> $generate_qrcode, 
                            // 'file_name' => "1000".$ids.".svg"
                        ]
                    );
                }
                elseif ($request->jenis_asset == 3) {
                    $generate_qrcode = QrCode::size(50)->generate("RII-ASM-ITME-0".$ids.'/'.$name_asst);
                    Asset::where('id', $ids)->update(
                        [
                            'asset_number'=> "RII-ASM-ITME-0".$ids,
                            'qrcode'=> $generate_qrcode, 
                            // 'file_name' => "1000".$ids.".svg"
                        ]
                    );
                }
                elseif ($request->jenis_asset == 4) {
                    $generate_qrcode = QrCode::size(50)->generate("RII-ASM-ITRTR-0".$ids.'/'.$name_asst);
                    Asset::where('id', $ids)->update(
                        [
                            'asset_number'=> "RII-ASM-ITRTR-0".$ids,
                            'qrcode'=> $generate_qrcode, 
                            // 'file_name' => "1000".$ids.".svg"
                        ]
                    );
                }
                elseif ($request->jenis_asset == 5) {
                    $generate_qrcode = QrCode::size(50)->generate("RII-ASM-ITTV-0".$ids.'/'.$name_asst);
                    Asset::where('id', $ids)->update(
                        [
                            'asset_number'=> "RII-ASM-ITTV-0".$ids,
                            'qrcode'=> $generate_qrcode, 
                            // 'file_name' => "1000".$ids.".svg"
                        ]
                    );
                }
                elseif ($request->jenis_asset == 6) {
                    $generate_qrcode = QrCode::size(50)->generate("RII-ASM-ITPY-0".$ids.'/'.$name_asst);
                    Asset::where('id', $ids)->update(
                        [
                            'asset_number'=> "RII-ASM-ITPY-0".$ids,
                            'qrcode'=> $generate_qrcode, 
                            // 'file_name' => "1000".$ids.".svg"
                        ]
                    );
                }
                elseif ($request->jenis_asset == 8) {
                    $generate_qrcode = QrCode::size(50)->generate("RII-ASM-ITHT-0".$ids.'/'.$name_asst.' Digunakan Oleh : '.$nama_pengguna);
                    Asset::where('id', $ids)->update(
                        [
                            'asset_number'=> "RII-ASM-ITHT-0".$ids,
                            'qrcode'=> $generate_qrcode, 
                            // 'file_name' => "1000".$ids.".svg"
                        ]
                    );
                }
                else{
                    $generate_qrcode = QrCode::size(50)->generate("RII-ASM-ITXX-0".$ids.'/'.$name_asst);
                    Asset::where('id', $ids)->update(
                        [
                            'asset_number'=>"RII-ASM-ITXX-0".$ids,
                            'qrcode'=> $generate_qrcode, 
                            // 'file_name' => "1000".$ids.".svg"
                        ]
                    );
                }
            }
            else{
                $generate_qrcode = QrCode::size(50)->generate("1000".$ids.'/'.$name_asst);
                Asset::where('id', $ids)->update(
                    [
                        'asset_number'=> "1000".$ids,
                        'qrcode'=> $generate_qrcode, 
                        // 'file_name' => "1000".$ids.".svg"
                    ]
                );
            }
            // $convert_qrcode = base64_encode($generate_qrcode);
            // return public_path();
            $dt = Asset::where('id', $ids)->first();

            Storage::disk('local')->put($dt->asset_number."."."svg", $generate_qrcode);
            
            // QrCode::size(50)
            //         ->format('png')
            //         ->generate("1000".$ids, public_path('uploads/Asset/qrcode.png'));
            
            return redirect('/list-asset')->with('success', 'Berhasil menyimpan data');
        }
        catch(\Exception $e){
            return redirect('/list-asset')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $data['asset'] = Asset::where('uid', $uid)->first();
        $data['asset_category']= assetCategory::all();
        return view('assetmanagement/monitoring_asset/edit')->with($data);
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
       try{
            $data = Asset::find($id);
            // $data->asset_name = $request->asset_name;
            // $data->asset_category = $request->asset_category;
            // $data->acquisition_date = $request->acquisition_date;
            // $data->initial_cost = $request->initial_cost;
            // $data->acc_depreciation = $request->acquisition_depreciation;
            // $data->book_value = $request->book_value;
             $data->nama_pengguna = $request->nama_pengguna;
             
            if($data->getOriginal('asset_name') != $request->asset_name){
                $data->qrcode = QrCode::size(50)->generate($data->asset_number.'/'.$request->asset_name);
            }
            else{
                echo "tidak ada update";
            }
            $data->save();

            $dt = Asset::where('id', $id)->first();

            // Storage::disk('local')->delete($dt->asset_number."."."svg", $generate_qrcode);
            // Storage::disk('local')->put($dt->asset_number."."."svg", $generate_qrcode);
            
            return redirect('/list-asset')->with('success', 'Berhasil menyimpan data');
        }
        catch(\Exception $e){
            return redirect('/list-asset')->with('failed', 'Silahkan Cek Kembali Inputan Anda');
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::destroy($id);
        if($asset){
            return response()->json([
                'success'=> 'Data asset berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'failes'=> 'Data asset gagal dihapus'
            ]);
        }
        return response($response);
    }

    public function downloadQRCode($id){
        $qrcode = Asset::where('id', $id)->firstOrFail();
        $path   = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $dt_path = $path.$qrcode->asset_number.".svg";
        $headers = ['Content-Type' => 'application/svg+xml'];
        $nama_file = "Asset_".$qrcode->asset_number.".svg";

        return response()->download($dt_path, $nama_file, $headers);
     }

     public function downloadAllQRCode(Request $request){
        $getdatas = Asset::whereIn('id', $request->id)->get();

        foreach($getdatas as $qrcode) {
            $path   = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
            $dt_path = $path.$qrcode->asset_number.".svg";
            $headers = ['Content-Type' => 'application/svg+xml'];
            $nama_file = "Asset_".$qrcode->asset_number.".svg";
            return response()->download([$dt_path, $nama_file, $headers]);
        }
        
        // return response()->json([
        //     'status' => true, 
        //     'message' => 'Download berhasil'
        // ]);

     }

}
