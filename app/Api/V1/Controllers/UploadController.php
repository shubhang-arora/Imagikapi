<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Validator;
use Config;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Exception\ValidationHttpException;

class UploadController extends Controller
{
    use Helpers;

    public function upload(Request $request)
    {
        $validator = Validator::make($request->file(),[
            'file'   =>  'required|image'
        ]);

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }
        $types = array('jpeg', 'png' ,'jpg');
        $file = $request->file('file');
        // $size = $file->getClientSize();
        $fileFormat = $file->getClientOriginalExtension();

        if(in_array($fileFormat, $types)) {

            $time = Carbon::now()->format('m_d_y_h_i_s_a');
            $filename = $time . '.' . $fileFormat;
            $destinationPath = 'uploads';
            $link = $destinationPath . '/' . $filename;
            $status = move_uploaded_file($file,'/var/www/html/asque/public/'.$link);

            if($status)
            {
                $move = shell_exec("sudo mv ../../../public/".$link." /var/www/html/asque/public/".$link);

                return $this->response()->error($link,200);

            }
            return $this->response()->errorBadRequest("There was a problem in Uploading");
        } else {

            return $this->response()->error("Wrong file format",422);
        }
    }
}
