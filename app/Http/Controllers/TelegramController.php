<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class TelegramController extends Controller {

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	
	public function GetCurl($url)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
			CURLOPT_SSL_VERIFYPEER => false
		));
		$response = curl_exec($curl);
		curl_close($curl);
		
		return $response;
	}
	
	public function PostCurl($url)
	{
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json') );
        curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	
	public function Kirim(Request $request)
	{
		return self::PostCurl(env('TELEGRAM_API_URL').$request->botToken.'/sendMessage?chat_id='.$request->idTujuan.'&text='.urlencode('isi#'.$request->pulsa.'#'.$request->noHp));
	}
	
	public function CheckMsg(Request $request)
	{
		return self::GetCurl(env('TELEGRAM_API_URL').$request->botToken.'/getUpdates?offset=0');
	}
}
