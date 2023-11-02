<?php

namespace App\Http\Controllers\document_import;

use App\Http\Controllers\Controller;
use App\Models\document_import\DocumentImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('document_imports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document_imports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        dd($request->all());
        
        try {

            return response()->json(['success' => true, 'message' => 'Document created successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentImport $document_import)
    {
        // return view('case_studies.view', compact('case_study'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentImport $document_import)
    { 
        try {
            $document_import->delete();
            return redirect(route('document_imports.index'))->with(['success' => 'Document deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting document!', $th);
        }
    }
}
