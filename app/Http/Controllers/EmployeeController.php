<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //
    public function getEmployees(Request $request){
        $id = $request ->id;

        // Si se envió un id
        if($id){
            $employee = Employee::find($id);
            // Si se encontró el empleado
            if($employee){
                return response()->json([
                    'employee' => $employee
                ]);
            }
            else{
                return response()->json([
                    'message' => 'Empleado no encontrado'
                ]);
            }
        }
        // Si no se envió un id
        else{
            $employee = Employee::all();
            return response()->json([
                'employee' => $employee
            ]);
        }
    }

    public function createEmployee(Request $request){
        // Obtener datos del frontend 
        $data = $request->all();

        $employee = Employee::create([
            'name' => $data['name'],
            'birthdate' => $data['birthdate'],
            'sex' => $data['sex'],
            'city' => $data['city'],
            'job' => $data['job'],
            'salary' => $data['salary'],
            'number' => $data['number'],
            'photo' => $data['photo'],
            'email' => $data['email']
        ]);

        return response()->json([
            'message' => '¡Empleado creado con éxito!',
            'employee' => $employee
        ]);
    }

    public function modifyEmployee(Request $request){
        // Obtener datos del frontend 
        $data = $request->all();

        // Buscar empleado
        $employee = Employee::find($data['id']);
        if($employee){
            //$employee -> update()
        }
    }

    public function deleteEmployee(){
        
    }
}
