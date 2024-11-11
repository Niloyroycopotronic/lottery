<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegController;
use App\Http\Controllers\TicketNameController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\VoltController;
use Illuminate\Support\Facades\Route;
use App\Models\TicketName;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('volt/roll-input', [VoltController::class, 'roll_input'])->name('volt.roll_input');
    Route::post('volt/roll-input', [VoltController::class, 'roll_input_post'])->name('volt.roll_input_post');
    Route::get('volt/roll-list', [VoltController::class, 'roll_list'])->name('volt.roll_list');
    Route::get('volt/roll-list-edit/{id}', [VoltController::class, 'roll_list_edit'])->name('volt.roll_list_edit');
    Route::post('volt/roll-input-edit', [VoltController::class, 'roll_input_edit'])->name('volt.roll_input_edit');
    Route::resource('volt', VoltController::class);

    Route::get('reg/item_add', [RegController::class, 'item_add'])->name('reg.item_add');
    Route::post('reg/item_add', [RegController::class, 'item_add_post'])->name('reg.item_add_post');
    Route::delete('reg/item_add/{id}', [RegController::class, 'item_add_delete'])->name('reg.item_add_delete');

    Route::get('reg/input', [RegController::class, 'reg_input'])->name('reg.reg_input');
    Route::post('reg/input', [RegController::class, 'reg_input_post'])->name('reg.reg_input_post');
    Route::get('reg/item-list', [RegController::class, 'reg_item_list'])->name('reg.reg_item_list');
    Route::get('reg/item-view-edit/{date}', [RegController::class, 'item_view_edit'])->name('reg.item_view_edit');
    Route::post('reg/item-view-edit', [RegController::class, 'item_view_edit_post'])->name('reg.item_view_edit_post');

    Route::get('reg/add_other', [RegController::class, 'add_other'])->name('reg.add_other');
    Route::post('reg/add_other', [RegController::class, 'add_other_post'])->name('reg.add_other_post');
    Route::delete('reg/{id}/destroy_other', [RegController::class, 'destroy_other'])->name('reg.destroy_other');
    Route::get('reg/other_data_input', [RegController::class, 'other_data_input'])->name('reg.other_data_input');
    Route::post('reg/other_data_input', [RegController::class, 'other_data_input_post'])->name('reg.other_data_input_post');

    Route::resource('reg', RegController::class);

    Route::get('ticket/filter', [TicketsController::class, 'filter'])->name('ticket_name.filter');
    Route::get('ticket/status_change/{ticketName}', [TicketNameController::class, 'status_change'])->name('ticket.status_change');
    Route::get('ticket/counting', [TicketNameController::class, 'counting'])->name('ticket.counting');
    Route::post('ticket/counting', [TicketNameController::class, 'counting_post'])->name('ticket.counting_post');
    Route::get('ticket/count_list', [TicketNameController::class, 'count_list'])->name('ticket.count_list');
    Route::get('ticket/list_edit/{id}', [TicketNameController::class, 'list_edit'])->name('ticket.list_edit');
    Route::post('ticket/list_edit', [TicketNameController::class, 'list_edit_post'])->name('ticket.list_edit_post');


    Route::resource('ticket', TicketsController::class);
    Route::resource('ticket_name', TicketNameController::class);
});

require __DIR__ . '/auth.php';
