<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'families';
    
    // Define the fillable attributes for mass assignment
    // This means you can create a new Family instance using Family::create(['name' => 'Smith', 'member_count' => 4]);
    protected $fillable = ['name', 'member_count'];
}
