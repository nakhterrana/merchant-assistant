<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponder;
use Config, Validator, Input, Constants, Helper;


class ChatAIController extends Controller
{
    /**
     * Receives user input and send the request to AI api and response back
     *
     * @return void
     */

    use ApiResponder;

    public function newPrompt(Request $request){
        
        $input = $request->input();
     
        $inputQueryRequest = Constants::QUERY_INPUT_REQUEST;

        $validator = Validator::make($input, [
            $inputQueryRequest =>'required',
        ]);

        if ($validator->fails ()) {
            return response ($validator->getMessageBag()->all(),
                Config::get ( 'error.code.BAD_REQUEST' ),[]);
        }


        if(isset($input[$inputQueryRequest])){    
            $data = Helper::google_ai_api_request($input[$inputQueryRequest]);
            
            return $this->success($data);
        }

        return response('error',Config::get('error.code.BAD_REQUEST'));
    }

}
