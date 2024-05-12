<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Models\Notify\Email;
use Illuminate\Http\Request;
use App\Models\Notify\EmailFile;
use App\Http\Controllers\Controller;
use App\Http\Services\File\FileService;
use App\Http\Requests\Admin\Notify\EmailFileRequest;

class EmailFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Email $email)
    {
       return view('admin.notify.email-file.index', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Email $email)
    {
       return view('admin.notify.email-file.create', compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailFileRequest $request, Email $email, FileService $fileService)
    {
		//dd($request->all());
         $inputs = $request->all();
        if($request->hasFile('file'))
        {
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
			
			if($inputs['type'] == 0){
			 
			 $result = $fileService->moveToPublic($request->file('file'));
			
			}elseif($inputs['type'] == 1){
            
			$result = $fileService->moveToStorage($request->file('file'));
		    
			}
			
            $fileFormat = $fileService->getFileFormat();
        }
		
        if($result === false)
        {
            return redirect()->route('admin.notify.email-file.index', $email->id)->with('swal-error', 'آپلود فایل با خطا مواجه شد');
        }
         $inputs['public_mail_id'] = $email->id;
         $inputs['file_path'] = $result;
         $inputs['file_size'] = $fileSize;
         $inputs['file_type'] = $fileFormat;
         $file = EmailFile::create($inputs);
         return redirect()->route('admin.notify.email-file.index', $email->id)->with('swal-success', 'فایل جدید شما با موفقیت ثبت شد');
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
    public function edit(EmailFile $emailfile)
    {
        return view('admin.notify.email-file.edit',compact('emailfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailFileRequest $request, EmailFile $emailfile, FileService $fileService)
    {
        $inputs = $request->all();
        if($request->hasFile('file'))
        {
            if(!empty($emailfile->file_path))
            {
				
			if($emailfile['type'] == 0){
			 
                $fileService->deleteFile($emailfile->file_path);
			
			}else{
           
                $fileService->deleteFile($emailfile->file_path, true);
		    
			}
						
        }
            $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'email-files');
            $fileService->setFileSize($request->file('file'));
            $fileSize = $fileService->getFileSize();
            
			if($inputs['type'] == 0){
			 
			 $result = $fileService->moveToPublic($request->file('file'));
			
			}elseif($inputs['type'] == 1){
            
			$result = $fileService->moveToStorage($request->file('file'));
		    
			}
			
            $fileFormat = $fileService->getFileFormat();
        
		     if($result === false){
				 
            return redirect()->route('admin.notify.email-file.index', $emailfile->email->id)->with('swal-error', 'آپلود فایل با خطا مواجه شد');
            }
		
         $inputs['file_path'] = $result;
         $inputs['file_size'] = $fileSize;
         $inputs['file_type'] = $fileFormat;
		 
		}
		
		
         $emailfile->update($inputs);
         return redirect()->route('admin.notify.email-file.index', $emailfile->email->id)->with('swal-success', 'فایل  شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailFile $emailfile)
	{
         $emailfile->delete();
         return redirect()->route('admin.notify.email-file.index', $emailfile->email->id)->with('swal-success', 'فایل شما با موفقیت  حذف شد');
    }


    public function status(EmailFile $emailfile)
    {
      $emailfile->status=$emailfile->status==0 ? 1 : 0 ;
      $result=$emailfile->save();
      if ($result) {
		  
        if ($emailfile->status==0) {
          return response()->json(['status'=>true,'checked'=>false]);
        }else {
          return response()->json(['status'=>true,'checked'=>true]);
        }
      }
	  else{
        return response()->json(['status'=>false]);
     }
	}

}
