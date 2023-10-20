<?php

class Film {
    private string $name;
    private int $id_user;
    private string $director;
    private string $synopsis;
    private string $type;
    private string $scriptwriter;
    private string $production_company;
    private string $release_year;
    private string $slug;

    public function __construct(int $id, string $name, int $id_user, string $director, string $synopsis, string $type, string $scriptwriter, string $production_company, int $release_year, string $slug) {
        $this->id = $id;
        $this->name = $name;
        $this->id_user = $id_user;
        $this->director = $director;
        $this->synopsis = $synopsis;
        $this->type = $type;
        $this->scriptwriter = $scriptwriter;
        $this->production_company = $production_company;
        $this->release_year = $release_year;
        $this->slug = $slug;
    }

    // Getters

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getIdUser(): int {
        return $this->id_user;
    }

    public function getDirector(): string {
        return $this->director;
    }

    public function getSynopsis(): string {
        return $this->synopsis;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getScriptwriter(): string {
        return $this->scriptwriter;
    }

    public function getProductionCompany(): string {
        return $this->production_company;
    }

    public function getReleaseYear(): int {
        return $this->release_year;
    }

    public function getSlug(): string {
        return $this->slug;
    }

    // Setters
    public function setId(int $id) {
        $this->id = $id;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setIdUser(int $id_user) {
        $this->id_user = $id_user;
    }

    public function setDirector(string $director) {
        $this->director = $director;
    }

    public function setSynopsis(string $synopsis) {
        $this->synopsis = $synopsis;
    }

    public function setType(string $type) {
        $this->type = $type;
    }

    public function setScriptwriter(string $scriptwriter) {
        $this->scriptwriter = $scriptwriter;
    }

    public function setProductionCompany(string $production_company) {
        $this->production_company = $production_company;
    }

    public function setReleaseYear(int $release_year) {
        $this->release_year = $release_year;
    }

    public function setSlug(string $slug) {
        $this->slug = $slug;
    }

    public static function slugify(string $aString){
        $aString = str_replace(' ', '-', $aString);
        $aString = preg_replace('/[^A-Za-z0-9-]/', '', $aString);
        $aString = strtolower($aString);
        $aString = preg_replace('/-+/', '-', $aString);
        $aString = trim($aString, '-');   
        return $aString;
    }
}
