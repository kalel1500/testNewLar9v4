<?php

declare(strict_types=1);

namespace Src\Employee\Infrastructure\Eloquent;


use Src\Employee\Infrastructure\Models\Employee;
use Src\Employee\Domain\Contracts\EmployeeRepositoryContract;
use Src\Employee\Domain\EmployeeEntity;
use Src\Employee\Domain\ValueObjects\EmployeeId;

final class EmployeeEloquentRepository implements EmployeeRepositoryContract
{
    private $model;

    public function __construct()
    {
        $this->model = new Employee();
    }

    public function search(EmployeeId $employeeId): array
    {
        return $this->model->findOrFail($employeeId->value())->toArray();
    }

    public function save(EmployeeEntity $employeeEntity): void
    {
        $this->model->fill($employeeEntity->toArray());
        $this->model->save();
    }
}
