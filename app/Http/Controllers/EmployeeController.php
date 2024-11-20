<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

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
        // $data = $request->all();
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'job' => 'required|max:255',
            
        ]);

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
            $employee->name = $data['name'];
            $employee->birthdate = $data['birthdate'];
            $employee->sex = $data['sex'];
            $employee->city = $data['city'];
            $employee->job = $data['job'];
            $employee->salary = $data['salary'];
            $employee->number = $data['number'];
            $employee->photo = $data['photo'];
            $employee->email = $data['email'];

            $employee->save();

            return response()->json([
                'message' => 'Empleado actualizado correctamente'
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
