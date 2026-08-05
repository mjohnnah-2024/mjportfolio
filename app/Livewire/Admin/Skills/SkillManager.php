<?php

namespace App\Livewire\Admin\Skills;

use App\Enums\SkillLevel;
use App\Models\Skill;
use App\Models\SkillCategory;
use Livewire\Component;

class SkillManager extends Component
{
    // Form state
    public bool $showForm = false;
    public ?int $editingId = null;
    public string $name = '';
    public ?int $skillCategoryId = null;
    public string $level = '';
    public int $sortOrder = 0;

    public function openCreate(): void
    {
        $this->reset('editingId', 'name', 'skillCategoryId', 'level', 'sortOrder');
        $this->showForm = true;
    }

    public function openEdit(int $id): void
    {
        $skill = Skill::findOrFail($id);
        $this->editingId = $id;
        $this->name = $skill->name;
        $this->skillCategoryId = $skill->skill_category_id;
        $this->level = $skill->level instanceof SkillLevel ? $skill->level->value : (string) $skill->level;
        $this->sortOrder = $skill->sort_order;
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'skillCategoryId' => ['required', 'integer', 'exists:skill_categories,id'],
            'level' => ['required', 'string', \Illuminate\Validation\Rule::in(array_column(SkillLevel::cases(), 'value'))],
            'sortOrder' => ['nullable', 'integer'],
        ]);

        $data = [
            'name' => $this->name,
            'skill_category_id' => $this->skillCategoryId,
            'level' => $this->level,
            'sort_order' => $this->sortOrder,
        ];

        if ($this->editingId) {
            Skill::findOrFail($this->editingId)->update($data);
        } else {
            Skill::create($data);
        }

        $this->showForm = false;
        $this->reset('editingId', 'name', 'skillCategoryId', 'level', 'sortOrder');
        session()->flash('success', 'Skill saved.');
    }

    public function delete(int $id): void
    {
        Skill::findOrFail($id)->delete();
        session()->flash('success', 'Skill deleted.');
    }

    public function cancel(): void
    {
        $this->showForm = false;
        $this->reset('editingId', 'name', 'skillCategoryId', 'level', 'sortOrder');
    }

    public function render()
    {
        return view('livewire.admin.skills.skill-manager', [
            'categories' => SkillCategory::withCount('skills')->orderBy('sort_order')->get(),
            'skillsByCategory' => SkillCategory::with(['skills' => fn ($q) => $q->orderBy('sort_order')])->orderBy('sort_order')->get(),
            'levels' => SkillLevel::cases(),
        ])->layout('layouts.admin', ['title' => 'Skills']);
    }
}
