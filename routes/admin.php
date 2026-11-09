<?php

use App\Http\Controllers\Admin\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMenuActionController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\AutomationApproveController;
use App\Http\Controllers\Admin\AutomationRejectController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\BulkCollectionController;
use App\Http\Controllers\Admin\BulkForwardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientCategoryController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\TerritoryController;
use App\Http\Controllers\Admin\ChainClientController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ClientMessageController;
use App\Http\Controllers\Admin\ClientPriceController;
use App\Http\Controllers\Admin\CoaSetupController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CreditVoucherEntryController;
use App\Http\Controllers\Admin\DebitVoucherEntryController;
use App\Http\Controllers\Admin\DeliveryChargeController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\DeliveryManController;
use App\Http\Controllers\Admin\DetailsCardController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\GroupSaleTargetController;
use App\Http\Controllers\Admin\InvestController;
use App\Http\Controllers\Admin\InvestorController;
use App\Http\Controllers\Admin\JournalVoucherEntryController;
use App\Http\Controllers\Admin\LifestyleProductReturnController;
use App\Http\Controllers\Admin\LifestyleProductSalesController;
use App\Http\Controllers\Admin\LiftingController;
use App\Http\Controllers\Admin\LiftingFashionProductController;
use App\Http\Controllers\Admin\LiftingReturnController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\OfflineOrderController;
use App\Http\Controllers\Admin\OnlineOrderController;
use App\Http\Controllers\Admin\OnlineOrderDeliveryController;
use App\Http\Controllers\Admin\OrderAssignController;
use App\Http\Controllers\Admin\OrderCollectionController;
use App\Http\Controllers\Admin\OrderDashboardController;
use App\Http\Controllers\Admin\OrderReturnController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RetailSalesController;
use App\Http\Controllers\Admin\ProfitDistributionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SalesReturnApproveController;
use App\Http\Controllers\Admin\SalesReturnController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ShowcaseItemController;
use App\Http\Controllers\Admin\SiteItemsController;
use App\Http\Controllers\Admin\SocialWorkController;
use App\Http\Controllers\Admin\SpecialFoodItemsController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\TransferReceiveController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\VendorPaymentController;
use App\Http\Controllers\Admin\VoucherApproveController;
use App\Http\Controllers\Admin\VoucherRejectController;
use App\Http\Controllers\Admin\CourierAssignController;
use App\Http\Controllers\Admin\LabelController;
use App\Http\Controllers\Admin\PreOrderController;
use App\Http\Controllers\Admin\RetailReturnController;

//CRM
use App\Http\Controllers\Crm\LeadController;
use App\Http\Controllers\Crm\LeadSourceController;
use App\Http\Controllers\Crm\LeadStatusController;
use App\Http\Controllers\Crm\MeetingController;
use App\Http\Controllers\Crm\QuotationController;
use App\Http\Controllers\Crm\CustomerRequirementController;
use App\Http\Controllers\Crm\CrmReportController;
use App\Http\Controllers\Hrm\EmployeeController;
use App\Http\Controllers\Hrm\EmployeeAttendanceController;
use App\Http\Controllers\Hrm\EmployeeLeaveController;
use App\Http\Controllers\Hrm\HolidayController;
use App\Http\Controllers\Hrm\PayrollController;
use App\Http\Controllers\Hrm\BonusManagementController;
use App\Http\Controllers\Hrm\IncrementController;
use App\Http\Controllers\Hrm\LoanController;
use App\Http\Controllers\Hrm\OverTimeController;
use App\Http\Controllers\Hrm\ExpenseController;
use App\Http\Controllers\Hrm\DocumentController;
use App\Http\Controllers\Hrm\ResignationController;
use App\Http\Controllers\Hrm\TerminationController;
use App\Http\Controllers\Hrm\AppraisalController;
use App\Http\Controllers\Hrm\HrmReportController;

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('login.index');
    Route::post('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/sidebar', [AdminController::class, 'sidebar'])->name('sidebar');
    
   Route::get('/language/{lang}', function ($lang) {

    if (in_array($lang, ['en', 'bn'])) {
        session()->put('locale', $lang);
    }

    return redirect()->back();

})->name('language');
});


