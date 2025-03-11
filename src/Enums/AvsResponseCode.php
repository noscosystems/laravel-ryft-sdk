<?php

namespace Nosco\Ryft\Enums;

use Nosco\Ryft\Contracts\Enums\HasDescription;
use Nosco\Ryft\Contracts\Enums\HasLabel;

enum AvsResponseCode: string implements HasDescription, HasLabel
{
    case A = 'A';
    case B = 'B';
    case C = 'C';
    case D = 'D';
    case F = 'F';
    case G = 'G';
    case I = 'I';
    case M = 'M';
    case N = 'N';
    case P = 'P';
    case R = 'R';
    case S = 'S';
    case U = 'U';
    case W = 'W';
    case X = 'X';
    case Y = 'Y';
    case Z = 'Z';

    public static function fullMatches(): array
    {
        return [
            self::D,
            self::F,
            self::M,
            self::X,
            self::Y,
        ];
    }

    public static function partialMatches(): array
    {
        return [
            self::A,
            self::B,
            self::P,
            self::W,
            self::Z,
        ];
    }

    public static function noMatches(): array
    {
        return [
            self::C,
            self::I,
            self::N,
        ];
    }

    public static function errors(): array
    {
        return [
            self::G,
            self::R,
            self::S,
            self::U,
        ];
    }

    public function isFullMatch(): bool
    {
        return in_array($this, self::fullMatches());
    }

    public function isPartialMatch(): bool
    {
        return in_array($this, self::partialMatches());
    }

    public function isNoMatch(): bool
    {
        return in_array($this, self::noMatches());
    }

    public function isError(): bool
    {
        return in_array($this, self::errors());
    }

    public function description(): string
    {
        if ($this->isFullMatch()) {
            return 'Street address and postal/zip code match';
        }

        return match ($this) {
            self::A => 'Street address matches, postal/zip code does not match',
            self::B => 'Street address matches, postal/zip code not verified',
            self::C => 'Street address and postal/zip code not verified',
            self::G,
            self::I => 'Address information not verified',
            self::N => 'Neither street address nor postal/zip code match',
            self::P => 'Postal/zip code matches, street address not verified',
            self::R => 'Unable to perform verification',
            self::S => 'AVS currently not supported by issuer',
            self::U => 'Address information not verified due to no data from issuer',
            self::W,
            self::Z => 'Postal/zip code matches, street address does not match',
            default => 'Unknown',
        };
    }

    public function label(): string
    {
        if ($this->isFullMatch()) {
            return 'Full Match';
        }
        if ($this->isPartialMatch()) {
            return 'Partial Match';
        }
        if ($this->isNoMatch()) {
            return 'No Match';
        }

        return match ($this) {
            self::G,
            self::S => 'Not Supported',
            self::R,
            self::U => 'System Unavailable',
            default => 'Unknown',
        };
    }
}
