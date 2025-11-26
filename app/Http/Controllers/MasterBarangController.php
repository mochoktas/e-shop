<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\JenisBarang;
use App\Models\Barang;
use yajra\Datatables\Datatables;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $jenis_barang = JenisBarang::all();
        if ($request->ajax()) {

            $data = Barang::query();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View" class="me-1 btn btn-info btn-sm show-data"><i class="fa-regular fa-eye"></i> View</a>';
                            $btn = $btn. '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm update-data"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';
      
                            // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa-solid fa-trash"></i> Delete</a>';
                            $deleteRoute = route('barang.delete', $row->id);
                            $btn = $btn.'<form action="'.$deleteRoute.'" method="POST" style="display:inline;"> 
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash"></i>Delete</button>
                                </form>
                            ';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->addColumn('jb', function ($row) {
                        return $row->jenis_barang->name;
                    })
                    ->addColumn('photo', function($row){
                        $url = asset('images/'.$row->photo);
                        return '<img src="'.$url.'" border="0" width="50" class="img-rounded" align="center" />';
                    })
                    ->make(true);
        }
        return view('master.barang.index', compact('jenis_barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'unique:barang', 'max:50'],
            'harga' => ['required', 'numeric'],
            'jb_id' => ['required', 'exists:jenis_barang,id']
        ]);
        $barang = Barang::create(
            [
                'name' => $request->name,
                'harga' => $request->harga,
                'jenis_barang_id' => $request->jb_id
            ]
        );
        return redirect()->route('barang.index')
            ->with('success', 'Barang created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Barang::find($id);

        if ($data) {
            // Kembalikan data sebagai respons JSON
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }

        // Jika data tidak ditemukan
        return response()->json([
            'success' => false,
            'message' => 'Data not found.'
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Barang::find($id);

        if ($data) {
            // Kembalikan data sebagai respons JSON
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }

        // Jika data tidak ditemukan
        return response()->json([
            'success' => false,
            'message' => 'Data not found.'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $barang = Barang::find($request->dataid);
        if ($barang->name != $request->field12) {
            $request->validate([
                'field12' => 'required|unique:barang,name,'.$request->dataid.'|max:50'
            ]);
        }
        $barang = Barang::where('id', $request->dataid)
                        ->update([
                            'name' => $request->field12
                        ]);
        return redirect()->route('barang.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Barang::find($id)->delete();
        
        return redirect()->route('barang.index')->with('success', 'Data berhasil dihapus!');
    }
}
