<?php


namespace Src\Employee\Domain\Contracts;


use Src\Employee\Domain\EmployeeEntity;
use Src\Employee\Domain\ValueObjects\EmployeeId;

interface EmployeeRepositoryContract
{
    public function search(EmployeeId $employeeId): array;
    public function save(EmployeeEntity $employee): void;
}