//CRM Module
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/lead-source', LeadSourceController::class);
    Route::resource('/lead-status', LeadStatusController::class);
    Route::resource('/lead', LeadController::class);
    Route::get('/crm/dashboard',[LeadController::class,'dashboard'])->name('crm.dashboard');
    Route::put('/lead/{id}/status',[LeadController::class,'updateStatus'])->name('lead.status.update');
    Route::get('/enlisted/new',[LeadController::class,'enlistedNew'])->name('enlisted.new');

    Route::resource('/meeting-schedule', MeetingController::class);
    Route::resource('/quotation', QuotationController::class);
    Route::resource('/customer-requirement', CustomerRequirementController::class);
    Route::resource('/crm-report', CrmReportController::class);
    Route::resource('/employee', EmployeeController::class);

});

// HRM
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/employee', EmployeeController::class);
    Route::get('/hrm/dashboard',[EmployeeController::class,'dashboard'])->name('hrm.dashboard');
    Route::resource('/employee-attendance', EmployeeAttendanceController::class);
    Route::resource('/employee-leave', EmployeeLeaveController::class);
    Route::resource('/holiday', HolidayController::class);
    Route::resource('/payroll', PayrollController::class);
    Route::post('payroll/update-status/{id}',[PayrollController::class,'updateStatus'])->name('payroll.update-status');
    Route::get('/salary-structure',[PayrollController::class,'salaryStructure'])->name('salary.structure');
     Route::get('/salary/certificate/{id}',[PayrollController::class,'salaryCertificate'])->name('salary.structure.certificate');

    Route::get('/salary-generate',[PayrollController::class,'salaryGenerate'])->name('salary.generate');
    Route::post('/salary-generate/store',[PayrollController::class,'salaryGenerateStore'])->name('salary.generate.store');
    Route::get('/salary-sheet',[PayrollController::class,'salarySheet'])->name('salary.sheet');
    Route::get('/payslip',[PayrollController::class,'paySlip'])->name('pay.slip');
    Route::get('/payslip/print',[PayrollController::class,'paySlipPrint'])->name('pay.slip.print');
    Route::resource('/employee-bonus',BonusManagementController::class);
    Route::resource('/employee-increment',IncrementController::class);
    Route::resource('/employee-loan',LoanController::class);
    Route::resource('/employee-overtime',OverTimeController::class);
    Route::resource('/expense',ExpenseController::class);
    Route::resource('/documents',DocumentController::class);
    Route::resource('/resignation',ResignationController::class);
    Route::resource('/termination',TerminationController::class);
    Route::resource('/appraisal',AppraisalController::class);
    Route::get('/hrm-report',[HrmReportController::class,'hrmReport'])->name('hrm.report');
    

});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['admin_permission']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'edit'])->name('profile.index');
    Route::put('/change-images', [AdminController::class, 'changeImages'])->name('change-images');
    Route::put('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::put('/profile', [AdminController::class, 'update'])->name('profile.update');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    // User
    Route::resource('/user', UserController::class);
    Route::get('/user/{id}/password', [UserController::class, 'changePassword'])->name('user.password');
    Route::put('/user/password/{id}', [UserController::class, 'passwordUpdate'])->name('user.password-update');

    // Admin Menu
    Route::resource('/admin-menu', AdminMenuController::class);

    // Admin Menu Actions
    Route::get('/admin-menu-actions/{id}', [AdminMenuActionController::class, 'index'])->name('admin-menuAction.index');
    Route::get('/admin-menu-actions/{id}/create', [AdminMenuActionController::class, 'create'])->name('admin-menuAction.create');
    Route::post('/admin-menu-actions/{id}/store', [AdminMenuActionController::class, 'store'])->name('admin-menuAction.store');
    Route::get('/admin-menu-actions/{id}/edit', [AdminMenuActionController::class, 'edit'])->name('admin-menuAction.edit');
    Route::put('/admin-menu-actions/{id}', [AdminMenuActionController::class, 'update'])->name('admin-menuAction.update');
    Route::delete('/admin-menu-actions/{id}', [AdminMenuActionController::class, 'destroy'])->name('admin-menuAction.destroy');

    // Role
    Route::resource('/role', RoleController::class);

    // Permission
    Route::get('/permission/{id}', [RoleController::class, 'rolePermissionEdit'])->name('rolePermission.edit');
    Route::put('/permission/permissions-update/{id}', [RoleController::class, 'rolePermissionUpdate'])->name('rolePermission.update');

    // Admin Settings
    Route::resource('/admin-settings', AdminSettingController::class);

    // Company Setup
    Route::resource('/company', CompanyController::class);

    // Vehicle Setup
    Route::resource('/vehicle', VehicleController::class);

    // Branch Setup
    Route::resource('/branch', BranchController::class);

    // Store Setup
    Route::resource('/store', StoreController::class);

    // Staff Setup
    Route::resource('/staff', StaffController::class);

    // Region Setup
    Route::resource('/region', RegionController::class);

    // Area Setup
    Route::resource('/area', AreaController::class);

    // Territory Setup
    Route::resource('/territory', TerritoryController::class);

    // Client Category Setup
    Route::resource('/client-category', ClientCategoryController::class);

    // Chain Client Setup
    Route::resource('/chain-client', ChainClientController::class);

    // Vendor Setup
    Route::resource('/vendor', VendorController::class);

    // Vendor Payment
    Route::resource('/vendor-payment', VendorPaymentController::class);

    // Client Setup
    Route::resource('/client', ClientController::class);

    // Sales Group Setup
    Route::resource('/group', GroupController::class);

    // Group Sales Target Setup
    Route::resource('/group-target', GroupSaleTargetController::class);

    // Client Price Setup
    Route::resource('/client-price', ClientPriceController::class);

    // Lifting Product
    Route::resource('/lifting', LiftingController::class);
    Route::get('/lifting-barcode-print/{id}', [LiftingController::class, 'barcodePrint'])->name('lifting-barcode.print');
    Route::get('/lifting-document/{id}', [LiftingController::class, 'showDocument'])->name('lifting-document.show');

    // Lifting Fashion Product
    Route::resource('/lifting-fashion-product', LiftingFashionProductController::class);

    // Lifting Product Return
    Route::resource('/lifting-return', LiftingReturnController::class);

    // Offline Order
    Route::resource('/offline-order', OfflineOrderController::class);

    // Sales
    Route::resource('/sales', SalesController::class);
    Route::get('/sales-invoice/{id}', [SalesController::class, 'invoice'])->name('sales.invoice');
    Route::get('/sales-vat/{id}', [SalesController::class, 'vat'])->name('sales.vat');
    Route::get('/search-edit', [SalesController::class, 'searchEdit'])->name('sales.search-edit');
    Route::resource('/running-sales', RetailSalesController::class);

    Route::resource('/retail-return', RetailReturnController::class);

    // Lifestyle Product Sales
    Route::resource('/sales-lifestyle-product', LifestyleProductSalesController::class);
    Route::get('/sales-lifestyle-product-invoice/{id}', [LifestyleProductSalesController::class, 'invoice'])->name('sales-lifestyle-product.invoice');
    Route::get('/sales-lifestyle-product-vat/{id}', [LifestyleProductSalesController::class, 'vat'])->name('sales-lifestyle-product.vat');
    Route::get('/sales-lifestyle-product-edit', [LifestyleProductSalesController::class, 'searchEdit'])->name('sales-lifestyle-product.search-edit');

    // Sales Return
    Route::resource('/sales-return', SalesReturnController::class);

    // Return Receive
    Route::resource('/return-approve', SalesReturnApproveController::class);

    // Lifestyle Product Return
    Route::resource('/lifestyle-product-return', LifestyleProductReturnController::class);

    // Collection
    Route::resource('/collection', CollectionController::class);

    // Bulk Collection
    Route::resource('/bulk-collection', BulkCollectionController::class);

    // Delivery
    Route::resource('/delivery', DeliveryController::class);
    Route::get('/delivery-gatepass/{id}', [DeliveryController::class, 'gatePass'])->name('delivery.gatepass');
    Route::get('/delivery-delivered/{id}', [DeliveryController::class, 'delivered'])->name('delivery.delivered');

    // Transfer Product
    Route::resource('/transfer', TransferController::class);

    // Transfer Product Receive
    Route::resource('/transfer-receive', TransferReceiveController::class);

    // Category
    Route::resource('/category', CategoryController::class);

    // Attribute
    Route::resource('/attribute', AttributeController::class);

    // Attribute Value
    Route::get('/attribute-values/{id}', [AttributeValueController::class, 'index'])->name('attribute-value.index');
    Route::post('/attribute-values/{id}', [AttributeValueController::class, 'store'])->name('attribute-value.store');
    Route::get('/attribute-values/{id}/edit', [AttributeValueController::class, 'edit'])->name('attribute-value.edit');
    Route::put('/attribute-values/{id}/update', [AttributeValueController::class, 'update'])->name('attribute-value.update');
    Route::delete('/attribute-values/{id}/delete', [AttributeValueController::class, 'destroy'])->name('attribute-value.destroy');

    // Product
    Route::resource('/product', ProductController::class);
    Route::get('/product-attributes/{id}', [ProductController::class, 'attributes'])->name('product.attributes');
    Route::put('/product-attributes/{id}', [ProductController::class, 'attributesUpdate'])->name('product.attributes.update');

    // Location
    Route::resource('/location', LocationController::class);

    // Customers
    Route::resource('/customers', CustomerController::class);

    // Order
    Route::resource('/online-order', OrderController::class);
    Route::get('/export-process-order', [OrderController::class, 'exportProcess'])->name('process-order.export');

    // Order
    Route::get('/cancel-orders', [OrderController::class, 'CancelOrder'])->name('cancel-order.index');
    Route::get('/cancel-order/{id}/approve', [OrderController::class, 'approveCancelOrder'])->name('cancel-order.approve');

    // Delivery Charge Setup
    Route::resource('/delivery-charge', DeliveryChargeController::class);

    // Online Order Delivery
    Route::resource('/online-order-delivery', OnlineOrderDeliveryController::class);
    Route::get('/online-order-delivery-gatepass/{id}', [OnlineOrderDeliveryController::class, 'gatePass'])->name('online-order-delivery.gatepass');

    // Online Order Dashboard
    Route::resource('/order-dashboard', OrderDashboardController::class);

    // Accounting
    Route::resource('/coa-setup', CoaSetupController::class);

    // Accounts Transaction
    Route::resource('/debit-voucher-entry', DebitVoucherEntryController::class);
    Route::get('/debit-voucher-entry/{id}/print', [DebitVoucherEntryController::class, 'print'])->name('debit-voucher-entry.print');
    Route::resource('/credit-voucher-entry', CreditVoucherEntryController::class);
    Route::get('/credit-voucher-entry/{id}/print', [creditVoucherEntryController::class, 'print'])->name('credit-voucher-entry.print');
    Route::resource('/journal-voucher-entry', JournalVoucherEntryController::class);
    Route::get('/journal-voucher-entry/{id}/print', [journalVoucherEntryController::class, 'print'])->name('journal-voucher-entry.print');
    Route::resource('/voucher-approve', VoucherApproveController::class);
    Route::resource('/voucher-reject', VoucherRejectController::class);
    Route::resource('/automation-approve', AutomationApproveController::class);
    Route::resource('/automation-reject', AutomationRejectController::class);

    // Investor
    Route::resource('/investor', InvestorController::class);

    // Invest
    Route::resource('/invest', InvestController::class);

    // Profit Distribute
    Route::resource('/profit-distribute', ProfitDistributionController::class);

    // Investor Payment
    Route::resource('/payment', PaymentController::class);

    // Order
    Route::resource('/order', OnlineOrderController::class);

    // Order Return
    Route::resource('/order-return', OrderReturnController::class);

    // Delivery Man
    Route::resource('/delivery-man', DeliveryManController::class);

    // Bulk Forward
    Route::resource('/bulk-forward', BulkForwardController::class);

    // Assign Order
    Route::resource('/order-assign', OrderAssignController::class);

    // Order Status
    Route::resource('/order-status', OrderStatusController::class);

    // Order Collection
    Route::resource('/order-collection', OrderCollectionController::class);

    // Courier Assign
    Route::resource('/courier-assign', CourierAssignController::class);

    // Pre Order
    Route::resource('/pre-order', PreOrderController::class);
    Route::match(['post', 'PUT'], '/pre-order-section/{id}', [PreOrderController::class, 'storeUpdate'])->name('pre-order-section.store-update');
    Route::get('/pre-order-section/{id}/edit', [PreOrderController::class, 'editSection'])->name('pre-order-section.edit');
    Route::delete('/pre-order-section/{id}', [PreOrderController::class, 'destroySection'])->name('pre-order-section.destroy');
});

