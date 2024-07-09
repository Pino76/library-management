<?php

namespace App\Interfaces\Repository;

use Illuminate\Database\Eloquent\Collection;
interface IGenreRepository
{
    public function getAll(): Collection;
}
