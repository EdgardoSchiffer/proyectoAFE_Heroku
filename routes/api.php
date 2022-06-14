<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\AccessoryTypeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RentalDetailController;
use App\Http\Controllers\RentalUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleDetailController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/brands', [BrandController::class, 'index']);

Route::prefix('/brand')->group(
    function () {
        Route::post('/store', [BrandController::class, 'store']);
        Route::put('/{id}', [BrandController::class, 'update']);
        Route::delete('/{id}', [BrandController::class, 'destroy']);
        Route::get('/listar', [BrandController::class, 'listar']);
    }
);

Route::get('/fuel_types', [FuelTypeController::class, 'index']);

Route::prefix('/fuel_type')->group(
    function () {
        Route::post('/store', [FuelTypeController::class, 'store']);
        Route::put('/{id}', [FuelTypeController::class, 'update']);
        Route::delete('/{id}', [FuelTypeController::class, 'destroy']);
    }
);

Route::get('/vehicle_types', [VehicleTypeController::class, 'index']);

Route::prefix('/vehicle_type')->group(
    function () {
        Route::post('/store', [VehicleTypeController::class, 'store']);
        Route::put('/{id}', [VehicleTypeController::class, 'update']);
        Route::delete('/{id}', [VehicleTypeController::class, 'destroy']);
    }
);

Route::get('/accessory_types', [AccessoryTypeController::class, 'index']);

Route::prefix('/accessory_type')->group(
    function () {
        Route::post('/store', [AccessoryTypeController::class, 'store']);
        Route::put('/{id}', [AccessoryTypeController::class, 'update']);
        Route::delete('/{id}', [AccessoryTypeController::class, 'destroy']);
        Route::get('/list', [AccessoryTypeController::class, 'list']);
    }
);

Route::get('/vehicles', [VehicleController::class, 'index']);

Route::prefix('/vehicle')->group(
    function () {
        Route::post('/store', [VehicleController::class, 'store']);
        Route::put('/{id}', [VehicleController::class, 'update']);
        Route::delete('/{id}', [VehicleController::class, 'destroy']);
        Route::post('/dashboardVehicle', [VehicleController::class, 'dashboardVehicle']);
        //Route::get('/listar', [BrandController::class, 'listar']);
    }
);

Route::get('/galeries', [GaleryController::class, 'index']);

Route::prefix('/galery')->group(
    function () {
        Route::get('/list/{id}', [GaleryController::class, 'list']);
        Route::post('/store', [GaleryController::class, 'store']);
        Route::delete('/{id}', [GaleryController::class, 'destroy']);
    }
);

//Route::get('/galeries', [GaleryController::class, 'index']);

Route::prefix('/vehicle_detail')->group(
    function () {
        Route::post('/store', [VehicleDetailController::class, 'store']);
        Route::get('/list/{id}', [VehicleDetailController::class, 'list']);
        Route::put('/updateVehicleDetail', [VehicleDetailController::class, 'updateVehicleDetail']);
        Route::post('/createDefaultDetailVehicle/{id}', [VehicleDetailController::class, 'createDefaultDetailVehicle']);
        //Route::delete('/{id}', [GaleryController::class, 'destroy']);
        Route::get('/listAccessoriesUnAssigned/{id}', [VehicleDetailController::class, 'listAccessoriesUnAssigned']);
    }
);

Route::get('/departments', [DepartmentController::class, 'index']);

Route::prefix('/departments')->group(
    function () {
        Route::post('/store', [DepartmentController::class, 'store']);
        Route::put('/{id}', [DepartmentController::class, 'update']);
        Route::delete('/{id}', [DepartmentController::class, 'destroy']);
        Route::get('/listar', [DepartmentController::class, 'listar']);
    }
);

