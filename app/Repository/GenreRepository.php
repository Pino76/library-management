<?php

namespace App\Repository;

use App\Interfaces\Repository\IGenreRepository;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;


class GenreRepository implements IGenreRepository
{
    public function getAll(): Collection
    {
        return Genre::all();
    }
}
