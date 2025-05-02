<?php

namespace Nosco\Ryft\Dtos\Files;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Files\FileCategory;
use Nosco\Ryft\Enums\Files\FileType;

class File extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $file = null,
        public ?FileCategory $category = null,
        public ?Collection $metadata = null,
        public ?string $name = null,
        public ?FileType $type = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
        public ?int $sizeInBytes = null,
    ) {}
}
