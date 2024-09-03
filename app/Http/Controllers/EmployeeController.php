<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Sector;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->get();
        $total = Employee::count();
        return view('admin.employee.home', compact(['employees','total']));
    }
        public function create()
    {
        $sectors = Sector::all();
        return view('admin.employee.create', compact('sectors'));
    }

    public function store(EmployeeUpdateRequest $request)
    {
        
        $data = $request->validated();
        // dd($data);
        $data = Employee::create($data);
        if ($data) {
            session()->flash('success','Funcionário adicionado com sucesso');
            return redirect()->route('employee.index');
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('employee.create');
        }
    }

    public function edit($id)
    {
        $sectors = Sector::orderBy('nome')->get();
        $employees = Employee::findOrFail($id);
        return view('admin.employee.update', compact('employees', 'sectors'));
    }

    public function destroy($id)
    {
        $employees = Employee::findOrFail($id)->delete();
        if ($employees) {
            session()->flash('success', 'Funcionário excluído com sucesso!');
            return redirect()->route('employee.index');
        } else {
            session()->flash('error','Erro na exclusão do item');
            return redirect()->route('employee.index');
        }
    }
    public function update(EmployeeUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $employees = Employee::findOrFail($id);
        
        $nome = $request->nome;
        $sector_id = $request->sector_id;
        $salario = $request->salario;

        $employees->nome = $nome;
        $employees->sector_id = $sector_id;                                                 
        $employees->salario = $salario;
        $data = $employees->save();
        if ($data) {
            session()->flash('success', 'Funcionário atualizado com sucesso!');
            return redirect()->route('employee.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('employee.update');
        }

    
}
}