<?php


namespace App\Controller\Administration\Response;


class SuccessResponse extends AbstractResponse
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
            'error' => 'NONE',
            'message' => $this->message,
        ];
    }

    /**
     * @return int
     */
    protected function status(): int
    {
        return 200;
    }
}