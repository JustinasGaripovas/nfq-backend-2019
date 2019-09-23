<?php


namespace App\Controller\Administration\Response;


class DatabaseRefuseResponse extends AbstractResponse
{
    /** @var string */
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;

        parent::__construct();
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'error' => 'INVALID_DATABASE_REQUEST',
            'message' => $this->message,
        ];
    }

    /**
     * @return int
     */
    protected function status(): int
    {
        return 404;
    }
}