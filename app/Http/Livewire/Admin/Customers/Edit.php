<?php

namespace App\Http\Livewire\Admin\Customers;

use Illuminate\Support\Facades\Route;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
  public $customer;

  public $name;
  public $email;
  public $state;

  public function mount()
  {
    $this->customer = Route::current()->parameter('customer');
    $this->name = $this->customer->name;
    $this->email = $this->customer->email;
    $this->state = $this->customer->state;
  }

  public function updateCustomer()
  {
    $this->customer->update([
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    return redirect()->route('admin.customers.index')->notice('El cliente se actualizo correctamente', 'success');
  }

  public function render()
  {
    return view('livewire.admin.customers.edit');
  }
}
