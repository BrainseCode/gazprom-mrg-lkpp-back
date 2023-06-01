<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\MeterController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\PayTotalController;
use App\Http\Controllers\Api\PayTovdgoController;
use App\Http\Controllers\Api\PowerUnitController;
use App\Http\Controllers\Api\CalculatorController;
use App\Http\Controllers\Api\IndicationController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\UserAndProfileController;
use App\Http\Controllers\Api\ThermometerController;
use App\Http\Controllers\Api\ContractTypeController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\UserContractsController;
use App\Http\Controllers\Api\PayGasPlannedController;
use App\Http\Controllers\Api\PressureGaugeController;
use App\Http\Controllers\Api\CalorieArchiveController;
use App\Http\Controllers\Api\ContractStatusController;
use App\Http\Controllers\Api\ConnectionPointController;
use App\Http\Controllers\Api\PayGasDeliveredController;
use App\Http\Controllers\Api\MeasuringComplexController;
use App\Http\Controllers\Api\IndicationSourceController;
use App\Http\Controllers\Api\IndicationStatusController;
use App\Http\Controllers\Api\UniversalRequestController;
use App\Http\Controllers\Api\UserNotificationsController;
use App\Http\Controllers\Api\ContractPayTotalsController;
use App\Http\Controllers\Api\IndicationQuarterController;
use App\Http\Controllers\Api\UnallocatedByDateController;
use App\Http\Controllers\Api\ContractPayTovdgosController;
use App\Http\Controllers\Api\NotificationStatusController;
use App\Http\Controllers\Api\TransferIndicationController;
use App\Http\Controllers\Api\RequestCallEmployeeController;
use App\Http\Controllers\Api\AllIndicationQuarterController;
use App\Http\Controllers\Api\UserUniversalRequestsController;
use App\Http\Controllers\Api\ContractContractTypesController;
use App\Http\Controllers\Api\ContractTypeContractsController;
use App\Http\Controllers\Api\GasConsumingEquipmentController;
use App\Http\Controllers\Api\ContractPayGasPlannedsController;
use App\Http\Controllers\Api\ContractCalorieArchivesController;
use App\Http\Controllers\Api\ContractStatusContractsController;
use App\Http\Controllers\Api\UserRequestCallEmployeesController;
use App\Http\Controllers\Api\ContractConnectionPointsController;
use App\Http\Controllers\Api\ContractPayGasDeliveredsController;
use App\Http\Controllers\Api\ContractContractStatusesController;
use App\Http\Controllers\Api\RequestApprovalUnevennessController;
use App\Http\Controllers\Api\ConnectionPointIndicationsController;
use App\Http\Controllers\Api\IndicationIndicationSourcesController;
use App\Http\Controllers\Api\IndicationSourceIndicationsController;
use App\Http\Controllers\Api\IndicationStatusIndicationsController;
use App\Http\Controllers\Api\IndicationIndicationStatusesController;
use App\Http\Controllers\Api\ContractAllIndicationQuartersController;
use App\Http\Controllers\Api\UserRequestApprovalUnevennessesController;
use App\Http\Controllers\Api\NotificationStatusNotificationsController;
use App\Http\Controllers\Api\NotificationNotificationStatusesController;
use App\Http\Controllers\Api\ConnectionPointIndicationQuartersController;
use App\Http\Controllers\Api\MeasuringComplexTransferIndicationsController;
use App\Http\Controllers\Api\ConnectionPointGasConsumingEquipmentsController;
use App\Http\Controllers\Api\RequestApprovalUnevennessUnallocatedByDatesController;
use App\Http\Controllers\Api\UnallocatedByDateRequestApprovalUnevennessesController;


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

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);


        // User And Profile
        Route::get('/users/{user}/profile', [
            UserAndProfileController::class,
            'index',
        ])->name('users.profile.index');
        Route::post('/users/{user}/profile', [
            UserAndProfileController::class,
            'store',
        ])->name('users.profile.store');

        // User Contracts
        Route::get('/users/{user}/contracts', [
            UserContractsController::class,
            'index',
        ])->name('users.contracts.index');
        Route::post('/users/{user}/contracts', [
            UserContractsController::class,
            'store',
        ])->name('users.contracts.store');

        // User Notifications
        Route::get('/users/{user}/notifications', [
            UserNotificationsController::class,
            'index',
        ])->name('users.notifications.index');
        Route::post('/users/{user}/notifications', [
            UserNotificationsController::class,
            'store',
        ])->name('users.notifications.store');

        // User Universal Requests
        Route::get('/users/{user}/universal-requests', [
            UserUniversalRequestsController::class,
            'index',
        ])->name('users.universal-requests.index');
        Route::post('/users/{user}/universal-requests', [
            UserUniversalRequestsController::class,
            'store',
        ])->name('users.universal-requests.store');

        // User Request Approval Unevennesses
        Route::get('/users/{user}/request-approval-unevennesses', [
            UserRequestApprovalUnevennessesController::class,
            'index',
        ])->name('users.request-approval-unevennesses.index');
        Route::post('/users/{user}/request-approval-unevennesses', [
            UserRequestApprovalUnevennessesController::class,
            'store',
        ])->name('users.request-approval-unevennesses.store');

        // User Request Call Employees
        Route::get('/users/{user}/request-call-employees', [
            UserRequestCallEmployeesController::class,
            'index',
        ])->name('users.request-call-employees.index');
        Route::post('/users/{user}/request-call-employees', [
            UserRequestCallEmployeesController::class,
            'store',
        ])->name('users.request-call-employees.store');

        Route::apiResource('user-profiles', UserProfileController::class);

        Route::apiResource('contracts', ContractController::class);

        // Contract Connection Points
        Route::get('/contracts/{contract}/connection-points', [
            ContractConnectionPointsController::class,
            'index',
        ])->name('contracts.connection-points.index');
        Route::post('/contracts/{contract}/connection-points', [
            ContractConnectionPointsController::class,
            'store',
        ])->name('contracts.connection-points.store');

        // Contract All Indication Quarters
        Route::get('/contracts/{contract}/all-indication-quarters', [
            ContractAllIndicationQuartersController::class,
            'index',
        ])->name('contracts.all-indication-quarters.index');
        Route::post('/contracts/{contract}/all-indication-quarters', [
            ContractAllIndicationQuartersController::class,
            'store',
        ])->name('contracts.all-indication-quarters.store');

        // Contract Pay Gas Delivereds
        Route::get('/contracts/{contract}/pay-gas-delivereds', [
            ContractPayGasDeliveredsController::class,
            'index',
        ])->name('contracts.pay-gas-delivereds.index');
        Route::post('/contracts/{contract}/pay-gas-delivereds', [
            ContractPayGasDeliveredsController::class,
            'store',
        ])->name('contracts.pay-gas-delivereds.store');

        // Contract Pay Gas Planneds
        Route::get('/contracts/{contract}/pay-gas-planneds', [
            ContractPayGasPlannedsController::class,
            'index',
        ])->name('contracts.pay-gas-planneds.index');
        Route::post('/contracts/{contract}/pay-gas-planneds', [
            ContractPayGasPlannedsController::class,
            'store',
        ])->name('contracts.pay-gas-planneds.store');

        // Contract Pay Tovdgos
        Route::get('/contracts/{contract}/pay-tovdgos', [
            ContractPayTovdgosController::class,
            'index',
        ])->name('contracts.pay-tovdgos.index');
        Route::post('/contracts/{contract}/pay-tovdgos', [
            ContractPayTovdgosController::class,
            'store',
        ])->name('contracts.pay-tovdgos.store');

        // Contract Pay Totals
        Route::get('/contracts/{contract}/pay-totals', [
            ContractPayTotalsController::class,
            'index',
        ])->name('contracts.pay-totals.index');
        Route::post('/contracts/{contract}/pay-totals', [
            ContractPayTotalsController::class,
            'store',
        ])->name('contracts.pay-totals.store');

        // Contract Calorie Archives
        Route::get('/contracts/{contract}/calorie-archives', [
            ContractCalorieArchivesController::class,
            'index',
        ])->name('contracts.calorie-archives.index');
        Route::post('/contracts/{contract}/calorie-archives', [
            ContractCalorieArchivesController::class,
            'store',
        ])->name('contracts.calorie-archives.store');

        // Contract Contract Types
        Route::get('/contracts/{contract}/contract-types', [
            ContractContractTypesController::class,
            'index',
        ])->name('contracts.contract-types.index');
        Route::post('/contracts/{contract}/contract-types/{contractType}', [
            ContractContractTypesController::class,
            'store',
        ])->name('contracts.contract-types.store');
        Route::delete('/contracts/{contract}/contract-types/{contractType}', [
            ContractContractTypesController::class,
            'destroy',
        ])->name('contracts.contract-types.destroy');

        // Contract Contract Statuses
        Route::get('/contracts/{contract}/contract-statuses', [
            ContractContractStatusesController::class,
            'index',
        ])->name('contracts.contract-statuses.index');
        Route::post(
            '/contracts/{contract}/contract-statuses/{contractStatus}',
            [ContractContractStatusesController::class, 'store']
        )->name('contracts.contract-statuses.store');
        Route::delete(
            '/contracts/{contract}/contract-statuses/{contractStatus}',
            [ContractContractStatusesController::class, 'destroy']
        )->name('contracts.contract-statuses.destroy');

        Route::apiResource(
            'connection-points',
            ConnectionPointController::class
        );

        // ConnectionPoint Gas Consuming Equipments
        Route::get(
            '/connection-points/{connectionPoint}/gas-consuming-equipments',
            [ConnectionPointGasConsumingEquipmentsController::class, 'index']
        )->name('connection-points.gas-consuming-equipments.index');
        Route::post(
            '/connection-points/{connectionPoint}/gas-consuming-equipments',
            [ConnectionPointGasConsumingEquipmentsController::class, 'store']
        )->name('connection-points.gas-consuming-equipments.store');

        // ConnectionPoint Indications
        Route::get('/connection-points/{connectionPoint}/indications', [
            ConnectionPointIndicationsController::class,
            'index',
        ])->name('connection-points.indications.index');
        Route::post('/connection-points/{connectionPoint}/indications', [
            ConnectionPointIndicationsController::class,
            'store',
        ])->name('connection-points.indications.store');

        // ConnectionPoint Indication Quarters
        Route::get('/connection-points/{connectionPoint}/indication-quarters', [
            ConnectionPointIndicationQuartersController::class,
            'index',
        ])->name('connection-points.indication-quarters.index');
        Route::post(
            '/connection-points/{connectionPoint}/indication-quarters',
            [ConnectionPointIndicationQuartersController::class, 'store']
        )->name('connection-points.indication-quarters.store');

        Route::apiResource(
            'measuring-complexes',
            MeasuringComplexController::class
        );

        // MeasuringComplex Transfer Indications
        Route::get(
            '/measuring-complexes/{measuringComplex}/transfer-indications',
            [MeasuringComplexTransferIndicationsController::class, 'index']
        )->name('measuring-complexes.transfer-indications.index');
        Route::post(
            '/measuring-complexes/{measuringComplex}/transfer-indications',
            [MeasuringComplexTransferIndicationsController::class, 'store']
        )->name('measuring-complexes.transfer-indications.store');

        Route::apiResource(
            'all-indication-quarters',
            AllIndicationQuarterController::class
        );

        Route::apiResource('calculators', CalculatorController::class);

        Route::apiResource('calorie-archives', CalorieArchiveController::class);

        Route::apiResource(
            'contract-statuses',
            ContractStatusController::class
        );

        // ContractStatus Contracts
        Route::get('/contract-statuses/{contractStatus}/contracts', [
            ContractStatusContractsController::class,
            'index',
        ])->name('contract-statuses.contracts.index');
        Route::post(
            '/contract-statuses/{contractStatus}/contracts/{contract}',
            [ContractStatusContractsController::class, 'store']
        )->name('contract-statuses.contracts.store');
        Route::delete(
            '/contract-statuses/{contractStatus}/contracts/{contract}',
            [ContractStatusContractsController::class, 'destroy']
        )->name('contract-statuses.contracts.destroy');

        Route::apiResource('contract-types', ContractTypeController::class);

        // ContractType Contracts
        Route::get('/contract-types/{contractType}/contracts', [
            ContractTypeContractsController::class,
            'index',
        ])->name('contract-types.contracts.index');
        Route::post('/contract-types/{contractType}/contracts/{contract}', [
            ContractTypeContractsController::class,
            'store',
        ])->name('contract-types.contracts.store');
        Route::delete('/contract-types/{contractType}/contracts/{contract}', [
            ContractTypeContractsController::class,
            'destroy',
        ])->name('contract-types.contracts.destroy');

        Route::apiResource(
            'gas-consuming-equipments',
            GasConsumingEquipmentController::class
        );

        Route::apiResource('indications', IndicationController::class);

        // Indication Indication Statuses
        Route::get('/indications/{indication}/indication-statuses', [
            IndicationIndicationStatusesController::class,
            'index',
        ])->name('indications.indication-statuses.index');
        Route::post(
            '/indications/{indication}/indication-statuses/{indicationStatus}',
            [IndicationIndicationStatusesController::class, 'store']
        )->name('indications.indication-statuses.store');
        Route::delete(
            '/indications/{indication}/indication-statuses/{indicationStatus}',
            [IndicationIndicationStatusesController::class, 'destroy']
        )->name('indications.indication-statuses.destroy');

        // Indication Indication Sources
        Route::get('/indications/{indication}/indication-sources', [
            IndicationIndicationSourcesController::class,
            'index',
        ])->name('indications.indication-sources.index');
        Route::post(
            '/indications/{indication}/indication-sources/{indicationSource}',
            [IndicationIndicationSourcesController::class, 'store']
        )->name('indications.indication-sources.store');
        Route::delete(
            '/indications/{indication}/indication-sources/{indicationSource}',
            [IndicationIndicationSourcesController::class, 'destroy']
        )->name('indications.indication-sources.destroy');

        Route::apiResource(
            'indication-quarters',
            IndicationQuarterController::class
        );

        Route::apiResource(
            'indication-sources',
            IndicationSourceController::class
        );

        // IndicationSource Indications
        Route::get('/indication-sources/{indicationSource}/indications', [
            IndicationSourceIndicationsController::class,
            'index',
        ])->name('indication-sources.indications.index');
        Route::post(
            '/indication-sources/{indicationSource}/indications/{indication}',
            [IndicationSourceIndicationsController::class, 'store']
        )->name('indication-sources.indications.store');
        Route::delete(
            '/indication-sources/{indicationSource}/indications/{indication}',
            [IndicationSourceIndicationsController::class, 'destroy']
        )->name('indication-sources.indications.destroy');

        Route::apiResource(
            'indication-statuses',
            IndicationStatusController::class
        );

        // IndicationStatus Indications
        Route::get('/indication-statuses/{indicationStatus}/indications', [
            IndicationStatusIndicationsController::class,
            'index',
        ])->name('indication-statuses.indications.index');
        Route::post(
            '/indication-statuses/{indicationStatus}/indications/{indication}',
            [IndicationStatusIndicationsController::class, 'store']
        )->name('indication-statuses.indications.store');
        Route::delete(
            '/indication-statuses/{indicationStatus}/indications/{indication}',
            [IndicationStatusIndicationsController::class, 'destroy']
        )->name('indication-statuses.indications.destroy');

        Route::apiResource('meters', MeterController::class);

        Route::apiResource('notifications', NotificationController::class);

        // Notification Notification Statuses
        Route::get('/notifications/{notification}/notification-statuses', [
            NotificationNotificationStatusesController::class,
            'index',
        ])->name('notifications.notification-statuses.index');
        Route::post(
            '/notifications/{notification}/notification-statuses/{notificationStatus}',
            [NotificationNotificationStatusesController::class, 'store']
        )->name('notifications.notification-statuses.store');
        Route::delete(
            '/notifications/{notification}/notification-statuses/{notificationStatus}',
            [NotificationNotificationStatusesController::class, 'destroy']
        )->name('notifications.notification-statuses.destroy');

        Route::apiResource(
            'notification-statuses',
            NotificationStatusController::class
        );

        // NotificationStatus Notifications
        Route::get(
            '/notification-statuses/{notificationStatus}/notifications',
            [NotificationStatusNotificationsController::class, 'index']
        )->name('notification-statuses.notifications.index');
        Route::post(
            '/notification-statuses/{notificationStatus}/notifications/{notification}',
            [NotificationStatusNotificationsController::class, 'store']
        )->name('notification-statuses.notifications.store');
        Route::delete(
            '/notification-statuses/{notificationStatus}/notifications/{notification}',
            [NotificationStatusNotificationsController::class, 'destroy']
        )->name('notification-statuses.notifications.destroy');

        Route::apiResource(
            'pay-gas-delivereds',
            PayGasDeliveredController::class
        );

        Route::apiResource('pay-gas-planneds', PayGasPlannedController::class);

        Route::apiResource('pay-totals', PayTotalController::class);

        Route::apiResource('pay-tovdgos', PayTovdgoController::class);

        Route::apiResource('power-units', PowerUnitController::class);

        Route::apiResource('pressure-gauges', PressureGaugeController::class);

        Route::apiResource(
            'request-approval-unevennesses',
            RequestApprovalUnevennessController::class
        );

        // RequestApprovalUnevenness Unallocated By Dates
        Route::get(
            '/request-approval-unevennesses/{requestApprovalUnevenness}/unallocated-by-dates',
            [
                RequestApprovalUnevennessUnallocatedByDatesController::class,
                'index',
            ]
        )->name('request-approval-unevennesses.unallocated-by-dates.index');
        Route::post(
            '/request-approval-unevennesses/{requestApprovalUnevenness}/unallocated-by-dates/{unallocatedByDate}',
            [
                RequestApprovalUnevennessUnallocatedByDatesController::class,
                'store',
            ]
        )->name('request-approval-unevennesses.unallocated-by-dates.store');
        Route::delete(
            '/request-approval-unevennesses/{requestApprovalUnevenness}/unallocated-by-dates/{unallocatedByDate}',
            [
                RequestApprovalUnevennessUnallocatedByDatesController::class,
                'destroy',
            ]
        )->name('request-approval-unevennesses.unallocated-by-dates.destroy');

        Route::apiResource(
            'request-call-employees',
            RequestCallEmployeeController::class
        );

        Route::apiResource('thermometers', ThermometerController::class);

        Route::apiResource(
            'transfer-indications',
            TransferIndicationController::class
        );

        Route::apiResource(
            'unallocated-by-dates',
            UnallocatedByDateController::class
        );

        // UnallocatedByDate Request Approval Unevennesses
        Route::get(
            '/unallocated-by-dates/{unallocatedByDate}/request-approval-unevennesses',
            [
                UnallocatedByDateRequestApprovalUnevennessesController::class,
                'index',
            ]
        )->name('unallocated-by-dates.request-approval-unevennesses.index');
        Route::post(
            '/unallocated-by-dates/{unallocatedByDate}/request-approval-unevennesses/{requestApprovalUnevenness}',
            [
                UnallocatedByDateRequestApprovalUnevennessesController::class,
                'store',
            ]
        )->name('unallocated-by-dates.request-approval-unevennesses.store');
        Route::delete(
            '/unallocated-by-dates/{unallocatedByDate}/request-approval-unevennesses/{requestApprovalUnevenness}',
            [
                UnallocatedByDateRequestApprovalUnevennessesController::class,
                'destroy',
            ]
        )->name('unallocated-by-dates.request-approval-unevennesses.destroy');

        Route::apiResource(
            'universal-requests',
            UniversalRequestController::class
        );
    });
