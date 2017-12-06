<?php

namespace App\Http\Controllers;

use App\Companies;
use DB;
use App\Http\Requests\CompaniesRequest;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function create()
    {
        $this->authorize('action', Companies::class);
        $company = new Companies();
        return view('layouts.companies.create', [
            'entity' => $company
        ]);
    }

    public function store(CompaniesRequest $request)
    {
        $attributes = $request->only(['name']);
        Companies::create($attributes);
        return redirect(route('companies.index'));
    }


    public function edit($id)
    {
        $this->authorize('action', Companies::class);
        $company = Companies::findOrFail($id);
        return view('layouts.companies.edit', [
            'entity' => $company
        ]);
    }

    public function update(Request $request, $id)
    {
        $company = Companies::findOrFail($id);
        $attributes = $request->only(['name']);
        $company->update($attributes);
        return redirect(route('companies.index'));
    }

    public function delete($id)
    {
        $this->authorize('action', Companies::class);
        $company = Companies::findOrFail($id);
        return view('layouts.companies.delete', [
            'entity' => $company
        ]);
    }

    public function destroy($id)
    {
        $company = Companies::findOrFail($id);
        $company->delete($id);
        return redirect(route('companies.index'));
    }

    public function index()
    {
        return view('layouts.companies.index', [
            'companies' => Companies::orderBy('name', 'ASC')
                ->paginate(10)
        ]);
    }
}
