<?php

namespace App\DTO;

/**
 *
 */
class BookDTO
{
    /**
     * @var int
     */
    private ?int $id ;
    /**
     * @var string|null
     */
    private ?string $title;
    /**
     * @var string|null
     */
    private ?string $isbn ;
    /**
     * @var string|null
     */
    private ?string $author;
    /**
     * @var int|null
     */
    private ?int $genre_id ;
    /**
     * @var int|null
     */
    private ?int $quantity ;
    /**
     * @var int|null
     */
    private ?int $reserve ;
    /**
     * @var int|null
     */
    private ?int $year;


    /**
     * @param int|null $id
     * @param string|null $title
     * @param string|null $isbn
     * @param string|null $author
     * @param int|null $genre_id
     * @param int|null $quantity
     * @param int|null $reserve
     * @param int|null $year
     */
    public function __construct(?int $id , ?string $title, ?string $isbn, ?string $author, ?int $genre_id, ?int $quantity, ?int $reserve, ?int $year)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setIsbn($isbn);
        $this->setAuthor($author);
        $this->setGenreId($genre_id);
        $this->setQuantity($quantity);
        $this->setReserve($reserve);
        $this->setYear($year);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return void
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    /**
     * @param string|null $isbn
     * @return void
     */
    public function setIsbn(?string $isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     * @return void
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return int|null
     */
    public function getGenreId(): ?int
    {
        return $this->genre_id;
    }

    /**
     * @param int|null $genre_id
     * @return void
     */
    public function setGenreId(?int $genre_id): void
    {
        $this->genre_id = $genre_id;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     * @return void
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int|null
     */
    public function getReserve(): ?int
    {
        return $this->reserve;
    }

    /**
     * @param int|null $reserve
     * @return void
     */
    public function setReserve(?int $reserve): void
    {
        $this->reserve = $reserve;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int|null $year
     * @return void
     */
    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        foreach (get_object_vars($this) as $k => $v)
            is_object($v) ? $res[$k] = $v->toArray() : $res[$k] = $v;
        return $res ?? [];
    }
}
