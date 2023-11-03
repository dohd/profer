<?php

namespace App\Http\Controllers\file_import;

use App\Http\Controllers\Controller;
use App\Imports\MeetingStatsImport;
use App\Models\file_import\FileImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Excel;

class FileImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('file_imports.index');
    }

    /**
     * Display list of proposals using datatable
     */
    public function datatable(Request $request)
    {
        $q = FileImport::query();
        
        return view('file_imports.partial.file_imports_datatable', ['file_imports' => $q->latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file_imports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'date' => 'required',
            'category_dir' => 'required',
            'file' => 'required|mimes:csv,pdf,xls,xlsx,doc,docx',
        ]);
        $file = $request->file('file');
        $input = inputClean($request->except('_token')); 
        $input['file_name'] = $this->uploadFile($file, $input['category_dir']);
        $input['origin_name'] = implode('_', array_slice(explode('_', $input['file_name']), 1));

        // Process the Excel file
        // Excel::import(new MeetingStatsImport, $file);
        
        try {
            $file_import = FileImport::create($input); 

            return redirect(route('file_imports.index'))->with(['success' => 'File uploaded successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error uploading file!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FileImport $file_import)
    {
        $file_path = 'files' . DIRECTORY_SEPARATOR . $file_import->category_dir . DIRECTORY_SEPARATOR;
        return Storage::disk('public')->download($file_path . $file_import->file_name, $file_import->origin_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileImport $file_import)
    { 
        $file_path = 'files' . DIRECTORY_SEPARATOR . $file_import->category_dir . DIRECTORY_SEPARATOR;
        if (Storage::disk('public')->exists($file_path . $file_import->file_name)) {
            Storage::disk('public')->delete($file_path . $file_import->file_name);
        }
        
        try {
            $file_import->delete();
            return redirect(route('file_imports.index'))->with(['success' => 'File deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting file!', $th);
        }
    }

    /**
     * Upload file to storage
     */
    public function uploadFile($file, $category)
    {
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file_path = 'files' . DIRECTORY_SEPARATOR . $category . DIRECTORY_SEPARATOR;
        Storage::disk('public')->put($file_path . $file_name, file_get_contents($file->getRealPath()));
        
        return $file_name;
    }
}
