<?php

namespace App\Http\Controllers;

use App\Devices;
use App\Http\Requests\DevicesRequest;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Companies;

class DevicesController extends Controller
{
    public function __construct()
    {
        $this->disk = 'image_disk';
    }

    public function create()
    {
        $this->authorize('action', Devices::class);
        $device = new Devices();
        $companies = Companies::orderBy('name')->pluck('name','id');
        return view('layouts.devices.create', [
            'entity' => $device,
            'companies' => $companies,
        ]);
    }

    public function store(DevicesRequest $request)
    {
        $file = $request->file('file');
        $filename = $this->fixedStore($file, '', $this->disk);
        try{
        Devices::create([
            'model_name' => $request->input('model_name'),
            'disc' => $request->input('disc'),
            'price' => $request->input('price'),
            'image' => $filename,
            'ammount' => $request->input('ammount'),
            'company_id' => $request->input('company_id')
             ]);
        }catch (\Exception $exception) {
            Storage::disk($this->disk)->delete($filename);
            throw $exception;
        }
        return redirect(route('devices.index'));
    }

    public function fixedStore($file, $path, $disk) {
        $this->authorize('action', Devices::class);
        $folder = Storage::disk($disk)->getAdapter()->getPathPrefix();
        $temp = tempnam($folder, '');
        $filename = pathinfo($temp, PATHINFO_FILENAME);
        $extension = $file->extension();

        try {
            $basename = $file->storeAs($path, "$filename.$extension", $disk);
        } catch (\Exception $exception) {
            throw $exception;
        } finally {
            unlink($temp);
        }

        return $basename;
    }

    public function edit($id)
    {
        $this->authorize('action', Devices::class);
        $device = Devices::findOrFail($id);
        $companies = Companies::orderBy('name')->pluck('name','id');
        return view('layouts.devices.edit', [
            'entity' => $device,
            'companies' => $companies
        ]);
    }

    public function update(Request $request, $id)
    {
        $file = $request->file('file');
        if (!empty($file)) {
            $filename = $this->fixedStore($file, '', $this->disk);
            try {
                Devices::findOrFail($id)->update([
                    'model_name' => $request->input('model_name'),
                    'disc' => $request->input('disc'),
                    'price' => $request->input('price'),
                    'image' => $filename,
                    'ammount' => $request->input('ammount'),
                    'company_id' => $request->input('company_id')
                ]);
            } catch (\Exception $exception) {
                Storage::disk($this->disk)->delete($filename);
                throw $exception;
            }
        } else {
            Devices::findOrFail($id)->update([
                'model_name' => $request->input('model_name'),
                'disc' => $request->input('disc'),
                'price' => $request->input('price'),
                'ammount' => $request->input('ammount'),
                'company_id' => $request->input('company_id')
            ]);
        }
        return redirect(route('devices.index'));
    }

    public function delete($id)
    {
        $this->authorize('action', Devices::class);
        $device = Devices::findOrFail($id);
        return view('layouts.devices.delete', [
            'entity' => $device
        ]);
    }

    public function destroy($id)
    {
        $device = Devices::findOrFail($id);
        $device->delete($id);
        return redirect(route('devices.index'));
    }

    public function index()
    {
        return view('layouts.devices.index', [
            'devices' => Devices::orderBy('model_name', 'ASC')
            ->with('company')
            ->paginate(10)
        ]);
    }
}
