<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "ticket";
    protected $fillable = [
        "title",
        "client",
        "description",
        "project",
        "statut",
        "facturable",
        "project_id",
        "user_id",
        "time_estimated", 
        "time_spent", 
        "hourly_rate",
    ];

    public function getTimeRemainingAttribute()
    {
        return max(0, $this->time_estimated - $this->time_spent);
    }

    public function getBillableAmountAttribute()
    {
        return $this->time_spent * $this->hourly_rate;
    }

}
