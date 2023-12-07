<?php

namespace App\Http\Livewire\Admin\Customers;

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Livewire\Component;

class UpdateForm extends Component
{
    public $customer, $name, $email, $state;

    public function mount(User $customer): void
    {
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->state = $customer->state;
        $this->customer = $customer;
    }

    public function update()
    {
        $this->customer->update([
            'state' => $this->state
        ]);

        return redirect()->route('admin.customers.index')->notice('El cliente se actualizo correctamente', 'success');
    }

    public function render()
    {
        return view('livewire.admin.customers.update-form');
    }
}
