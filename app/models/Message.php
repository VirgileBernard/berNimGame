<?php

class Message{
    public function __construct(
        public string $text,
        public string $type = "info"
    ){}
}