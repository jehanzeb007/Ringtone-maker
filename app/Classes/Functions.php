<?php

namespace App\Classes;

use Illuminate\Http\Request;
use Validator;
use DB;
//use App\Models\CompanyProfile;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Photo;

class Functions {

    /////////////////////common function/////////////////////////
    public static function validator($request, $rules) {
        return $validator = Validator::make($request, $rules);
    }

    public  static function slug($slug,$cat_name,$model,$id =false) {

        if (!empty($slug)) {
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
        } else {
            $slug= preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name);
        }
        if($id)
        {
            $exists =$model::where('slug', 'LIKE', '%'.$slug)->where('id', '!=', $id)->get();
//            $exists =Category::where('slug', 'LIKE', '%'.$slug.'%')->where('id', '!=', $id)->get();
        }
        else{
//            $exists =Category::where('slug', '=', $slug)->get();
            $exists =$model::where('slug', 'LIKE', '%'.$slug)->get();
        }
        if(sizeof($exists))
        {
            $exists = count($exists);
            $count = $exists+1;
            for($i=1;$i<=$count; $i++){
                $cat_slug = $slug."-".$i;
            }
            return $cat_slug;
        }
        else{
            return  $cat_slug = $slug;
        }


    }
    ///////////////////////end common function/////////////////
    public static function status($model,$status,$id)
    {
        if ($status == 'Active') {
            $model->status = $status;
            $model->save();
            echo ' <a href="javascript:void(0);" data-ng-switch="Inactive" id="' . $id . '" title="Active"    class="btn green active">
                                    <i class="fa fa-check"></i>
                                </a>';
        } else {
            $model->status = $status;
            $model->save();
            echo '<a href="javascript:void(0);" data-ng-switch="Active" id="' . $id . '" title="inactive"     class="btn btn-warning active">
                                    <i class="fa fa-times"></i>
                                </a>';
        };

    }
    public static function make_thumb($path)
    {
        $myArray = explode('/', $path);
        $img = Image::make('public/uploads/'.$path)->resize(320, 240)->save('public/uploads/'.$myArray[0].'/thumb/'.$myArray[1]);
        return $img;
    }
    public static function image_remove($id)
    {
        $data = Photo::find($id);
        $myArray = explode('/', $data->photo);
        $data->delete();
        unlink('public/uploads/' . $data->photo);
        unlink('public/uploads/'.$myArray[0].'/thumb/'.$myArray[1]);
        return $id;
    }


}
