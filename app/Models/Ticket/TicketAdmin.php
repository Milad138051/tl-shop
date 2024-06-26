<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TicketAdmin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
