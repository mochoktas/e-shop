<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\JenisBarang;
use yajra\Datatables\Datatables;

class MasterJenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $jenisBarang = JenisBarang::all();
        // $jenisBarang2 = json_encode($jenisBarang);
        // $jenisBarang3 = json_decode($jenisBarang2);
        // dd($jenisBarang3);
        if ($request->ajax()) {

            $data = JenisBarang::query();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View" class="me-1 btn btn-info btn-sm show-data"><i class="fa-regular fa-eye"></i> View</a>';
                            $btn = $btn. '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm update-data"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';
      
                            // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa-solid fa-trash"></i> Delete</a>';
                            $deleteRoute = route('jenisBarang.delete', $row->id);
                            $btn = $btn.'<form action="'.$deleteRoute.'" method="POST" style="display:inline;"> 
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash"></i>Delete</button>
                                </form>
                            ';
    
                            
    
                            // $btn .= '<form action="'.$deleteRoute.'" method="POST" style="display:inline;">';
                            // $btn .= '<input type="hidden" name="_token" value="'.csrf_token().'">'; 
                            // $btn .= '<input type="hidden" name="_method" value="DELETE">'; 
                            // $btn .= '<button type="submit" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')"><i class="fa-solid fa-trash"></i>Delete</button>';
                            // $btn .= '</form>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('master.jenis-barang.index');
    }
    // public function getJenisBarang()
    // {
    //     $jenisBarang = JenisBarang::query();
    //     // $data = json_encode($jenisBarang);
    //     // $data2 = json_decode($data);
    //     // return response()->json($jenisBarang);
    //     return Datatables::of($jenisBarang)->make(true);
    // }

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
    public function store(Request $request): RedirectResponse
    {
        //
        // dd($request);
        // 1. Validasi Data
        $request->validate([
            'name' => ['required', 'unique:jenis_barang', 'max:50']
        ]);
        $jenisBarang = JenisBarang::create($request->all());
        return redirect()->route('jenisBarang.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        // $jenisBarang = JenisBarang::find($id);
        // return response()->json($jenisBarang);

        // Temukan data berdasarkan ID
        $data = JenisBarang::find($id);

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
    public function edit($id)
    {
        //
        $data = JenisBarang::find($id);

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
        // dd($request);

        $request->validate([
            'field12' => ['required', 'unique:jenis_barang,name', 'max:50']
        ]);
        $jenisBarang = JenisBarang::where('id', $request->dataid)
                        ->update([
                            'name' => $request->field12
                        ]);
        return redirect()->route('jenisBarang.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        //
        JenisBarang::find($id)->delete();
        
        return redirect()->route('jenisBarang.index')->with('success', 'Data berhasil dihapus!');
    }
}
