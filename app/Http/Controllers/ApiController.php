<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 29/3/18
 * Time: 7:35 PM
 */

namespace App\Http\Controllers;


use App\Address;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{
    public function getScrape()
    {

        $aReqData = Input::all();
        //dd(filter_var($aReqData['url'], FILTER_VALIDATE_URL));
        if(isset($aReqData['url']) && !empty($aReqData['url']) && !(filter_var($aReqData['url'], FILTER_VALIDATE_URL)) === false)
        {
            $response = array();
            $url = file_get_contents($aReqData['url']);
            $domVar = new \DOMDocument();
            @$domVar->loadHTML($url);
            $domxpathVar = new \DOMXPath($domVar);
            $lengthVar = $domxpathVar->evaluate("/html/body//a");

            for ($i = 0; $i < $lengthVar->length; $i++) {
                $hrefVar = $lengthVar->item($i);
                $urldata = $hrefVar->getAttribute('href');
                $urldata = filter_var($urldata, FILTER_SANITIZE_URL);

                if(!filter_var($urldata, FILTER_VALIDATE_URL) === false)
                    $response[] = $urldata;
            }
            if(!empty($response))
            {
                return json_encode([
                    'status' => 200,
                    'message' => "Success",
                    'response' => $response
                ]);
            }
            else
            {
                return json_encode([
                    'status' => 200,
                    'message' => "No urls Available",
                    'response' => $response
                ]);
            }
        }
        else
        {
            return json_encode([
                'status' => 400,
                'message' => "Please Pass url",
                'response' => []
            ]);
        }
    }
    public function getAddAddress()
    {
        $aReqData = Input::all();

        $addressVal = new Address();
        $validation = $addressVal->validate($aReqData);
        if($validation['status'] == 'fail')
        {
            return json_encode($validation);
        }
        else
        {
            $addressVal->name = $aReqData['name'];
            $addressVal->mobile = $aReqData['mobile'];
            $addressVal->email = $aReqData['email'];
            $addressVal->save();
        }
        return json_encode([
            'status' => 200,
            'message' => "inserted Successfully"
        ]);
    }
}