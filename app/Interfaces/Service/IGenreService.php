<?php

namespace App\Interfaces\Service;

use Illuminate\Database\Eloquent\Collection;
interface IGenreService
{
    public function getAllGenre(): Collection;
}
