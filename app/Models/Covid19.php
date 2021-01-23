<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Covid19 extends Model
{
    use HasFactory;

    const BASE = "https://covid-193.p.rapidapi.com/";

    public function countries()
    {

    }
}
