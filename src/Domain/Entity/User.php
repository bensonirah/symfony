<?php

namespace Arch\Domain\Entity;

use Arch\Domain\ValueObject\Email;
use Arch\Domain\ValueObject\UserName;

final class User extends BaseEntity
{
    private Email $email;
    private UserName $userName;

    /**
     * @param UserName $userName
     * @param Email $email
     */
    public function __construct(UserName $userName, Email $email)
    {
        $this->email = $email;
        $this->userName = $userName;
    }

    public function serialize(): array
    {
        return [
            'username' => $this->userName,
            'email' => $this->email
        ];
    }
    public function __toString(): string
    {
        $sFormat = ' ';
        foreach ($this->serialize() as $key => $value) {
            $sFormat .= implode(':', [$key, $value]);
        }
        return $sFormat;
    }
}