<?php

namespace App\Services;

use App\Interfaces\Repository\IGenreRepository;
use App\Interfaces\Service\IGenreService;
use Illuminate\Database\Eloquent\Collection;
class GenreService implements IGenreService
{
    private IGenreRepository $genreRepository;

    public function __construct(IGenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function getAllGenre(): Collection
    {
        return $this->genreRepository->getAll();
    }
}
