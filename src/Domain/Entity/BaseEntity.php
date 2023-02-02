<?php

namespace Arch\Domain\Entity;

abstract class BaseEntity
{
    protected $id;

    public abstract function toArray(): array;
    public abstract function __toString();


    public function getId(): int
    {
        return $this->id;
    }
}
