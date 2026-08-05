<?php

namespace App\Enums;

enum EnquiryType: string
{
    case Employment = 'employment';
    case LaravelDevelopment = 'laravel_development';
    case AiDevelopment = 'ai_development';
    case SoftwareArchitecture = 'software_architecture';
    case DevOps = 'devops';
    case WebHosting = 'web_hosting';
    case SystemIntegration = 'system_integration';
    case GeneralEnquiry = 'general_enquiry';

    public function label(): string
    {
        return match ($this) {
            self::Employment => 'Employment Opportunity',
            self::LaravelDevelopment => 'Laravel Development',
            self::AiDevelopment => 'AI Application Development',
            self::SoftwareArchitecture => 'Software Architecture',
            self::DevOps => 'DevOps Consulting',
            self::WebHosting => 'Web Hosting Consulting',
            self::SystemIntegration => 'System Integration',
            self::GeneralEnquiry => 'General Enquiry',
        };
    }
}
