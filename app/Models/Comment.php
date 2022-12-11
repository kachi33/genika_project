<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;



class Comment extends Model
{
    
    protected $fillable = [
        'comment',
        'course_id',
        'user_id'
    ];
    public static function boot()
    {

        parent::boot();
    }
  
    // public function isAdmin()
    // {
    //     return $this->teachers()->where(['id' => auth()->user()->id, 'role' => 'admin'])->exists();
    // }
    // public function isModerator()
    // {
    //     return $this->teachers()->where(['id' => auth()->user()->id, 'role' => 'moderator'])->exists();
    // }
    // public function teachers()
    // {
    //     return $this->belongsToMany(User::class, 'course_teachers', 'course_id', 'user_id')->withPivot(['role']);
    // }
    
   public function course()
   {
       return $this->belongsTo(Course::class);
   }
   public function user()
   {
       return $this->belongsTo(User::class);
   }
   public function replies(){
    return $this->hasMany(CommentReply::class);
}
}
