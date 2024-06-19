<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Email;
use App\Models\Role_user;
use App\Models\User;
use App\Notifications\OverSlaNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index(Request $request)
    {

        //$dataLoginUser = Role_user::where('user_id', Session::get('loginId'))->first();
        $dataLoginUser = User::where('user_id', Session::get('loginId'))->first();
        //dd(Session::get('loginId'));
        $isRole = Role_user::where('user_id', Session::get('loginId'))->first();

        $data = [];
        $overSlaCount = 0;


        $query = Customer::with('notify_ref:id,name,sla')
            ->whereNull('deleted_at')
            ->where('status', '!=', 'เซ็นสัญญาแล้ว')
            ->orderBy('id', 'desc');

        $Customers = $query->get();

        $countRenovate = Customer::whereNull('deleted_at')->where('notify_id', 5)->count();
        $countBstrature = Customer::whereNull('deleted_at')->where('notify_id', 6)->count();
        $countDesign = Customer::whereNull('deleted_at')->where('notify_id', 7)->count();


        foreach ($Customers as $Customer) {
            if ($Customer->notify_ref && $Customer->notify_ref->sla) {
                $createdDate = Carbon::parse($Customer->created_at);
                $currentDate = Carbon::now();
                $daysDiff = $createdDate->diffInDays($currentDate);


                if ($daysDiff >= $Customer->notify_ref->sla) {
                    $data[] = [
                        'customer' => $Customer,
                        'dayDiff' => $daysDiff
                    ];
                    $overSlaCount++;
                }
            }
        }




        return view('main.index', compact('isRole', 'dataLoginUser', 'data', 'overSlaCount', 'countRenovate', 'countBstrature', 'countDesign'));
    }


    // public function notifyEmail()
    // {

    //     $data = [];
    //     $overSlaCount = 0;
    //     $query = Customer::with('notify_ref:id,name,sla')
    //         ->whereNull('deleted_at')
    //         ->orderBy('id', 'desc');
    //     $Customers = $query->get();

    //     foreach ($Customers as $Customer) {
    //         if ($Customer->notify_ref && $Customer->notify_ref->sla) {
    //             $createdDate = Carbon::parse($Customer->created_at);
    //             $currentDate = Carbon::now();
    //             $daysDiff = $createdDate->diffInDays($currentDate);

    //             if ($daysDiff >= $Customer->notify_ref->sla) {
    //                 $data[] = [
    //                     'customer' => $Customer,
    //                     'dayDiff' => $daysDiff
    //                 ];
    //                 $overSlaCount++;

    //                 // ส่งอีเมล
    //                 $emails = Email::where('active', 1)->pluck('email');
    //                 Notification::route('mail', $emails)->notify(new OverSlaNotification($Customer, $daysDiff));
    //             }
    //         }
    //     }

    //     return response()->json($data, 200);

    // }

    public function notifyEmail()
    {
        $overSlaCount = 0;
        $customersData = [];
        $emails = [];

        $query = Customer::with('notify_ref:id,name,sla')
            ->whereNull('deleted_at')
            ->where('status', '!=', 'เซ็นสัญญาแล้ว')
            ->orderBy('id', 'desc');

        $customers = $query->get();

        foreach ($customers as $customer) {
            if ($customer->notify_ref && $customer->notify_ref->sla) {
                $createdDate = Carbon::parse($customer->created_at);
                $currentDate = Carbon::now();
                $daysDiff = $createdDate->diffInDays($currentDate);

                if ($daysDiff >= $customer->notify_ref->sla) {
                    $overSlaCount++;



                    $customersData[] = [
                        'customer' => $customer,
                        'daysDiff' => $daysDiff
                    ];
                }
            }
        }


        $emails = Email::where('active', 1)->pluck('email')->toArray();
        Notification::route('mail', $emails)->notify(new OverSlaNotification($customersData, $overSlaCount));


        return response()->json($customersData, 200);
    }
}
