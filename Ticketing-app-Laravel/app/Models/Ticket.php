<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";
    protected $fillable = [
        "title",
        "client",
        "description",
        "project",
        "statut",
        "facturable",
        "project_id",
        "user_id",
    ];

}
