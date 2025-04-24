<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
<<<<<<< HEAD:app/Models/Books.php
    
    protected $fillable = [
        'title',
        'isbn',
        'author',
        'status'
=======

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'status',
>>>>>>> 65f1cb32dbafc96bf2c761253b3ec1980c30dbc7:app/Models/Book.php
    ];
}
