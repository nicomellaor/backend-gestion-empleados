<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //
    public function getEmployees(Request $request){
        $id = $request->id;

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
        // Obtener datos del frontend con validaciones
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'birthdate' => 'date|before:today',
            'sex' => 'in:male,female,other',
            'city' => 'string|max:255',
            'job' => 'required|string|max:255',
            'salary' => 'numeric|min:0',
            'number' => 'string|regex:/^\+?[0-9]{10,15}$/',
            'email' => 'unique:employees|max:255'
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

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
        // Obtener datos del frontend con validaciones
        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'name' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date|before:today',
            'sex' => 'nullable|in:male,female,other',
            'city' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'number' => 'nullable|string|regex:/^\+?[0-9]{10,15}$/',
            'email' => 'nullable|max:255|unique:employees,email,'.$request->id,
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        $data = array_filter($data, function($value){
            return !empty($value);
        });
        
        // Buscar empleado
        $employee = Employee::find($data['id']);
        if($employee){
            $employee->update($data);

            return response()->json([
                'message' => 'Empleado actualizado correctamente',
                'employee' => $employee
            ]);
        }

        else{
            return response()->json([
                'message' => 'Empleado no encontrado'
            ]);
        }
    }

    public function deleteEmployee(Request $request){
        $id = $request->id;
        $employee = Employee::find($id);

        if($employee){
            $employee->delete();

            return response()->json([
                'message' => 'Empleado eliminado exitosamente'
            ]);
        }

        else{
            return response()->json([
                'message' => 'Empleado no encontrado'
            ]);
        }
    }
}
