<?php

declare(strict_types=1);

namespace Src\Employee\Domain;

use Src\Employee\Domain\ValueObjects\EmployeeId;
use Src\Employee\Domain\ValueObjects\EmployeeHours;
use Src\Employee\Domain\ValueObjects\EmployeeMoney;

final class EmployeeEntity
{
    private EmployeeId $id;
    private EmployeeHours $hoursWorker;
    private EmployeeMoney $pricePerHour;
    private EmployeeMoney $salary;

    public function __construct(
        EmployeeId $id, 
        EmployeeHours $hoursWorker, 
        EmployeeMoney $pricePerHour
        )
    {
        $this->id = $id;
        $this->hoursWorker = $hoursWorker;
        $this->pricePerHour = $pricePerHour;
    }

    /**
     * @return EmployeeId
     */
    public function id(): EmployeeId
    {
        return $this->id;
    }

    /**
     * @return EmployeeHours
     */
    public function hoursWorker(): EmployeeHours
    {
        return $this->hoursWorker;
    }

    /**
     * @return EmployeeMoney
     */
    public function salary(): EmployeeMoney
    {
        return $this->salary;
    }

    /**
     * @return EmployeeMoney
     */
    public function pricePerHour(): EmployeeMoney
    {
        return $this->pricePerHour;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'hoursWorker' => $this->hoursWorker()->value(),
            'salary' => $this->salary()->value(),
            'pricePerHours' => $this->pricePerHour()->value()
        ];
    }
    
    public static function fromArray(array $data): self
    {
        return new self(
            new EmployeeId($data['id']),
            new EmployeeHours($data['hoursWorker']),
            new EmployeeMoney($data['pricePerHour'])
        );
    }

    public static function create(
        EmployeeId $id,
        EmployeeHours $hoursWorker,
        EmployeeMoney $pricePerHour
    ): self
    {
        return new self($id, $hoursWorker, $pricePerHour);
    }

    public function calculateSalary(EmployeeHours $hoursWorker): void
    {
        $this->salary = new EmployeeMoney(
            $this->pricePerHour->value() * $hoursWorker->value()
        );
    }

}
