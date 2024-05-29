<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'name',
        'purchase_date',
        'supported_date',
        'amount',
        'description',
        'created_by',
    ];

    public function employees()
    {
        return $this->belongsToMany('App\Models\Employee', 'employees', '', 'user_id');
    }

    public function users($users)
    {
        $userArr = explode(',', $users);
        $users  = [];
        foreach($userArr as $user)
        {
            $emp=Employee::where('user_id',$user)->first();

            if(!empty($emp)){
                $users[] = User::where('id',$emp->user_id)->first();
            }

        }
        return $users;
    }

}
