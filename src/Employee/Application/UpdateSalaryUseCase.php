<?php

declare(strict_types=1);

namespace Src\Employee\Application;


use Src\Employee\Domain\Contracts\EmployeeRepositoryContract;
use Src\Employee\Domain\ValueObjects\EmployeeHours;

final class UpdateSalaryUseCase
{
    private FindEmployeeUseCase $finder;
    private EmployeeRepositoryContract $repository;

    public function __construct(EmployeeRepositoryContract $repository)
    {
        $this->repository = $repository;
        $this->finder = new FindEmployeeUseCase($this->repository);
    }

    public function execute(int $id, int $hoursWorked): void
    {
        $employee = $this->finder->execute($id);

        $employee->calculateSalary(new EmployeeHours($hoursWorked));

        $this->repository->save($employee);
    }
}
