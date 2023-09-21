<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use View;
use HTML;
use Validator;
use Input;
use Redirect;
use URL;
use Session;
use File;

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Format\Audio;

class DashboardController extends Controller {
	public function __construct() {
		parent::__construct();
		//echo shell_exec('/usr/bin/ffmpeg -i /home/ringtonecreator/public_html/public/file/default.mp3 -filter_complex "showwavespic=s=890x99" -frames:v 1 /home/ringtonecreator/public_html/public/file/uploads/images/file.png');
		//exit;
	}
    public function index() {
		$dataAll = $this->convertObjectToArray(json_decode(file_get_contents(url('seo_config.txt'))));
		
		$sessionValue = Session::has('lang') ? Session::get('lang') : '';
		if(trim($sessionValue) == '' || trim($sessionValue) == 'en'){
			$data = ['title'=>$dataAll['title']['us'],'keyword'=>$dataAll['keyword']['us'],'description'=>$dataAll['description']['us']];
		}else{
			$data = ['title'=>$dataAll['title'][$sessionValue],'keyword'=>$dataAll['keyword'][$sessionValue],'description'=>$dataAll['description'][$sessionValue]];	
		}
		return view('dashboard.home')->with(['data'=>$data]);
    }
	public function sample(){
		$sample = '{
			   "audio":{
				  "mp3_duration":"15.570000",
				  "mp3_url":"'.url('').'\/file\/default.mp3",
				  "png_url":"'.url('').'\/file\/default.png"
			   },
			   "html":"<div id=\"player\" class=\"jp-jplayer\"><\/div><div id=\"player-container\"><div id=\"player-gui\"><div id=\"player-range\"><img src=\"'.url('').'\/file\/default.png\"><\/div><div id=\"player-progress\"><\/div><ul id=\"player-controls\"><li class=\"btn\"><div class=\"item\"><button id=\"player-play\"><\/button><\/div><div class=\"text\">Play<\/div><\/li><li class=\"btn\"><div class=\"item\"><button id=\"player-stop\"><\/button><\/div><div class=\"text\">Stop<\/div><\/li><li class=\"btn\"><div class=\"item\"><input type=\"checkbox\" id=\"player-repeat\"><label for=\"player-repeat\"><\/label><\/div><div class=\"text\">Repeat<\/div><\/li><li class=\"inp\"><div class=\"item\"><input id=\"player-spinner-min\" name=\"player-spinner-min\" readonly><\/div><div class=\"text\">Start Time<\/div><\/li><li class=\"inp\"><div class=\"item\"><input id=\"player-spinner-max\" name=\"player-spinner-max\" readonly><\/div><div class=\"text\">End Time<\/div><\/li><li class=\"sld\"><div class=\"item\"><div id=\"player-volume\"><\/div><\/div><div class=\"text\">Volume<\/div><\/li><\/ul><div class=\"clear\"><\/div><\/div><div class=\"jp-no-solution\"><span>Update Required<\/span>To play the media you will need to update your browser to a recent version.<\/div><div id=\"player-action\"><div id=\"player-format\"><input type=\"radio\" id=\"mp3\" name=\"format\" value=\"mp3\" checked><label for=\"mp3\">MP3<\/label><input type=\"radio\" id=\"m4r\" name=\"format\" value=\"m4r\"><label for=\"m4r\">M4R<\/label><\/div><button id=\"player-cut\">Make Ringtone<\/button><\/div><\/div>",
			   "status":"success"
			}';
		return $sample;
	}
	
	public function upload(Request $request){
		$post = Input::all();
		//echo '<pre>';print_r($post);exit;
		$options = array(
			'id'=>'required',
			'name'=>'required',
        );
	    $validation = Validator::make( $post, $options );
        if($validation->fails()){
			$error = [];
			$error['error'] = ['code'=>108,'message'=>'Wrong format.','id'=>$post['id'],'jsonrpc'=>'2.0'];
			return $error;
        }
		
		$fileExtention = Input::file('file')->getClientOriginalExtension();
		$allowExtentions = ['mp3','aac','flac','m4a','ogg','wav','wma'];
		if(in_array(trim(strtolower($fileExtention)),$allowExtentions)){
			
			$time = time();
			$destinationPath = public_path('/file/uploads/'.$time.'/'); // upload path
			$destinationPath_image = public_path('file/uploads/images/'.$time.'/'); // upload path
			$destinationPath_image_thumb = public_path('file/uploads/images/'.$time.'/thumb/');
			
			if(!is_dir($destinationPath)){
				@mkdir($destinationPath);
				@chmod($destinationPath,0777);
			}
			if(!is_dir($destinationPath_image)){
				@mkdir($destinationPath_image);
				@chmod($destinationPath_image,0777);
			}
			if(!is_dir($destinationPath_image_thumb)){
				@mkdir($destinationPath_image_thumb);
				@chmod($destinationPath_image_thumb,0777);
			}
			
			$post_name = $this->cleanString($post['name']);
			
			$fileName = $post_name.'.'.$fileExtention;
			$imageFileNAme = $post_name.'.png';
			
			Input::file('file')->move($destinationPath, $fileName);
			/********Generate Wav Image Start************/
			$ffmpeg = FFMpeg::create();
			$audio = $ffmpeg->open($destinationPath.$fileName);
			$waveform = $audio->waveform(890, '99:colors=#0063A9');
			@chmod($destinationPath_image.$imageFileNAme,0777);
			
			$waveform->save($destinationPath_image.$imageFileNAme);
			
			
			/*$query = 'ffmpeg -i '.$destinationPath.$fileName.' -i image -filter_complex \ "[1:v]scale=600:-1,crop=iw:120[bg]; \ [0:a]showwavespic=s=600x120:colors=cyan|aqua[fg]; \ [bg][fg]overlay" \ -q:v 3 '.$destinationPath_image.$imageFileNAme;
			shell_exec($query);
			*/
			
			//Generate Thumb
			$ffmpeg = FFMpeg::create();
			$audio = $ffmpeg->open($destinationPath.$fileName);
			$waveform = $audio->waveform(180, '50:colors=#0063A9');
			$waveform->save($destinationPath_image_thumb.$imageFileNAme);
			
			/********Generate Wav Image End************/
			
			/********Get duration Start************/
			$ffprobe = FFProbe::create();
			$duration = $ffprobe->format($destinationPath.$fileName)->get('duration');
			/********Get duration End************/
			
			$file_path = $destinationPath.$fileName;
			
			$fileName = url('file/uploads').'/'.$time.'/'.$fileName;
			
			$imageFileThumbName = url('file/uploads/images').'/'.$time.'/thumb/'.$imageFileNAme;
			$imageFileNAme = url('file/uploads/images').'/'.$time.'/'.$imageFileNAme;
			
			return $this->responseSuccess($duration,$fileName,$file_path,$imageFileNAme,$imageFileThumbName,$post['id']);
		}else{
			$error = [];
			$error['error'] = ['code'=>108,'message'=>'Wrong format.','id'=>$post['id'],'jsonrpc'=>'2.0'];
			return $error;
		}
	}
	public function cleanString($text){
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
	
	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	
	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);
	
	  // trim
	  $text = trim($text, '-');
	
	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);
	
	  // lowercase
	  $text = strtolower($text);
	
	  if (empty($text)) {
		return 'n-a';
	  }
	
	  return $text;
	}
	
	function responseSuccess($duration,$mp3_url,$file_path,$png_url,$imageFileThumbName,$id){
		$data = ['duration'=>$duration,'mp3_url'=>$mp3_url,'png_url'=>$png_url,'file_path'=>$file_path,'imageFileThumbName'=>$imageFileThumbName];
		Session::set($id,$data);
		$array = [];
		$array['audio'] = ['mp3_duration'=>$duration,'mp3_url'=>$mp3_url,'png_url'=>$png_url,'thumb_url'=>$imageFileThumbName];
		$array['html']	= '<div id="player" class="jp-jplayer"></div><div id="player-container"><div id="player-gui"
><div id="player-range"><img src="'.$png_url.'"></div><div id="player-progress"
></div><ul id="player-controls"><li class="btn"><div class="item"><button id="player-play"></button>
</div><div class="text">Play</div></li><li class="btn"><div class="item"><button id="player-stop"></button
></div><div class="text">Stop</div></li><li class="btn"><div class="item"><input type="checkbox" id="player-repeat"
><label for="player-repeat"></label></div><div class="text">Repeat</div></li><li class="inp"><div class
="item"><input id="player-spinner-min" name="player-spinner-min" readonly></div><div class="text">Start
 Time</div></li><li class="inp"><div class="item"><input id="player-spinner-max" name="player-spinner-max"
 readonly></div><div class="text">End Time</div></li><li class="sld"><div class="item"><div id="player-volume"
></div></div><div class="text">Volume</div></li></ul><div class="clear"></div></div><div class="jp-no-solution"
><span>Update Required</span>To play the media you will need to update your browser to a recent version
.</div><div id="player-action"><div id="player-format"><input type="radio" id="mp3" name="format" value
="mp3" checked><label for="mp3">MP3</label><input type="radio" id="m4r" name="format" value="m4r"><label
 for="m4r">M4R</label></div><button id="player-cut">Make Ringtone</button></div></div>';
 		$array['status'] = 'success';
		return $array;
	}
	function drawUpload($id){
		$data = Session::get($id);
		return $this->responseSuccess($data['duration'],$data['mp3_url'],$data['file_path'],$data['png_url'],$data['imageFileThumbName'],$id);
		
	}
	function cut($id){
		
		$return = [];
		$path = public_path('file/uploads/converted/');
		
		$post = Input::all();
		$data = Session::get($id);
		
		/****************Conver file in the chunk********************/
		$ffmpeg = FFMpeg::create();
		$audio = $ffmpeg->open($data['file_path']);
		
		$startTime = $post['start'];
		$endTime = $post['end'];
		
		$endTime = $endTime - $startTime;
		
		//$audio->filters()->clip(\FFMpeg\Coordinate\TimeCode::fromSeconds($startTime), \FFMpeg\Coordinate\TimeCode::fromSeconds($endTime));
		
		Session::set('last_convert_type',trim($post['format']));
		if(trim($post['format']) == 'mp3'){
			
			/*if(file_exists($path.$id.'.mp3')){
				unlink($path.$id.'.mp3');
			}
			
			$format = new \FFMpeg\Format\Audio\Mp3();
			$format->on('progress', function ($audio, $format, $percentage) {
				//echo "$percentage% transcoded";
			});
			
			$format->setAudioChannels(2)->setAudioKiloBitrate(128);
			$audio->save($format, $path.$id.'.mp3');*/
			
			//shell_exec("ffmpeg -ss ".$startTime." -i ".$data['file_path']." -t ".$endTime." ".$path.$id.'.mp3');
			shell_exec("ffmpeg -ss ".$startTime." -i ".$data['file_path']." -t ".$endTime." ".$path.$id.'.wav');
			rename($path.$id.'.wav', $path.$id.'.mp3');
			
			$return['audio'] = ['fid'=>$id,'result'=>$path.$id.'.mp3'];
			$return['status'] = 'success';
			return $return;
		}else{
			
			if(file_exists($path.$id.'.m4r')){
				unlink($path.$id.'.m4r');
			}
			shell_exec("ffmpeg -ss ".$startTime." -i ".$data['file_path']." -t ".$endTime." ".$path.$id.'.wav');
			/*$format = new \FFMpeg\Format\Audio\Wav();
			$format->on('progress', function ($audio, $format, $percentage) {
				//echo "$percentage% transcoded";
			});
			$format->setAudioChannels(2)->setAudioKiloBitrate(128);
			$audio->save($format, $path.$id.'.wav');*/
			rename($path.$id.'.wav', $path.$id.'.m4r'); 
			$return['audio'] = ['fid'=>$id,'result'=>$path.$id.'.m4r'];
			$return['status'] = 'success';
			return $return;
		
		}
	}
	function cutResult($id){
		if($id != ''){
			$path = public_path('file/uploads/converted/');
			
			$lastConvertFileType = Session::get('last_convert_type');
			$fullFilePath = $path.$id.'.'.$lastConvertFileType;
			$fullFileUrl = url('file/uploads/converted/'.$id.'.'.$lastConvertFileType);
			return view('dashboard.cut_result')->with(['fullFilePath'=>$fullFilePath,'fullFileUrl'=>$fullFileUrl,'lastConvertFileType'=>$lastConvertFileType]);
		}else{
			exit('Some thing went wrong with server, please try again.');
		}
	}
	function setLang($lang){
		Session::set('lang',trim($lang));
		return Redirect::back();
	}
	public function admin() {
		$data = $this->convertObjectToArray(json_decode(file_get_contents(url('seo_config.txt'))));
		return view('dashboard.admin')->with(['data'=>$data]);
    }
	public function login() {
		$post = Input::all();
		if(isset($post['lg_username']) && !empty(trim($post['lg_username'])) && isset($post['lg_password']) && !empty(trim($post['lg_password']))){
			if($post['lg_username'] == 'Admin' && $post['lg_password'] == 'computer123'){
				Session::set('validUser','true');
				return Redirect::back();
			}
		}
		return Redirect::back()->withInput()->withErrors( ['Invalid User name or Password.'] );
    }
	function convertObjectToArray($obj) {
		if (!is_object($obj) && !is_array($obj)) {
			return $obj;
		}
	
		// Parse array
		foreach ($obj as $key => $value) {
			$arr[$key] = $this->convertObjectToArray($value);
		}
	
		// Return parsed array
		return $arr;
	}
	public function update_seo(){
		$post = Input::all();
		$post = json_encode($post);
		
		$myfile = fopen(public_path("seo_config.txt"), "w") or die("Unable to open file!");
		$txt = $post;
		fwrite($myfile, $txt);
		fclose($myfile);
		return Redirect::back();
	}
	function cleanConvertFiles(){
		$directory = public_path('file/uploads/');
		File::deleteDirectory($directory, true);
		File::makeDirectory($directory.'converted', 0777, true);
		File::makeDirectory($directory.'images', 0777, true);
	}
}