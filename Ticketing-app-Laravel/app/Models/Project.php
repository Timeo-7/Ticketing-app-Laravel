<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = "projects";
    protected $fillable = [
        "title",
        "client_id",
        "client",
        "description",
        "ticketNumber",
        "workingTickets",
        "completeTickets",
        "contract",
        "user_id",
    ];
}
