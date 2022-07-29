<?php

declare(strict_types=1);

namespace Src\Employee\Infrastructure\Repositories\File;


use Src\Employee\Domain\Contracts\EmployeeRepositoryContract;
use Src\Employee\Domain\EmployeeEntity;
use Src\Employee\Domain\ValueObjects\EmployeeId;

final class InFileEmployeeRepository implements EmployeeRepositoryContract
{

    public function search(EmployeeId $employeeId): array
    {
        return [];
    }

    public function save(EmployeeEntity $employee): void
    {
        if (($fp = fopen('another-file.csv', 'w')) !== FALSE) {
            foreach ( $employee->toArray() as $dato) {
                fputcsv($fp, $dato);
            }

            fclose($fp);
        }
    }
}
