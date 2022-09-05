<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treeentry extends Model
{
    use HasFactory;
    protected $table = 'tree_entry as t1';
    public $timestamps = false;

}
