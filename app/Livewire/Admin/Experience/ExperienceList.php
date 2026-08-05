<?php

namespace App\Livewire\Admin\Experience;

use App\Models\Experience;
use Livewire\Component;

class ExperienceList extends Component
{
    public bool $showForm = false;
    public ?int $editingId = null;

    public string $title = '';
    public string $organisation = '';
    public string $location = '';
    public string $startDate = '';
    public string $endDate = '';
    public bool $isCurrent = false;
    public string $description = '';
    public int $sortOrder = 0;

    public function openCreate(): void
    {
        $this->reset('editingId', 'title', 'organisation', 'location', 'startDate', 'endDate', 'isCurrent', 'description', 'sortOrder');
        $this->showForm = true;
    }

    public function openEdit(int $id): void
    {
        $exp = Experience::findOrFail($id);
        $this->editingId = $id;
        $this->title = $exp->title;
        $this->organisation = $exp->organisation;
        $this->location = $exp->location ?? '';
        $this->startDate = $exp->start_date?->format('Y-m-d') ?? '';
        $this->endDate = $exp->end_date?->format('Y-m-d') ?? '';
        $this->isCurrent = $exp->is_current;
        $this->description = $exp->description ?? '';
        $this->sortOrder = $exp->sort_order;
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'organisation' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'startDate' => ['required', 'date'],
            'endDate' => ['nullable', 'date', 'after:startDate'],
            'description' => ['nullable', 'string'],
            'sortOrder' => ['nullable', 'integer'],
        ]);

        $data = [
            'title' => $this->title,
            'organisation' => $this->organisation,
            'location' => $this->location ?: null,
            'start_date' => $this->startDate,
            'end_date' => $this->isCurrent ? null : ($this->endDate ?: null),
            'is_current' => $this->isCurrent,
            'description' => $this->description ?: null,
            'sort_order' => $this->sortOrder,
        ];

        if ($this->editingId) {
            Experience::findOrFail($this->editingId)->update($data);
        } else {
            Experience::create($data);
        }

        $this->showForm = false;
        $this->reset('editingId', 'title', 'organisation', 'location', 'startDate', 'endDate', 'isCurrent', 'description', 'sortOrder');
        session()->flash('success', 'Experience saved.');
    }

    public function delete(int $id): void
    {
        Experience::findOrFail($id)->delete();
        session()->flash('success', 'Experience deleted.');
    }

    public function cancel(): void
    {
        $this->showForm = false;
        $this->reset('editingId', 'title', 'organisation', 'location', 'startDate', 'endDate', 'isCurrent', 'description', 'sortOrder');
    }

    public function render()
    {
        return view('livewire.admin.experience.experience-list', [
            'experiences' => Experience::orderBy('sort_order')->orderByDesc('start_date')->get(),
        ])->layout('layouts.admin', ['title' => 'Experience']);
    }
}
