<?php
declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Channels\Dto;

/**
 *
 */
enum ChannelsEnum: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
    case PUSH = 'push';
    case APP = 'in_app';

    public static function all(): array
    {
        return array_map(
            fn(self $case) => $case->value,
            self::cases()
        );
    }
}