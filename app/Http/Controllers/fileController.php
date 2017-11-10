<?php

namespace App\Http\Controllers;


use App\Contents;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class fileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User.upload');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileupload = new Contents();
        $fileupload->filename = $request->FileName;
        $fileupload->upload_date = Carbon::now();
        $fileupload->userid = session()->get('loggedUser')->userid;
        $fileupload->filetype=$request->FileType;
        $fileupload->category=$request->FileCategory;
        if($request->hasFile('UploadFile'))
        {
            $file = $request->file('UploadFile');
            $filename= session()->get('loggedUser')->userid.'-'.rand(1000,9999);
            $file->move('uploads', $filename);
            $fileupload->file=$filename;

        }
        if($request->hasFile('Thumbnail'))
        {
            $file = $request->file('Thumbnail');
            $filename= session()->get('loggedUser')->userid.'-'.rand(1000,9999);
            $file->move('uploads', $filename);
            $fileupload->filepicture=$filename;

        }

        $fileupload->save();

    return redirect()->route('home.index')->with('videoupload','File Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
