<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $orderBy = 'users.id';
    public $orderDirection = 'asc';

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->orderBy === $field) {
            $this->orderDirection = $this->orderDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->orderBy = $field;
            $this->orderDirection = 'asc';
        }
    }

    public function render()
    {
        $query = User::with('profile')
            ->where('users.name', 'like', '%' . $this->search . '%')
            ->orWhere('users.email', 'like', '%' . $this->search . '%')
            ->orWhereHas('profile', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->orderBy, $this->orderDirection);

        $users = $query->paginate(10);

        return view('livewire.user-search', ['users' => $users]);
    }

}
