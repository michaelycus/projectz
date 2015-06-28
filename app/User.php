<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Auth;
use URL;
use DB;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token','access_token'];

    public function comments()
    {
        return $this->morphOne('App\Comment', 'commentable');
    }

    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

    public function getAvatar()
    {
        if ($this->facebook_user_id == 0){
            return URL::asset('images/avatar.png');
        }else{
            return 'http://graph.facebook.com/'. $this->facebook_user_id . '/picture';
        }
    }

    public function hasPermission($permission)
    {
        foreach($this->permissions as $p){
            if (substr( $p->type, 0, 6 ) === substr( $permission, 0, 6 )){
                if ( intval(substr( $p->type, 6, 1 )) >= intval(substr( $permission, 6, 1 ))) {
                    return true;
                }
            }
            if ($p->type == PERMISSION_SYSTEM_MANAGER){
                return true;
            }
        }
        return false;
    }

    public function getPermissionByType($type)
    {
        foreach($this->permissions as $p){
            if (substr( $p->type, 0, 5 ) === $type){
                return $p->type;
            }
        }
        return false;
    }

    public function setPermissions($user, $request)
    {
        DB::table('permissions')->where('user_id', '=', $user->id)->delete();

        foreach($request->all() as $key => $r){
            if (substr( $key, 0, 2 ) === "p_"){
                DB::table('permissions')->insert(
                    ['user_id' => $user->id, 'type' => $r]
                );
            }
        }
    }

    public function isOwner($user_id)
    {
        return ($this->id == $user_id) || $this->isAdmin();
    }

    public function isVideoManager()
    {
        return $this->isAdmin() || $this->hasPermission(PERMISSION_VIDEO_MANAGE);
    }

    public function isArticleManager()
    {
        return $this->isAdmin() || $this->hasPermission(PERMISSION_ARTICLE_MANAGE);
    }

    public function isAdmin()
    {
        return $this->hasPermission(PERMISSION_SYSTEM_MANAGER);
    }
}
