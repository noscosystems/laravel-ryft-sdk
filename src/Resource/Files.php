<?php

namespace Nosco\Ryft\Resource;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Files\File;
use Nosco\Ryft\Requests\Files\FileCreate;
use Nosco\Ryft\Requests\Files\FileGetById;
use Nosco\Ryft\Requests\Files\FilesList;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class Files extends Resource
{
    /**
     * List files.
     *
     * Used to fetch a paginated list of files under your account
     *
     * @param string|null $category    Filter for files in a specific category.
     * @param bool|null   $ascending   Control the order (newest or oldest) in which the files are returned.
     *                                 `false` will arrange the results with newest first,
     *                                 whereas `true` shows oldest first. The default is `false`.
     * @param int|null    $limit       Control how many items are return in a given page
     *                                 The max limit we allow is `25`. The default is `10`.
     * @param string|null $startsAfter A token to identify where to resume a subsequent paginated query.
     *                                 The value of the `paginationToken` field from that response should be supplied here,
     *                                 to retrieve the next page of results for that timestamp range.
     *
     * @return Collection<File>
     *
     * @link https://api-reference.ryftpay.com/#tag/Files/operation/filesList Documentation
     */
    public function list(?string $category = null, ?bool $ascending = null, ?int $limit = null, ?string $startsAfter = null): Collection
    {
        return $this->connector
            ->send(new FilesList($category, $ascending, $limit, $startsAfter))
            ->dtoOrFail();
    }

    /**
     * Create/Upload a new file to your account.
     *
     * Upload a file to Ryft via the API. Useful if you need to:
     *
     *  - upload evidence when challenging disputes
     *  - upload KYB/KYC documents for sub accounts
     *
     * @link https://api-reference.ryftpay.com/#tag/Files/operation/fileCreate Documentation
     */
    public function create(File $file): File
    {
        return $this->connector
            ->send(new FileCreate($file))
            ->dtoOrFail();
    }

    /**
     * Retrieve a file.
     *
     * Retrieve a file by its unique ID
     *
     * @param string $fileId File to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Files/operation/fileGetById Documentation
     */
    public function get(string $fileId): File
    {
        return $this->connector
            ->send(new FileGetById($fileId))
            ->dtoOrFail();
    }
}
