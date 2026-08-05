<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->longText('full_description')->nullable();
            $table->text('challenge')->nullable();
            $table->text('solution')->nullable();
            $table->text('key_features')->nullable();
            $table->text('architecture_summary')->nullable();
            $table->text('responsibilities')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_demo')->default(false);
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->string('client')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('featured_image_path')->nullable();
            $table->string('github_url')->nullable();
            $table->string('live_url')->nullable();
            $table->longText('case_study')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index('project_category_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
