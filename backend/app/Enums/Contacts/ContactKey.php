<?php

namespace App\Enums\Contacts;

final class ContactKey
{
    public const PHONE = 'phone';

    public const EMAIL = 'email';

    public const ADDRESS = 'address';

    public const COORDS = 'coords';

    public const TELEGRAM = 'telegram';

    public const WHATSAPP = 'whatsapp';

    public const VK = 'vk';

    public static function getKeys(): array
    {
        return [
            self::PHONE,
            self::EMAIL,
            self::ADDRESS,
            self::COORDS,
            self::TELEGRAM,
            self::WHATSAPP,
            self::VK,
        ];
    }
}
