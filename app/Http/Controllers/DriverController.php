<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DriverRequest;
use App\Driver;
use App\User;
use Yajra\Datatables\Datatables;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AjaxCreateTransport(DriverRequest $request) {
        $data = $request->all();
        $driver = Driver::create($data);
        $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully'
        );
        return \Response::json($response);
    }
    public function AjaxGetDataTransport(Request $request) {
        $driver = Driver::find($request->get('id_select_transport'));
        $response = array(
            'type_driver' => $driver->type_driver,
            'name_driver' => $driver->name_driver,
            'phone_driver' => $driver->phone_driver,
            'number_license_driver' => $driver->number_license_driver
        );
        return \Response::json($response);
    }
    public function index(Request $request)
    {
        if ($request->get('name') || $request->get('kho')) {
            $name = $request->get('name');
            $kho = $request->get('kho');
            $driver1 = Driver::query();
            if(!empty($name)){
                if(!Auth::user()->hasRole('kho'))
                    $driver1 =  $driver1->where('name_driver','LiKE','%'.$name.'%')->orwhere('phone_driver','LiKE','%'.$name.'%');
                else {
                    $driver1 =  $driver1->where('kho', Auth::user()->id)->where('name_driver','LiKE','%'.$name.'%')->orwhere('phone_driver','LiKE','%'.$name.'%');
                }
            }
            if(!empty($kho)){
                if(!Auth::user()->hasRole('kho'))
                    $driver1 =  $driver1->where('kho',$kho);
                else {
                    $driver1 =  $driver1->where('kho',Auth::user()->id);
                }
            }
            $driver = $driver1->paginate(9);
        }
        else if(!Auth::user()->hasRole('kho')) {
            $driver = Driver::orderBy('id', 'DESC')
                ->paginate(9);
        }
        else {
            $driver = Driver::orderBy('id','DESC')
                ->where('kho',Auth::user()->id)
                ->paginate(9);
        }
        $user = User::select('users.*','ware_houses.id as ware_houses_id','ware_houses.level as level')
            ->leftjoin('role_user','role_user.user_id','=','users.id')
            ->leftjoin('ware_houses','ware_houses.user_id','=','users.id')
            ->where('role_user.role_id',4)
            ->get();
        
        $data = [
            'user' => $user,
            'driver' => $driver,
        ];
        return view('admin.driver.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.driver.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverRequest $request)
    {
        $data = $request->all();
        $data['kho'] = Auth::user()->id;
        Driver::create($data);
        return redirect('admin/driver/')->with(['flash_level'=>'success','flash_message'=>'Thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = Driver::find($id);
        $data = [
            'id' => $id,
            'driver' => $driver,
        ];
        return view('admin.driver.edit',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = Driver::find($id);
        $data = [
            'id' => $id,
            'driver' => $driver,
        ];
        return view('admin.driver.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, $id)
    {
        $data = $request->all();
        $driver = Driver::find($id);
        $driver->update($data);
        return redirect('admin/driver/')->with(['flash_level'=>'success','flash_message'=>'Lưu thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $driver =  Driver::destroy($id);
        if(!empty($driver)) {
            return redirect('admin/driver/')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công']);
        }
        else{
            return redirect('admin/driver/')->with(['flash_level' => 'danger', 'flash_message' => 'Chưa thể xóa']);
        }
    }
}
