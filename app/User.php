<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Stick;
use App\Models\Group;
use App\Models\Comment;
use App\Models\Wanted;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'last_name', 'email', 'password', 'username', 'image_url', 'main_image',
        'about'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules = array(
        'username' => 'unique',

    );
    public static $updaterules = array(
        'username' => 'unique'
    );

    public static function messages()
    {
        return[
            'username.unique'=>'Bu kullanıcı adı daha önceden kullanılmış.',
        ];
    }

    public static $fields = array('name', 'last_name', 'email', 'username',
        'about'
    );
    public static $imageFields = array(
        ["name" => "image_url", "width" => 150, "height" => 150, 'crop' => false, 'naming' => 'username', 'diff' => 'photo'],
        ["name" => "main_image", "width" => 1500, "height" => 542, 'crop' => true, 'naming' => 'username', 'diff' => 'main'],


    );
    public static $imageFieldNames = array(
        'image_path', 'main_image'
       );
    public static $docFields = array(
    );
    public static $booleanFields = array(
    );
    public static $dateFields = array(
    );
    public static $urlFields = array(
    );

    public function sticks(){
        return $this->BelongsToMany(Stick::class);
    }

    public function publishedSticks(){
        return $this->HasMany(Stick::class);
    }

    public function ownedGroups(){
        return $this->HasMany(Group::class);
    }

    public function groups(){
        return $this->BelongsToMany(Group::class);
    }

    public function comments(){
        return $this->HasMany(Comment::class);
    }

    public function wantedAds(){
        return $this->HasMany(Wanted::class);
    }
}
