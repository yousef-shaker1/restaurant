<?php
namespace App\Livewire;

use App\Models\prodect;
use App\Models\section;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsPaginate extends Component
{
    use WithPagination;

    public $search = '';
    public $sectionId = null;

    protected $queryString = ['search', 'sectionId'];

    public function mount($sectionId = null)
    {
        $this->sectionId = $sectionId;
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        $sections = section::all();

        $productsQuery = prodect::query();

        if (!is_null($this->sectionId) && $this->sectionId !== 'all') {
            $productsQuery->where('section_id', $this->sectionId);
        }

        if (!empty($this->search)) {
            $productsQuery->where('name', 'like', '%' . $this->search . '%');
        }

        $products = $productsQuery->paginate(10);

        return view('livewire.products-paginate', [
            'products' => $products,
            'sections' => $sections,
        ]);
    }

    public function searchProducts()
    {
        $this->resetPage();
    }

    public function showSection($sectionId)
    {
        $this->sectionId = $sectionId;
        $this->resetPage(); // Reset pagination when section filter changes
    }
}