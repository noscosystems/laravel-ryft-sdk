<?php

namespace Nosco\Ryft\Enums\Files;

enum FileCategory: string
{
    case REPORT = 'Report';
    case EVIDENCE = 'Evidence';
    case VERIFICATION_DOCUMENT = 'VerificationDocument';
}
