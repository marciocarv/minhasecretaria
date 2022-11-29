<?php

use App\Http\Controllers\BoxController;
use App\Http\Controllers\declarationController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\listController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TesteController;
use App\Models\Employee;
use App\Models\Employment_bond;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/inativo', [IndexController::class, 'inactive'])->name('inactive');

Route::get('/servidor', [EmployeeController::class, 'employee'])->name('employee');

Route::get('/teste', [TesteController::class, 'teste'])->name('teste');

Route::prefix('caixa')->group(function (){
    Route::get('/gerenciar-caixas', [BoxController::class, 'manageBoxes'])->name('manageBoxes');
    Route::post('/adicionar', [BoxController::class, 'store'])->name('storeBox');
    Route::get('/excluir/{id}', [BoxController::class, 'delete'])->name('deleteBox');
    Route::get('/editar/{id}', [BoxController::class, 'manageBoxes'])->name('setUpdateBox');
    Route::post('/editar', [BoxController::class, 'update'])->name('updateBox');
    Route::get('/visualizar/{id}', [BoxController::class, 'view'])->name('viewBox');
    Route::get('/mostrar/{type}', [BoxController::class, 'show'])->name('showBox');
    Route::get('/imprimir/{id}', [BoxController::class, 'print'])->name('printBox');
    Route::get('/pesquisar', [BoxController::class, 'search'])->name('search');
});

Route::prefix('aluno')->group(function (){
    Route::get('/adicionar/{id}', [StudentController::class, 'setStore'])->name('setStoreStudent');
    Route::post('/adicionar', [StudentController::class, 'store'])->name('storeStudent');
    Route::get('/excluir/{id}', [StudentController::class, 'delete'])->name('deleteStudent');
    Route::get('/editar/{id}', [StudentController::class, 'setUpdate'])->name('setUpdateStudent');
    Route::post('/editar', [StudentController::class, 'update'])->name('updateStudent');
    Route::get('/resgatar/{id}', [StudentController::class, 'rescue'])->name('rescueStudent');
    Route::get('/trasferir/{id}', [StudentController::class, 'setTransfer'])->name('setTransferStudent');
    Route::post('/transferir', [StudentController::class, 'transfer'])->name('transferStudent');
    Route::get('/arquivar/{id}', [StudentController::class, 'record'])->name('recordStudent');
});

Route::prefix('servidor')->group(function(){
    Route::get('/adicionar/{id}', [EmployeeController::class, 'setStoreBox'])->name('setStoreBoxEmployee');
    Route::post('/adicionar-caixa', [EmployeeController::class, 'storeBox'])->name('storeBoxEmployee');
    Route::get('/excluir/{id}', [EmployeeController::class, 'deleteBox'])->name('deleteBox');
    Route::get('/apagar/{id}', [EmployeeController::class, 'delete'])->name('deleteEmployee');
    Route::get('/editar-caixa/{id}', [EmployeeController::class, 'setUpdateBoxEmployee'])->name('setUpdateBoxEmployee');
    Route::post('/editar-caixa', [EmployeeController::class, 'updateBox'])->name('updateBoxEmployee');
    Route::get('/resgatar/{id}', [EmployeeController::class, 'rescue'])->name('rescueEmployee');
    Route::post('/vincular', [EmployeeController::class, 'storeEmployment_bond'])->name('storeEmployment_bond');
    Route::get('/trasferir/{id}', [EmployeeController::class, 'setTransfer'])->name('setTransferEmployee');
    Route::post('/transferir', [EmployeeController::class, 'transfer'])->name('transferEmployee');
    Route::get('/cadastrar', [EmployeeController::class, 'setStore'])->name('setStoreEmployee');
    Route::post('/cadastrar', [EmployeeController::class, 'storeEmployee'])->name('storeEmployee');
    Route::get('/editar/{id}', [EmployeeController::class, 'setUpdateEmployee'])->name('setUpdateEmployee');
    Route::post('/editar', [EmployeeController::class, 'update'])->name('updateEmployee');
    Route::get('/gerenciar/{id}', [EmployeeController::class, 'manageEmployee'])->name('manageEmployee');
    Route::get('/ficha-funcional/{id}', [declarationController::class, 'functionalSheet'])->name('functionalSheet');
    Route::get('/encerramento/{id}', [declarationController::class, 'closure_bond'])->name('closure_bond');
    Route::post('/encerramento', [declarationController::class, 'close_bond'])->name('close_bond');
    Route::get('/alterar-funcao/{id}', [EmployeeController::class, 'setchangeRole'])->name('setChangeRole');
    Route::post('/alterar-funcao', [EmployeeController::class, 'changeRole'])->name('changeRole');
});

Route::prefix('declaracao')->group(function(){
    Route::get('/inicio_atividade/{id}', [declarationController::class, 'activity_start'])->name('activity_start');
    Route::get('/opcoes', [declarationController::class, 'declaration_options'])->name('declaration_options');
    Route::post('/exibir_declaracao', [declarationController::class, 'showDeclaration'])->name('showDeclaration');
    Route::get('/encerramento_atividade/{id}', [declarationController::class, 'activity_end'])->name('activity_end');
    Route::get('/trabalho/{id}', [declarationController::class, 'work_declaration'])->name('work_declaration');
    Route::get('/vinculo/{id}', [declarationController::class, 'bond_declaration'])->name('bond_declaration');
});

Route::prefix('api')->group(function(){
    Route::get('/getEmployeeForType/{status}', [declarationController::class, 'employeeForType'])->name('getEmployeeForType');
});

Route::prefix('listas')->group(function(){
    Route::get('/opcoes', [listController::class, 'listOptions'])->name('listOptions');
    Route::post('/gerar', [listController::class, 'generateList'])->name('generateList');
});