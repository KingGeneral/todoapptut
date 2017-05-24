<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	//add table
    protected $table = 'todo';

    //add fillable for todo_table
    protected $fillable = ['todo','category','user_id','description'];
}
