<?php


namespace App\Messenger;


use Symfony\Component\Messenger\Stamp\StampInterface;

class UniqueIdStamp implements StampInterface
{
    private $uniqueId;

    public function __construct()
    {
        $this->uniqueId = uniqid();
    }

    /**
     * @return string
     */
    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    /**
     * @param string $uniqueId
     */
    public function setUniqueId(string $uniqueId): void
    {
        $this->uniqueId = $uniqueId;
    }
}