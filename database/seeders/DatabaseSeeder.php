<?php

namespace Database\Seeders;

use App\Enums\ProjectStatus;
use App\Enums\SkillLevel;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Models\Technology;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => config('portfolio.admin_email', 'markjohnnah@gmail.com')],
            [
                'name' => 'Mark Johnnah',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'change-me-on-first-login')),
                'email_verified_at' => now(),
                'is_admin' => true,
            ],
        );

        Profile::updateOrCreate(
            ['user_id' => $admin->id],
            [
                'headline' => 'Full-Stack Laravel Developer, Software Architect and AI-Assisted Development Engineer',
                'biography' => "I am Mark Johnnah, a senior full-stack developer and software architect based in Port Moresby, Papua New Guinea, with more than 15 years of experience across web application development, server infrastructure, DevOps, and web hosting platform management.\n\nI specialise in building secure, scalable web applications using Laravel, .NET and Node.js. My experience spans the complete software delivery lifecycle — from architecture and design through to implementation, testing, deployment and production operations.\n\nIn recent years I have focused on controlled agentic software development, combining the Laravel AI SDK with leading large language models including Claude, GPT and Gemini. I define the architecture and engineering rules, orchestrate AI coding agents, review their output, and personally approve all production changes.\n\nI do not delegate engineering responsibility to AI. I define the architecture, establish the rules, orchestrate the agents, review their work and approve every production change.",
                'phone' => config('portfolio.phone'),
                'email' => config('portfolio.email'),
                'location' => config('portfolio.location'),
                'years_experience' => (int) config('portfolio.years_experience'),
            ],
        );

        $this->seedSkills();
        $this->seedExperience();
        $this->seedProjects();
        $this->seedServices();
        $this->seedSocialLinks();
        $this->seedSettings();
    }

    private function seedSkills(): void
    {
        $categories = [
            ['name' => 'Laravel & PHP', 'slug' => 'laravel-php', 'icon' => 'code-bracket', 'sort_order' => 1, 'skills' => [
                ['name' => 'PHP 8.3', 'level' => SkillLevel::Advanced],
                ['name' => 'Laravel 13', 'level' => SkillLevel::Advanced],
                ['name' => 'Livewire 4', 'level' => SkillLevel::Advanced],
                ['name' => 'Laravel AI SDK', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'Pest / PHPUnit', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'MySQL', 'level' => SkillLevel::Advanced],
                ['name' => 'REST APIs', 'level' => SkillLevel::Advanced],
                ['name' => 'Laravel Queues', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'Authentication & RBAC', 'level' => SkillLevel::Advanced],
            ]],
            ['name' => 'Microsoft .NET', 'slug' => 'dotnet', 'icon' => 'server', 'sort_order' => 2, 'skills' => [
                ['name' => 'C#', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'ASP.NET Core', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'Blazor', 'level' => SkillLevel::Experienced],
                ['name' => 'Entity Framework Core', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'Background Services', 'level' => SkillLevel::Experienced],
            ]],
            ['name' => 'Node.js & JavaScript', 'slug' => 'nodejs', 'icon' => 'command-line', 'sort_order' => 3, 'skills' => [
                ['name' => 'Node.js', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'TypeScript', 'level' => SkillLevel::Experienced],
                ['name' => 'Express.js', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'JavaScript', 'level' => SkillLevel::Advanced],
            ]],
            ['name' => 'AI-Assisted Development', 'slug' => 'ai-development', 'icon' => 'cpu-chip', 'sort_order' => 4, 'skills' => [
                ['name' => 'Laravel AI SDK', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'Claude Code', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'OpenAI GPT Models', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'Google Gemini', 'level' => SkillLevel::Experienced],
                ['name' => 'GitHub Copilot', 'level' => SkillLevel::Advanced],
                ['name' => 'Prompt Engineering', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'RAG (Retrieval-Augmented Generation)', 'level' => SkillLevel::Experienced],
                ['name' => 'AI Agent Design', 'level' => SkillLevel::HighlyExperienced],
            ]],
            ['name' => 'Software Architecture', 'slug' => 'architecture', 'icon' => 'rectangle-group', 'sort_order' => 5, 'skills' => [
                ['name' => 'Web Application Architecture', 'level' => SkillLevel::Advanced],
                ['name' => 'Modular Monolith', 'level' => SkillLevel::Advanced],
                ['name' => 'API Architecture', 'level' => SkillLevel::Advanced],
                ['name' => 'SOLID Principles', 'level' => SkillLevel::Advanced],
                ['name' => 'Design Patterns', 'level' => SkillLevel::Advanced],
                ['name' => 'Database Design', 'level' => SkillLevel::Advanced],
                ['name' => 'Security Architecture', 'level' => SkillLevel::HighlyExperienced],
            ]],
            ['name' => 'DevOps & Infrastructure', 'slug' => 'devops', 'icon' => 'cog-6-tooth', 'sort_order' => 6, 'skills' => [
                ['name' => 'Linux Server Administration', 'level' => SkillLevel::Advanced],
                ['name' => 'Docker', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'GitHub Actions / CI/CD', 'level' => SkillLevel::HighlyExperienced],
                ['name' => 'Nginx / Apache', 'level' => SkillLevel::Advanced],
                ['name' => 'SSL/TLS', 'level' => SkillLevel::Advanced],
                ['name' => 'DNS Management', 'level' => SkillLevel::Advanced],
                ['name' => 'Server Hardening', 'level' => SkillLevel::HighlyExperienced],
            ]],
            ['name' => 'Web Hosting Management', 'slug' => 'web-hosting', 'icon' => 'globe-alt', 'sort_order' => 7, 'skills' => [
                ['name' => 'cPanel / WHM', 'level' => SkillLevel::Advanced],
                ['name' => 'DirectAdmin', 'level' => SkillLevel::Advanced],
                ['name' => 'Reseller Hosting', 'level' => SkillLevel::Advanced],
                ['name' => 'Domain Management', 'level' => SkillLevel::Advanced],
                ['name' => 'Email Hosting', 'level' => SkillLevel::Advanced],
                ['name' => 'SSL Certificate Management', 'level' => SkillLevel::Advanced],
                ['name' => 'Website Migration', 'level' => SkillLevel::Advanced],
            ]],
        ];

        foreach ($categories as $catData) {
            $skills = $catData['skills'];
            unset($catData['skills']);

            $category = SkillCategory::updateOrCreate(['slug' => $catData['slug']], $catData);

            foreach ($skills as $index => $skillData) {
                Skill::updateOrCreate(
                    ['skill_category_id' => $category->id, 'name' => $skillData['name']],
                    ['level' => $skillData['level'], 'sort_order' => $index],
                );
            }
        }
    }

    private function seedExperience(): void
    {
        $entries = [
            [
                'title' => 'Senior Full-Stack Developer & Software Architect',
                'organisation' => 'JethroTech',
                'location' => 'Port Moresby, Papua New Guinea',
                'start_date' => '2018-01-01',
                'end_date' => null,
                'is_current' => true,
                'description' => 'Lead architect and senior developer responsible for the design, development and deployment of enterprise web applications. Manage web hosting infrastructure, Linux servers and CI/CD pipelines. Spearhead the adoption of AI-assisted development practices using the Laravel AI SDK.',
                'achievements' => 'Built a unified customer hosting portal integrating cPanel/WHM and Upmind billing APIs. Designed and delivered a full ERP platform supporting multiple business domains. Introduced controlled agentic development workflows using Claude Code and GitHub Copilot.',
                'technologies' => 'Laravel, Livewire, MySQL, PHP, Docker, Linux, cPanel/WHM, GitHub Actions',
                'sort_order' => 1,
            ],
            [
                'title' => 'Web Developer & Hosting Administrator',
                'organisation' => 'Independent Consulting',
                'location' => 'Papua New Guinea',
                'start_date' => '2012-01-01',
                'end_date' => '2017-12-31',
                'is_current' => false,
                'description' => 'Delivered custom web applications and provided web hosting management services for clients across Papua New Guinea. Managed shared and reseller hosting environments, DNS, email hosting and SSL configurations.',
                'achievements' => 'Migrated multiple client sites to managed hosting platforms with zero downtime. Configured and hardened Linux web servers for production use. Delivered custom CMS and business management systems for PNG-based organisations.',
                'technologies' => 'PHP, MySQL, HTML, CSS, JavaScript, cPanel, Linux, Apache',
                'sort_order' => 2,
            ],
        ];

        foreach ($entries as $entry) {
            Experience::updateOrCreate(
                ['title' => $entry['title'], 'organisation' => $entry['organisation']],
                $entry,
            );
        }
    }

    private function seedProjects(): void
    {
        $categories = [
            ['name' => 'Laravel', 'slug' => 'laravel', 'color' => '#FF2D20', 'sort_order' => 1],
            ['name' => 'AI Applications', 'slug' => 'ai-applications', 'color' => '#800080', 'sort_order' => 2],
            ['name' => 'Business Systems', 'slug' => 'business-systems', 'color' => '#1D4ED8', 'sort_order' => 3],
            ['name' => 'Web Hosting', 'slug' => 'web-hosting', 'color' => '#059669', 'sort_order' => 4],
            ['name' => 'Legal Technology', 'slug' => 'legal-technology', 'color' => '#7C3AED', 'sort_order' => 5],
        ];

        $cats = [];
        foreach ($categories as $cat) {
            $cats[$cat['slug']] = ProjectCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        $techs = ['Laravel', 'Livewire', 'MySQL', 'PHP', 'Docker', 'Linux', 'AI SDK', 'RAG', 'Vector Search', 'cPanel/WHM', 'Upmind API', 'GitHub Actions'];
        $techModels = [];
        foreach ($techs as $tech) {
            $techModels[$tech] = Technology::updateOrCreate(
                ['slug' => Str::slug($tech)],
                ['name' => $tech, 'slug' => Str::slug($tech)],
            );
        }

        $projects = [
            [
                'name' => 'JethroTech Client Portal',
                'slug' => 'jethrotech-client-portal',
                'project_category_id' => $cats['web-hosting']->id,
                'short_description' => 'A unified web hosting customer portal integrating cPanel/WHM and Upmind billing for self-service account management.',
                'full_description' => "The JethroTech Client Portal is a secure, full-featured web hosting customer portal that gives customers unified access to their hosting accounts, domain management, billing, and support — all within a single, professionally designed interface.\n\nThe platform integrates directly with the cPanel/WHM API for real-time account data and the Upmind billing and provisioning platform for subscription management, invoicing and automated provisioning.",
                'challenge' => 'Customers were managing hosting accounts, billing, and support through separate, disconnected tools, resulting in a poor user experience and high support overhead.',
                'solution' => 'Built a unified Laravel portal that integrates cPanel/WHM and Upmind APIs, presenting all hosting account data, billing information and support requests through a single authenticated interface.',
                'key_features' => "- Real-time cPanel account statistics\n- Domain and DNS management\n- SSL certificate management\n- Billing and invoice management via Upmind API\n- Automated hosting provisioning\n- Support ticket system\n- Queue-driven background synchronisation",
                'architecture_summary' => 'Modular Laravel monolith with dedicated service classes for each API integration. Queue workers handle background synchronisation and webhook processing. Livewire provides reactive UI without a full JavaScript framework.',
                'responsibilities' => 'Full system architecture, backend API integration, Livewire frontend, queue configuration, Linux deployment and ongoing maintenance.',
                'status' => ProjectStatus::Published,
                'is_featured' => true,
                'is_demo' => false,
                'technologies' => ['Laravel', 'Livewire', 'MySQL', 'PHP', 'cPanel/WHM', 'Upmind API'],
                'sort_order' => 1,
                'published_at' => now(),
            ],
            [
                'name' => 'JethroTech ERP',
                'slug' => 'jethrotech-erp',
                'project_category_id' => $cats['business-systems']->id,
                'short_description' => 'An enterprise resource planning platform supporting HR, recruitment, inventory, finance, sales and analytics for a PNG-based technology company.',
                'full_description' => "The JethroTech ERP is a comprehensive enterprise resource planning platform built to support the full operations of a Papua New Guinea–based technology and hosting company.\n\nThe platform covers multiple business domains including employee management, recruitment, leave and attendance, inventory, purchasing, sales, customer relationship management, supplier management, financial reporting and executive analytics.",
                'challenge' => 'Business operations were managed across disconnected spreadsheets and standalone tools, making reporting, approvals and cross-department coordination slow and error-prone.',
                'solution' => 'Designed and built a modular Laravel ERP that unifies all business domains under a single role-based platform, with structured workflows, approval chains and real-time reporting dashboards.',
                'key_features' => "- Role-based access control across all modules\n- Employee and HR management\n- Recruitment pipeline\n- Inventory and purchasing\n- Sales and CRM\n- Financial reporting and dashboards\n- AI-assisted report generation via Laravel AI SDK\n- Audit trails and approval workflows",
                'architecture_summary' => 'Domain-driven modular monolith with separate service layers per business domain. Laravel policies enforce authorization throughout. AI-assisted features use the Laravel AI SDK for report summarisation and data insights.',
                'responsibilities' => 'System architecture, all backend development, Livewire frontend components, role-based access control design, AI feature integration, deployment and maintenance.',
                'status' => ProjectStatus::Published,
                'is_featured' => true,
                'is_demo' => false,
                'technologies' => ['Laravel', 'Livewire', 'MySQL', 'PHP', 'AI SDK'],
                'sort_order' => 2,
                'published_at' => now(),
            ],
            [
                'name' => 'LaxPNG Legal Research Platform',
                'slug' => 'laxpng-legal-research-platform',
                'project_category_id' => $cats['legal-technology']->id,
                'short_description' => 'An AI-assisted legal research platform for Papua New Guinea legislation, case law, and contract analysis with traceable citations.',
                'full_description' => "LaxPNG is an AI-assisted legal research platform designed specifically for the Papua New Guinea legal environment. The platform provides legal professionals, government departments and organisations with fast, accurate access to PNG legislation, case law and legal documents.\n\nThe platform uses retrieval-augmented generation (RAG) to ground AI responses in verified legal sources, ensuring that every answer includes traceable citations to the original legislation or case judgment. This eliminates the hallucination risk common in general-purpose AI models when applied to specialist legal research.",
                'challenge' => 'Legal professionals in Papua New Guinea lack fast, reliable digital access to PNG-specific legislation and case law. General AI models cannot reliably answer PNG law questions without hallucinating citations.',
                'solution' => 'Built a RAG-based AI legal research platform that retrieves verified PNG legal documents from a vector store before generating answers, ensuring all citations are traceable to real sources.',
                'key_features' => "- AI-assisted legal research with source citations\n- PNG legislation and case law database\n- Vector search for semantic document retrieval\n- Contract analysis and clause extraction\n- Citation verification and traceability\n- Secure document upload and indexing\n- Multi-user access with role-based permissions\n- Audit log of all research queries",
                'architecture_summary' => 'Laravel backend with Laravel AI SDK for agent orchestration. Documents are indexed into a vector store for semantic retrieval. RAG pipeline grounds all AI responses in verified source documents. Livewire provides the research interface.',
                'responsibilities' => 'Full system design, RAG pipeline architecture, vector store integration, Laravel AI SDK agent configuration, UI development, security and deployment.',
                'status' => ProjectStatus::Published,
                'is_featured' => true,
                'is_demo' => true,
                'technologies' => ['Laravel', 'Livewire', 'MySQL', 'AI SDK', 'RAG', 'Vector Search'],
                'sort_order' => 3,
                'published_at' => now(),
            ],
        ];

        foreach ($projects as $projectData) {
            $techNames = $projectData['technologies'];
            unset($projectData['technologies']);

            $project = Project::updateOrCreate(['slug' => $projectData['slug']], $projectData);

            $techIds = array_filter(
                array_map(fn ($name) => $techModels[$name]?->id ?? null, $techNames),
            );
            $project->technologies()->sync($techIds);
        }
    }

    private function seedServices(): void
    {
        $services = [
            ['title' => 'Laravel Application Development', 'description' => 'Custom web application development using Laravel 13, Livewire and MySQL. From API backends to full-stack applications.', 'icon' => 'code-bracket', 'sort_order' => 1],
            ['title' => 'AI-Enabled Web Applications', 'description' => 'Integrate AI capabilities into your web applications using the Laravel AI SDK, Claude, GPT, Gemini and open-source models.', 'icon' => 'cpu-chip', 'sort_order' => 2],
            ['title' => 'Software Architecture', 'description' => 'Define your application architecture, data model, security design and technology decisions before writing a single line of code.', 'icon' => 'rectangle-group', 'sort_order' => 3],
            ['title' => 'DevOps & CI/CD', 'description' => 'Set up Linux servers, Docker environments, GitHub Actions pipelines and automated deployment workflows.', 'icon' => 'cog-6-tooth', 'sort_order' => 4],
            ['title' => 'Web Hosting Management', 'description' => 'cPanel, WHM, DirectAdmin — setup, migration, security hardening and ongoing management for shared and reseller hosting.', 'icon' => 'globe-alt', 'sort_order' => 5],
            ['title' => 'Technical Consultation', 'description' => 'Architecture reviews, technology selection, team mentoring, and technical due diligence for software projects.', 'icon' => 'chat-bubble-left-right', 'sort_order' => 6],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }
    }

    private function seedSocialLinks(): void
    {
        $links = [
            ['platform' => 'GitHub', 'url' => config('portfolio.github'), 'icon' => 'github', 'sort_order' => 1],
            ['platform' => 'LinkedIn', 'url' => config('portfolio.linkedin'), 'icon' => 'linkedin', 'sort_order' => 2],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(['platform' => $link['platform']], $link);
        }
    }

    private function seedSettings(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Mark Johnnah', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Full-Stack Laravel Developer, Software Architect and AI-Assisted Development Engineer', 'type' => 'string', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => config('portfolio.contact_email'), 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => config('portfolio.phone'), 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_location', 'value' => config('portfolio.location'), 'type' => 'string', 'group' => 'contact'],
            ['key' => 'meta_description', 'value' => 'Mark Johnnah is a senior full-stack Laravel developer, software architect and AI-assisted development engineer based in Papua New Guinea with more than 15 years of experience.', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'ai_help_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'features'],
        ];

        foreach ($settings as $setting) {
            WebsiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}

