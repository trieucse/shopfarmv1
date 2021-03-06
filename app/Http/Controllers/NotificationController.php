<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function AjaxUpdateIsReadNotify(Request $request){
        //Log::debug('behai',['vaooooo']);
        if(Auth::user()->hasRole('kho')) {
            $strUserID = Auth::user()->id;
            $notify = Notification::where('is_read','=','0')->where('roleview',$strUserID)->get();
        }
        else {
            $view = Util::$roleviewAdmin;
            $notify = Notification::where('is_read','=','0')->where('roleview',$view)->get();
        }
        if ( count($notify) !=0 ){
            $data = [
              'is_read' => 1
            ];
            foreach ($notify as $itemNotify) {
                $noti = Notification::find($itemNotify->id);
                $noti->update($data);
            }
        }
        $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
        );
        //dd($notify);
        return \Response::json($response);
    }
    public function index()
    {
        //$arrUser = User::get();
        $strUserID = Auth::user()->id;
        if(Auth::user()->hasRole('kho')) {
            $arrNotification = Notification::leftjoin('users','notification.author_id','=','users.id')
                ->leftjoin('ware_houses','ware_houses.user_id','=','notification.author_id')
                ->where('notification.roleview',$strUserID)
                ->selectRaw('users.* ')
                ->selectRaw('ware_houses.* ')
                ->selectRaw('notification.created_at,notification.keyname,notification.orderID_or_productID,notification.title,notification.content,notification.roleview,notification.author_id')
                ->orderBy('notification.id','DESC')
                ->paginate(20);
        }
        else {
            $view = Util::$roleviewAdmin;
            $arrNotification = Notification::leftjoin('users','notification.author_id','=','users.id')
                ->leftjoin('ware_houses','ware_houses.user_id','=','notification.author_id')
                ->where('notification.roleview',$view)
                ->selectRaw('users.* ')
                ->selectRaw('ware_houses.* ')
                ->selectRaw('notification.created_at,notification.keyname,notification.orderID_or_productID,notification.title,notification.content,notification.roleview,notification.author_id')
                ->orderBy('notification.id','DESC')
                ->paginate(20);
        }

        $data = [
            'arrNotification' => $arrNotification
        ];
        //dd($arrNotification);
        return view('admin.notification.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
