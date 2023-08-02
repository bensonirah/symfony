<?php

namespace Arch\Domain\ValueObject;

final class UserName
{
    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function iSEqual(UserName $userName): bool
    {
        return $this->name == $userName;
    }

    public function __toString()
    {
        return $this->name;
    }
}