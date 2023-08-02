<?php

namespace Arch\Domain\Entity;

abstract class BaseEntity
{
    protected int $id;

    public abstract function serialize(): array;

    public abstract function __toString(): string;


    public function getId(): int
    {
        return $this->id;
    }
}
