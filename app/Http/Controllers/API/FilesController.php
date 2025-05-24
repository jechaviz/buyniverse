<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_file;
use App\ProposalFile;
use App\Proposal;
use App\User;
use Storage;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
    public function store1(Request $request)
    {
        
        $file = $request->file('files');
        $name = $file->getClientOriginalName();
        $size = $file->getSize();
        $size_unit = $this->formatSizeUnits($size);
        $origin = explode('.', $name);

        $proposal = Proposal::where('job_id', $request->job_id)->where('provider_id', $request->user_id)->first();

        //$file = $request->file('file');
        $job_file = new ProposalFile;
        $job_file->name = $name;
        $job_file->size = $size_unit;
        $job_file->description = filter_var($request->description, FILTER_SANITIZE_STRING);
        $job_file->proposal_id = $proposal->id;
        $job_file->file = $origin[0].'_'.$request->job_id.'_'.time().'.'.$file->getClientOriginalExtension(); 
        $job_file->save();
        
        $input['file'] = $job_file->file;

        $destinationPath = public_path('/job_files/'); 

        $file->move($destinationPath, $input['file']);

        return true;
    }

    public function store(Request $request)
    {
        
        $file = $request->file('files');
        $name = $file->getClientOriginalName();
        $size = $file->getSize();
        $size_unit = $this->formatSizeUnits($size);
        $origin = explode('.', $name);

        //$file = $request->file('file');
        $job_file = new Job_file;
        $job_file->name = $name;
        $job_file->size = $size_unit;
        $job_file->use = $request->use;
        $job_file->status = 'new';
        $job_file->user_id = $request->user_id;
        $job_file->job_id = $request->job_id;
        $job_file->file_id = $origin[0].'_'.$request->job_id.'_'.time().'.'.$file->getClientOriginalExtension(); 
        $job_file->save();
        
        $input['file'] = $job_file->file_id;

        $destinationPath = public_path('/job_files/'); 

        $file->move($destinationPath, $input['file']);
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pfiles($id)
    {
        $files = ProposalFile::where('proposal_id', $id)->get();
        /*foreach($files as $key => $file)
        {
            $user = User::find($file->user_id);
            
            $file->user_id = $user->first_name.' '.$user->last_name;
            
        }*/
        return response()->json($files);
    }

    public function download($id)
    {
        //dd('this is the test');
        
        $job_file = Job_file::find($id);
        $fullpath="/job_files/{$job_file->file_id}";
        //dd($fullpath);
        return response()->download(public_path($fullpath), null, [], null);
        //return response()->download(storage_path($fullpath));
        //return Storage::disk('public')->download($fullpath);
    }

    public function show($id)
    {
        $files = Job_file::where('job_id', $id)->get();
        foreach($files as $key => $file)
        {
            $user = User::find($file->user_id);
            
            $file->user_id = $user->first_name.' '.$user->last_name;
            
        }
        return response()->json($files);
    }

    public function pdownload($id)
    {
        //dd('this is the test');
        
        $job_file = ProposalFile::find($id);
        $fullpath="/job_files/{$job_file->file}";
        //dd($fullpath);
        //return response()->download(public_path($fullpath), $job_file->file, [], null);
        return response()->download(storage_path($fullpath), $job_file->file);
        //return Storage::disk('public')->download($fullpath);
    }

    public function dfiles($id)
    {
        $job_file = ProposalFile::find($id);
        $job_file->delete();
        return true;
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
        $job_file = Job_file::find($id);
        $job_file->delete();
        return true;
    }
}
