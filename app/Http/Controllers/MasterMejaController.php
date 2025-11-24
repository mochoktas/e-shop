<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Meja;
use yajra\Datatables\Datatables;

class MasterMejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = Meja::query();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View" class="me-1 btn btn-info btn-sm show-data"><i class="fa-regular fa-eye"></i> View</a>';
                            $btn = $btn. '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm update-data"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';
      
                            // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa-solid fa-trash"></i> Delete</a>';
                            $deleteRoute = route('meja.delete', $row->id);
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
                    ->editColumn('status', function ($row) {
                        return $row->status == 1 ? 'Aktif' : 'Tidak Aktif';
                    })


                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('master.meja.index');
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
        $request->validate([
            'name' => 'required|unique:meja|max:10'
        ]);
        $meja = Meja::create([
            'name' => $request->name,
            'status' => 0,
        ]);

        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Meja::find($id);
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
        $data = Meja::find($id);
        if ($data) {
            // Kembalikan data sebagai respons JSON
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
        
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
        $meja = Meja::find($request->dataid);
        if ($meja->name != $request->field12) {
            $request->validate([
                'field12' => 'required|unique:meja,name,'.$request->dataid.'|max:10'
            ]);
        }
        $meja = Meja::where('id', $request->dataid)
                        ->update([
                            'name' => $request->field12,
                            'status' => $request->has('status') ? 1 : 0
                        ]);
        return redirect()->route('meja.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Meja::find($id)->delete();
        return redirect()->route('meja.index')->with('success', 'Data berhasil dihapus!');
    }
}