Route::get('/roles', [RoleController::class, 'index']);
Route::prefix('/role')->group(
    function () {
        //Route::post('/store', [RoleController::class, 'store']);
        //Route::put('/{id}', [RoleController::class, 'update']);
        //Route::delete('/{id}', [RoleController::class, 'destroy']);
        Route::get('/listar', [RoleController::class, 'listar']);
    }
);

Route::get('/municipalities', [MunicipalityController::class, 'index']);

Route::prefix('/municipalities')->group(
    function () {
        Route::post('/store', [MunicipalityController::class, 'store']);
        Route::put('/{id}', [MunicipalityController::class, 'update']);
        Route::delete('/{id}', [MunicipalityController::class, 'destroy']);
        Route::get('/list', [MunicipalityController::class, 'list']);
    }
);

Route::get('/accessories', [AccessoryController::class, 'index']);

Route::prefix('/accessory')->group(
    function () {
        Route::post('/store', [AccessoryController::class, 'store']);
        Route::put('/{id}', [AccessoryController::class, 'update']);
        Route::delete('/{id}', [AccessoryController::class, 'destroy']);
        Route::get('/list', [AccessoryController::class, 'list']);
    }
);

Route::get('/clients', [ClientController::class, 'index']);

Route::prefix('/client')->group(
    function () {
        Route::post('/store', [ClientController::class, 'store']);
        Route::put('/{id}', [ClientController::class, 'update']);
        Route::delete('/{id}', [ClientController::class, 'destroy']);
        Route::get('/list', [ClientController::class, 'list']);
        Route::get('/listClients', [ClientController::class, 'listClients']);
    }
);

Route::get('/users', [UserController::class, 'index']);

Route::prefix('/user')->group(
    function () {
        Route::post('/store', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::get('/list', [UserController::class, 'list']);
    }
);

Route::prefix('/comment')->group(
    function () {
        Route::post('/store', [CommentController::class, 'store']);
    }
);

Route::get('/rentals', [RentalController::class, 'index']);

Route::prefix('/rental')->group(
    function () {
        Route::post('/store', [RentalController::class, 'store']);
        Route::put('/{id}', [RentalController::class, 'update']);
        
        Route::delete('/{id}', [RentalController::class, 'destroy']);
        
        //Route::get('/dashboardVehicle', [VehicleController::class, 'dashboardVehicle']);
        //Route::get('/listar', [BrandController::class, 'listar']);
        Route::get('/list', [RentalController::class, 'list']);
        Route::post('/storeRentalClient', [RentalController::class, 'storeRentalClient']);
        Route::get('/listRentalByClient/{id}', [RentalController::class, 'listRentalByClient']);
        Route::put('/updateAdvance/{id}', [RentalController::class, 'updateAdvance']);
        
        Route::get('/listAllRental', [RentalController::class, 'listAllRental']);
    }
);

Route::prefix('/rental_detail')->group(
    function () {
        Route::post('/store', [RentalDetailController::class, 'store']);
        Route::get('/list/{id}', [RentalDetailController::class, 'list']);
        Route::put('/updateRentalDetail', [RentalDetailController::class, 'updateRentalDetail']);
        Route::post('/createDefaultRentalDetail/{id}', [RentalDetailController::class, 'createDefaultRentalDetail']);
        //Route::delete('/{id}', [GaleryController::class, 'destroy']);
        Route::get('/listAccessoriesUnAssigned/{id}', [RentalDetailController::class, 'listAccessoriesUnAssigned']);
    }
);

Route::get('/rental_users', [RentalUserController::class, 'index']);

Route::prefix('/rental_user')->group(
    function () {
        Route::post('/store', [RentalUserController::class, 'store']);
        Route::put('/{id}', [RentalUserController::class, 'update']);
        //Route::delete('/{id}', [RentalController::class, 'destroy']);
        //Route::get('/dashboardVehicle', [VehicleController::class, 'dashboardVehicle']);
        Route::get('/showRental/{id}', [RentalUserController::class, 'showRental']);
    }
);