// ================== Reports ================== //
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['admin_permission']], function () {
    Route::get('/product-list', [ReportController::class, 'productList'])->name('product-list.index');
    Route::get('/lifting-report', [ReportController::class, 'liftingReport'])->name('lifting-history.index');
    Route::get('/lifting-return-history', [ReportController::class, 'liftingReturnHistory'])->name('lifting-return-history.index');
    Route::get('/vendor-payment-history', [ReportController::class, 'vendorPayment'])->name('vendor-payment-history.index');
    Route::get('/vendor-statement', [ReportController::class, 'vendorStatement'])->name('vendor-statement.index');
    Route::get('/client-list', [ReportController::class, 'clientList'])->name('client-list.index');
    Route::get('/sales-history', [ReportController::class, 'salesHistroy'])->name('sales-history.index');
    Route::get('/collection-history', [ReportController::class, 'collectionHistory'])->name('collection-history.index');
    Route::get('/return-history', [ReportController::class, 'returnHistory'])->name('return-history.index');
    Route::get('/client-statement', [ReportController::class, 'clientStatement'])->name('client-statement.index');
    Route::get('/delivery-statement', [ReportController::class, 'deliveryStatement'])->name('delivery-statement.index');
    Route::get('/transfer-log', [ReportController::class, 'transferLog'])->name('transfer-log.index');
    Route::get('/stock-out', [ReportController::class, 'stockOut'])->name('stock-out.index');
    Route::get('/stock-status', [ReportController::class, 'stockStatus'])->name('stock-status.index');
    Route::get('/stock-valuation', [ReportController::class, 'stockValuation'])->name('stock-valuation.index');
    Route::get('/sales-contribution', [ReportController::class, 'salesContribution'])->name('sales-contribution.index');
    Route::get('/sales-realization', [ReportController::class, 'salesRealization'])->name('sales-realization.index');
    Route::get('/lifting-realization', [ReportController::class, 'liftingRealization'])->name('lifting-realization.index');
    Route::get('/sales-ageing', [ReportController::class, 'salesAgeing'])->name('sales-ageing.index');
    Route::get('/client-outstanding', [ReportController::class, 'clientOutstanding'])->name('client-outstanding.index');
    Route::get('/sales-target-achivement', [ReportController::class, 'SalesTargetAchievement'])->name('sales-target-achivement.index');
    Route::get('/product-wise-profit', [ReportController::class, 'productWiseProfit'])->name('product-wise-profit.index');
    Route::get('/access-log', [ReportController::class, 'accessLog'])->name('access-log.index');
    Route::get('/product-statement', [ReportController::class, 'productStatement'])->name('product-statement.index');
    Route::get('/salesman-flowchart', [ReportController::class, 'salesManFlowChart'])->name('salesman-flowchart.index');
    Route::get('/client-sales-flow', [ReportController::class, 'clientSalesFlow'])->name('client-sales-flow.index');
    Route::get('/online-sales-history', [ReportController::class, 'onlineSalesHistory'])->name('online-sales-history.index');
    Route::get('/coa-list', [ReportController::class, 'coaList'])->name('coa-list.index');
    Route::get('/voucher-list', [ReportController::class, 'voucherList'])->name('voucher-list.index');
    Route::get('/cash-book', [ReportController::class, 'cashBook'])->name('cash-book.index');
    Route::get('/bank-book', [ReportController::class, 'bankBook'])->name('bank-book.index');
    Route::get('/transaction-ledger', [ReportController::class, 'transactionLedger'])->name('transaction-ledger.index');
    Route::get('/cash-flow-statement', [ReportController::class, 'cashFlowStatement'])->name('cash-flow-statement.index');
    Route::get('/general-ledger', [ReportController::class, 'generalLedger'])->name('general-ledger.index');
    Route::get('/income-statement', [ReportController::class, 'incomeStatement'])->name('income-statement.index');
    Route::get('/trial-balance', [ReportController::class, 'trialBalance'])->name('trial-balance.index');
    Route::get('/balance-sheet', [ReportController::class, 'balanceSheet'])->name('balance-sheet.index');
    Route::get('/head-details', [ReportController::class, 'headDetails'])->name('head-details.index');
    Route::get('/receive-payment', [ReportController::class, 'receivePayment'])->name('receive-payment.index');
    Route::get('/receive-payment-head-details', [ReportController::class, 'receivePaymentHeadDetails'])->name('receive-payment-head-details.index');
    Route::match(['get', 'post'], '/generate-barcode', [ReportController::class, 'generateBarcode'])->name('generate-barcode.index');
    Route::get('/product-search', [ReportController::class, 'productSearch'])->name('product.search');
    Route::get('/profit-loss', [ReportController::class, 'profitLossReport'])->name('profit-loss.index');
    Route::get('/profit-sheet', [ReportController::class, 'profitSheet'])->name('profit-sheet.index');
    Route::get('/investor-statement', [ReportController::class, 'investorStatement'])->name('investor-statement.index');
    Route::get('/profit-due-list', [ReportController::class, 'profitDueList'])->name('profit-due-list.index');
    Route::get('/order-list', [ReportController::class, 'orderList'])->name('order-list.index');
    Route::get('/required-product', [ReportController::class, 'requiredProduct'])->name('required-product.index');
    Route::get('/areawise-orders', [ReportController::class, 'areawiseOrders'])->name('areawise-orders.index');
    Route::get('/areawise-order', [ReportController::class, 'areawiseOrder'])->name('areawise-order.index');
    Route::get('/product-wise-sales-summary', [ReportController::class, 'productWiseSalesSummary'])->name('product-wise-sales-summary.index');
    Route::get('/area-wise-sales-statement', [ReportController::class, 'areaWiseSalesStatement'])->name('area-wise-sales-statement.index');
    Route::get('/store-wise-sales-statement', [ReportController::class, 'storeWiseSalesStatement'])->name('store-wise-sales-statement.index');
    Route::get('/monthly-statement', [ReportController::class, 'monthlyStatement'])->name('monthly-statement.index');
    Route::get('/storewise-orders', [ReportController::class, 'storewiseOrders'])->name('storewise-orders.index');
    Route::get('/storewise-order', [ReportController::class, 'storewiseOrder'])->name('storewise-order.index');
    Route::get('/on-route-orders', [ReportController::class, 'onRouteOrders'])->name('on-route-orders.index');
    Route::get('/deliveryman-delivery-statement', [ReportController::class, 'deliverymanDeliveryStatement'])->name('deliveryman-delivery-statement.index');
    Route::get('/customer-list', [ReportController::class, 'customerList'])->name('customer-list.index');
    Route::get('/monthly-summary-sheet', [ReportController::class, 'monthlySummarySheet'])->name('monthly-summary-sheet.index');
    Route::get('/monthly-chart', [ReportController::class, 'monthlyChart'])->name('monthly-chart.index');
    Route::get('/collection-report', [ReportController::class, 'collectionReport'])->name('collection-report.index');
    Route::get('/retail-sales-report', [ReportController::class, 'retailSalesReport'])->name('retail-sales-report.index');
    Route::get('/retail-return-report', [ReportController::class, 'retailReturnReport'])->name('retail-return-report.index');
});
// ================== Reports ================== //

