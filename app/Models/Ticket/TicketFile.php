<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket\TicketFile;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;


class TicketFile extends Model
{
 use HasFactory, SoftDeletes;

    protected $guarded=['id'];


    public function user()
	{
        return $this->belongsTo(User::class);
    }   

	public function ticket()
	{
        return $this->belongsTo(Ticket::class);
    }
}
