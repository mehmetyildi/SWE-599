<?php
/**
 * Created by PhpStorm.
 * User: mehme
 * Date: 12.04.2019
 * Time: 14:37
 */
namespace App\Models;
use App\User;
use App\Models\Interest;
use App\Models\Board;
use App\Models\Wanted;


use phpDocumentor\Reflection\Types\Array_;

class Group extends BaseModel{
    protected $table='groups';
    protected $fillable=['name','city_id','description','purpose','user_id','image_path'];
    protected $rules=array(
        'name'=>'required',
        'description'=>'required',
        'purpose'=>'required',

    );
    protected $updaterules=array(
        'name'=>'required',
        'description'=>'required',
        'purpose'=>'required',
    );
    public static function messages(){
        return[
            'name.required'=>'The name of group can not be empty',
            'description.required'=>'The description can not be empty',
            'purpose.required'=>'The purpose can not be empty',
        ];
    }
    public static $fields=array('name','description','purpose');
    public static $image_fields=array(
        ["name" => "image_path", "width" => 200, "height" => 200, 'crop' => true, 'naming' => 'name', 'diff' => 'image_path']

    );
    public static $imageFieldNames = array(
        "image_path"
    );
    public static $docFields = array(
    );
    public static $booleanFields = array(

    );
    public static $dateFields = array(
    );
    public static $urlFields = array(
    );


    public function interests(){
        return $this->BelongsToMany(Interest::class);
    }

    public function boards(){
        return $this->BelongsToMany(Board::class);
    }

    public function users(){
        return $this->BelongsToMany(User::class);
    }

    public function creator(){
        return $this->BelongsTo(User::class);
    }

    public function sticks(){
        return $this->BelongsToMany(Group::class);
    }

    public function wantedAds(){
        return $this->HasMany(Wanted::class);
    }
}
