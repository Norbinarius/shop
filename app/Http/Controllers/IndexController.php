<?php

namespace App\Http\Controllers;

use App\Devices;
use App\Http\Requests\DevicesRequest;
use App\Orders;
use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Companies;
use App\Bucket;
use Illuminate\Support\Facades\Input;
use Roumen\Feed\Feed;
use Yangqi\Htmldom;

class IndexController extends Controller
{

    public function index()
    {
        $companies = Companies::orderBy('name')->pluck('name','id')->toArray();
        $maxprice = collect(\DB::select("SELECT MAX(devices.price) as price FROM devices"))->first()->price;
        return view('layouts.index', [
            'companies' => $companies,
            'maxprice' => $maxprice,
            'devices' => Devices::orderBy('model_name', 'ASC')
            ->with('company')
            ->paginate(6)
        ]);
    }

    public function indexFilters(Request $req){
        $companies = Companies::orderBy('name')->pluck('name','id')->toArray();
        $valueCompany = $req->input('companies');
        $valueTo = $req->input('to');
        $valFrom = $req->input('from');
        if ($req->input('companies') != 'empty') {
            $company = DB::table('companies')->where('id', $req->input('companies'))->first()->name;
            $devices = DB::select("SELECT
                                devices.id,
                                devices.model_name,
                                devices.image,
                                devices.price,
                                devices.ammount,
                                companies.name
                            FROM devices
                            LEFT JOIN companies
                            ON companies.id = devices.company_id
                            WHERE companies.name = '".$company."' AND devices.price BETWEEN ".$req->input('from')." AND ".$req->input('to')."");
        } else {
            $devices =  DB::select("SELECT
                                devices.id,
                                devices.model_name,
                                devices.image,
                                devices.price,
                                devices.ammount,
                                companies.name
                            FROM devices
                            LEFT JOIN companies
                            ON companies.id = devices.company_id
                            WHERE devices.price BETWEEN ".$req->input('from')." AND ".$req->input('to')."");
        }
        return view('layouts.indexFilters', [
            'companies' => $companies,
            'devices' => $devices,
            'valComp' => $valueCompany,
            'valTo' => $valueTo,
            'valFrom' => $valFrom
        ]);
    }

    public function newsIndex(){
        $html = new \Yangqi\Htmldom\Htmldom('http://www.4pda.ru');
        return view('layouts.news', [
            'images' => $html->find('article[class=post] img'),
            'titles' => $html->find('article[class=post] a[rel=bookmark]'),
            'desc' => $html->find('article[class=post] div[itemprop=description] p')
        ]);
    }

    public function showItem($id) {
        return view('layouts.showItem', [
            'device' => Devices::findOrFail($id)
        ]);
    }

    public static function addToBucket(Request $request, $id){
        Bucket::create([
            'user_id' => Auth::id(),
            'ordered' => false,
            'device_id' => $id
        ]);
        DB::statement("UPDATE devices 
            SET devices.ammount = devices.ammount - 1 
            WHERE devices.id = ".$id."");
        $request->session()->flash('alert-success', 'Товар успешно добавлен в корзину!');
        return redirect(route('layouts.index'));
    }

    public function indexBucket() {
        $items = DB::select("SELECT
                                bucket.id,
                                devices.model_name,
                                devices.image,
                                devices.price,
                                companies.name
                            FROM bucket
                            LEFT JOIN devices
                            ON devices.id = bucket.device_id
                            LEFT JOIN companies
                            ON companies.id = devices.company_id
                            WHERE bucket.user_id = ".Auth::id()." AND bucket.ordered = 0");
        $total = DB::select("SELECT
                                SUM(devices.price) as total,
                                COUNT(bucket.id) as count
                            FROM bucket
                            LEFT JOIN devices
                            ON devices.id = bucket.device_id
                            WHERE bucket.user_id = ".Auth::id()." AND bucket.ordered = 0");
        return view('layouts.bucket', [
            'items' => $items,
            'total' => $total
        ]);
    }

    public function deleteFromBucket($id){
        DB::statement("UPDATE devices 
            INNER JOIN bucket ON devices.id = bucket.device_id
            SET devices.ammount = devices.ammount + 1 
            WHERE devices.id = bucket.device_id AND bucket.id = ".$id."");
        Bucket::findOrFail($id)->delete($id);
        return redirect(route('layouts.bucket'));
    }

    public function orderConfirmation(Request $request){
        //Устанавливаем переменную ордеред в тру, чтобы эти товары больше не высвечивались в корзине
        Orders::create($request->all());
        $order = collect(\DB::select("SELECT orders.id FROM orders ORDER BY orders.id DESC LIMIT 1"))->first()->id;
        DB::statement("UPDATE bucket SET bucket.order_id = ".$order." WHERE bucket.user_id = ".Auth::id()." AND bucket.ordered = 0");
        DB::statement("UPDATE bucket SET bucket.ordered = 1 WHERE bucket.user_id = ".Auth::id()."");
        $request->session()->flash('alert-success', 'Ваш заказ принят в обработку!');
        return redirect(route('layouts.index'));
    }

    public function paginate($array_of_objects, $page){
        $collection = collect($array_of_objects);

        $num_per_page = 20;
        if (!$page) {
            $page = 1;
        }

        $offset = ( $page - 1) * $num_per_page;
        $collection = $collection->splice($offset, $num_per_page);

        return  new Paginator($collection, count($array_of_objects), $num_per_page, $page);
    }

    public function getFeedDevice($id){
        $feed = App::make("feed");
            $devices = \DB::table('devices')
                ->select('devices.model_name', 'devices.price', 'devices.image', 'devices.ammount', 'devices.disc', 'companies.name')
                ->leftJoin('companies', 'devices.company_id', '=', 'companies.id')
                ->where('devices.id', $id)
                ->get();
            foreach ($devices as $device)
            {
                $feed->addDevice($device->model_name, $device->name, $device->image, $device->disc, $device->ammount, $device->price);
            }


       return $feed->render('atom');
    }
}
