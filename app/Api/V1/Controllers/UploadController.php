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
use Carbon\Carbon;

class UploadController extends Controller
{
    use Helpers;

    public function uploads(Request $request)
    {

        /*$validator = Validator::make($request->file(),[
            'base'   =>  'required'
        ]);

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }*/
        $output_file = $request->input('output_file');
      //  $types = array('jpeg', 'png' ,'jpg');
      //  $file = base64_decode($request->input('base'));
        $ifp = fopen( $output_file, "wb" );
        fwrite( $ifp, base64_decode( $request->input('base')) );
        fclose( $ifp );
        $destinationPath = 'uploads';
        $link = $destinationPath . '/' . $output_file;
       // return( $output_file );
        //dd($file);

        // $size = $file->getClientSize();
      //  $fileFormat = $file->getClientOriginalExtension();

      /*  if(in_array($fileFormat, $types)) {

            $time = Carbon::now()->format('m_d_y_h_i_s_a');
            $filename = $time . '.' . $fileFormat;
            $destinationPath = 'uploads';
            $link = $destinationPath . '/' . $filename;
            $status = move_uploaded_file($file,$link);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.clarifai.com/v1/token/",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>  array(
                     "client_id" => '3TdR8-hfkTjOF5oXCx9eA2oPK1ZHNZcY7OjcQdVA',
                     "client_secret" => 'FIsp8oqtp9S-JvfLMt5lkfvciJFiRkxNUIQEpztt',
                    "grant_type"    =>  'client_credentials'
                 )
            ));

            $json_response = json_decode(curl_exec($curl), true);
            $access_token = $json_response["access_token"];
            curl_close($curl);

            $image = curl_init();

            curl_setopt_array($image, array(
                CURLOPT_URL => "https://api.clarifai.com/v1/tag/?model=general-v1.3&url=http://weknowyourdreams.com/images/sad/sad-05.jpg",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array('Authorization: Bearer '.$access_token)
            ));

            $response = json_decode(curl_exec($image), true);

            $result = ($response["results"][0]["result"]["tag"]["classes"]);
            return json_encode($result);
        }*/
    }
}
