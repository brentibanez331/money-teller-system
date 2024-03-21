<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProfile extends Model
{
    use HasFactory;

    protected $table = 'tbl_branch_profile';
    protected $fillable = [
        'branch_name',
        'branch_code',
        'country_iso_code',
    ];
}
