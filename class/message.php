<?php

class User {
    private $id;
    private $date;
    private $text;
    private $user_id;
    
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function getDate(): string {
        return $this->date;
    }
    public function setDate(string $date): void {
        $this->date = $date;
    }
    
    public function getText(): string {
        return $this->text;
    }
    public function setText(string $text): void {
        $this->text = $text;
    }
    
    public function getUserId(): int {
        return $this->user_id;
    }
    public function setUserId(int $id): void {
        $this->user_id = $user_id;
    }
}