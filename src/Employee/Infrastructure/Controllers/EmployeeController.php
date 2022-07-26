<?php

namespace Src\Employee\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Src\Employee\Application\UpdateSalaryUseCase;
use Src\Employee\Infrastructure\Eloquent\EmployeeEloquentRepository;

class EmployeeController extends Controller
{
    public function list(Request $request)
    {
        // Muestra listado de empleados
        return view('app.employee.list');
    }

    public function updateEmployeesSalary(Request $request)
    {
        /**
        * La validación de inputs ya la resolvemos en los value objects.
        $request->validate([
            'employees.*.id' => 'required|exists:employees',
            'employees.*.hoursWorked' => 'required|min:0',
        ]);
         **/

        // Obtengo los empleados
        $employees = $request->input('employees');

        $useCase = new UpdateSalaryUseCase(new EmployeeEloquentRepository());

        foreach ($employees as $employee) {
            $useCase->execute(
                $employee['id'],
                $employee['hoursWorked']
            );
        }

        // Muestra listado de empleados
        return view('employees')->with('success', 'Salaries updated correctly.');
    }
}
