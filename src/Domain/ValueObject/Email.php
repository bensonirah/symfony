<?php

namespace Arch\Domain\ValueObject;

final class Email
{
    private string $email;

    /**
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }
}