// Frontend CMS
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['admin_permission']], function () {

    // Settings
    Route::resource('/settings', SettingController::class);

    // Page
    Route::resource('/page', PageController::class);

    // Home Page Slider
    Route::resource('/slider', SliderController::class);

    // Site Items
    Route::resource('/site-item', SiteItemsController::class);

    // Special Food Items
    Route::resource('/special-food-item', SpecialFoodItemsController::class);

    // Details Card Items
    Route::resource('/details-card', DetailsCardController::class);

    // Details Showcase Items
    Route::resource('/showcase-item', ShowcaseItemController::class);

    // Site Contact Details
    Route::resource('/testimonial', TestimonialController::class);

    // Site About Us Details
    Route::resource('/about', AboutController::class);

    // Site About Us Details
    Route::resource('/social-working', SocialWorkController::class);

    // Site Contact Details
    Route::resource('/contact', ContactController::class);

    // Subscription
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');

    // Client Message
    Route::get('/client-message', [ClientMessageController::class, 'index'])->name('client-message.index');
    Route::get('/client-message/{id}', [ClientMessageController::class, 'show'])->name('client-message.show');

    // Online Requst
    Route::get('/client-request', [ClientMessageController::class, 'onlineRequest'])->name('client-request.index');
    Route::get('/client-request/{id}', [ClientMessageController::class, 'showMessage'])->name('client-request.show');

    // Frontend Menu
    Route::resource('/menu', MenuController::class);
    Route::get('/menu-item/{id}', [MenuItemController::class, 'index'])->name('menu-item.index');
    Route::put('/menu-item/{id}', [MenuItemController::class, 'update'])->name('menu-item.update');
    Route::get('/menu-serialize/{id}', [MenuItemController::class, 'edit'])->name('menu-item.serialize');
    Route::delete('/menu-item/{id}', [MenuItemController::class, 'destroy'])->name('menu-item.destroy');

    // Homepage Sections
    Route::resource('/sections', SectionController::class);
});
