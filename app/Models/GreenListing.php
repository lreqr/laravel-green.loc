<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenListing extends Model
{
    use HasFactory;

//    protected $fillable = ['company', 'title', 'tags', 'location', 'website', 'email', 'description','votes',
//        'logo' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg',
//    ];

    public function scopeFilter($query, array $filters)
    {

        if ($filters['votes'] ?? false){
            $query->where('votes', '=', $filters['votes'] ?? null);
        }

        if ($filters['tag'] ?? false){
            $query->where('tags', 'LIKE', '%' . $filters['tag'] . '%' ?? null);
        }

        if ($filters['search'] ?? false){
            $query->where('title', 'LIKE', '%' . $filters['search'] . '%' ?? null)
            ->orWhere('description', 'LIKE', '%' . $filters['search'] . '%' ?? null)
            ->orWhere('tags', 'LIKE', '%' . $filters['search'] . '%' ?? null)
            ->orWhere('location', 'LIKE', '%' . $filters['search'] . '%' ?? null)
            ->orWhere('company', 'LIKE', '%' . $filters['search'] . '%' ?? null);
        }

    }

    //Relationship to User
    public function user()
    {
        //belongs to - пренадлежит(перевод)
        //belongsTo(User::class, ...) - 1 аргумент указывает, что каждая запись GreenListing принадлежит одному пользователю User
        //belongsTo(..., 'user_id') - 2 аргумент что связь основана на столбце user_id в таблице green_listings
        return $this->belongsTo(User::class, 'user_id');
    }
}
