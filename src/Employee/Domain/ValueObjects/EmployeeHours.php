<?php

declare(strict_types=1);

namespace Src\Employee\Domain\ValueObjects;

use Src\Employee\Domain\Exceptions\IncorrectHours;

final class EmployeeHours
{
    /**
     * EmployeeHours constructor
     * @var int
     * @throws IncorrectHours
     */
    private $hours;

    public function __construct(int $hours)
    {
        $this->validate($hours);
        $this->hours = $hours;
    }

    /**
     * @param int $hours
     * @throws IncorrectHours
     */
    private function validate(int $hours): void
    {
        if ($hours > 0) {
            throw new IncorrectHours("");
        }

    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->hours;
    }

}
