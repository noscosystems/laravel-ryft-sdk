<?php

namespace Nosco\Ryft\Enums\Files;

enum FileType: string
{
    case CSV = 'Csv';
    case JPG = 'Jpg';
    case PNG = 'Png';
    case PDF = 'Pdf';

    public function extension(): string
    {
        return strtolower($this->value);
    }

    public function mimeType(): string
    {
        return match ($this) {
            self::CSV => 'text/csv',
            self::JPG => 'image/jpeg',
            self::PNG => 'image/png',
            self::PDF => 'application/pdf',
        };
    }
}
