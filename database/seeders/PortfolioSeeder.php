<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutMe;
use App\Models\Project;
use App\Models\Skill;
use App\Models\MethodologyStep;
use App\Models\SiteSetting;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. About Me
        AboutMe::updateOrCreate(['id' => 1], [
            'name' => 'John Doe',
            'title' => 'Senior Product Designer & Fullstack Developer',
            'tagline' => 'I build digital products with a human-centered soul.',
            'bio' => 'I’m John, a UI/UX Designer and Web Developer who believes that technology should be invisible—allowing the user\'s goals and experiences to take center stage.',
            'location' => 'Berlin, DE',
            'profile_image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCmWtgKz3_0ADnhrbHCk4yL9cWmzAaVbQO8PRvo28ASHwNzUvr-rJAbDFW5VyPpXich7jNPOcjnEZWtXXpmbrcnvP61jgMu7sAI187l7d468Owo3qFTVVxT6BOCcqySTHdG1Ppt0K7R3-ScABka-DZ-69cQY5eDX_xV5AOoohAnkH1pmf3Jiqh2szogsThYIIMCvZUmsYsS5GjKZk5-0I9AG5h-wkW0tcuJQRbUi_KP3XQSQUcYAcPWtJ6wWOipAl4Ow-vlNzdDQTrz',
            'linkedin_url' => 'https://linkedin.com/in/johndoe',
            'github_url' => 'https://github.com/johndoe',
            'dribbble_url' => 'https://dribbble.com/johndoe',
            'story_text' => 'My journey didn\'t start with code. It started with a fascination for how people interact with physical objects. I spent my early years studying industrial design, which taught me the importance of ergonomics, accessibility, and the tactile nature of utility. When I transitioned into the digital realm, I brought that "physicality" with me.',
            'philosophy_text' => 'I believe in the "Logic-First" approach: great design is born from understanding the data, the constraints, and the \'why\' before we ever touch a canvas.',
            'hero_heading' => 'Programmer | Web Development',
            'hero_subheading' => 'UI/UX Design | Fullstack Development',
            'stats_projects' => '50+',
            'stats_experience' => '6thn',
            'stats_satisfaction' => '100%',
            'philosophies' => [
                [
                    'title' => 'Form Follows Function',
                    'description' => 'Aesthetics are the bridge, but usability is the destination. I never prioritize \'pretty\' over \'practical\'.',
                    'icon' => 'balance'
                ],
                [
                    'title' => 'Clean Code is Design',
                    'description' => 'The back-end architecture is just as important as the front-end UI for a truly seamless user experience.',
                    'icon' => 'code_blocks'
                ]
            ],
            'tools' => ['Figma', 'React', 'Laravel', 'Tailwind', 'Flutter', 'Adobe CC'],
            'experiences' => [
                [
                    'period' => '2021 — Present',
                    'title' => 'Senior Product Designer',
                    'company' => 'TechFlow Solutions',
                    'description' => 'Leading the design system team for enterprise SaaS products, impacting over 500k active users.',
                    'is_current' => true
                ],
                [
                    'period' => '2018 — 2021',
                    'title' => 'Full-Stack Developer',
                    'company' => 'CreativePulse Agency',
                    'description' => 'Bridge role between design and engineering, specializing in React and Laravel ecosystems.',
                    'is_current' => false
                ],
                [
                    'period' => '2017 — 2018',
                    'title' => 'Junior UI Designer',
                    'company' => 'Stellar Startups',
                    'description' => 'Rapid prototyping and visual design for mobile-first consumer applications.',
                    'is_current' => false
                ]
            ],
            'educations' => [
                [
                    'icon' => 'school',
                    'degree' => 'B.S. Interaction Design',
                    'institution' => 'University of Arts & Design, 2017'
                ],
                [
                    'icon' => 'verified',
                    'degree' => 'Advanced Full Stack Certificate',
                    'institution' => 'Global Dev Academy, 2019'
                ]
            ],
            'cv_url' => '#',
            'secondary_badge' => 'Remote Enthusiast'
        ]);

        // 2. Methodology Steps
        $steps = [
            [
                'phase_number' => 1,
                'title' => 'Situation / Research',
                'description' => 'Every great project starts with deep diving into the context. I conduct stakeholder interviews, user research, and competitor analysis to map out the current landscape and identify friction points.',
                'icon' => 'search',
                'sort_order' => 1
            ],
            [
                'phase_number' => 2,
                'title' => 'Task / Strategy',
                'description' => 'Defining the goals and scope. I translate research findings into actionable tasks, defining the information architecture and creating wireframes that serve as the blueprint for the solution.',
                'icon' => 'architecture',
                'sort_order' => 2
            ],
            [
                'phase_number' => 3,
                'title' => 'Action / Design & Dev',
                'description' => 'This is where the magic happens. I bridge the gap between Figma and VS Code, crafting high-fidelity interfaces and building them with clean, scalable, and responsive code using modern tech stacks.',
                'icon' => 'code',
                'sort_order' => 3
            ],
            [
                'phase_number' => 4,
                'title' => 'Result / Delivery',
                'description' => 'Success is measured by impact. I track KPIs, gather post-launch feedback, and ensure the project meets its intended goals—whether it\'s increased conversion rates or improved user efficiency.',
                'icon' => 'trending_up',
                'sort_order' => 4
            ]
        ];

        foreach ($steps as $step) {
            MethodologyStep::updateOrCreate(['phase_number' => $step['phase_number']], $step);
        }

        // 3. Projects
        $projects = [
            [
                'title' => 'FinTrack Pro: Enterprise SaaS',
                'client_name' => 'FinTech Global',
                'category' => 'ui-ux development saas',
                'tags' => ['UI/UX Design', 'Frontend Dev'],
                'role' => 'Lead Product Designer',
                'tools' => 'Figma, React, Tailwind',
                'problem_text' => 'Sistem lama yang terfragmentasi menyebabkan tingkat kesalahan 30% dalam pelaporan triwulanan bagi klien perusahaan.',
                'solution_text' => 'Mesin visualisasi data terpadu dengan rekonsiliasi otomatis, mengurangi input manual sebesar 60%.',
                'situation_text' => 'Users struggled with fragmented data across 5 different legacy tools.',
                'task_text' => 'Consolidate all financial data into a single, cohesive central dashboard.',
                'action_text' => 'Implemented a new data architecture and redesigned the interface for clarity.',
                'result_text' => '40% reduction in data entry time and improved user satisfaction.',
                'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCYGmQeMWs2u8n4QejgWCNR7zywHwTqfXATNuFsGLGBVxSxD8PRZHp9z3jSCS4P0PtSzAJragAGXcx_u9Lt5F7Z23aftuO5QQM7hdyl_zC0071WUHMO0NzMoK1M_sMHD8kYNf-AR0-eRT56xwRt22MPc3lNVjS8iNTM_K3sRDGtJgOn39tdKJ-uAGsk5-lQ679FYRESbAj2UbEcFeDf_J9lOzPtJVetIw9vB4G-5WVSzWShYXs9MguUCZQ6irFY7YwzQjhaQjNgGeD2',
                'live_link' => '#',
                'sort_order' => 1,
                'is_featured' => true,
                'status' => 'completed',
                'year' => '2023'
            ],
            [
                'title' => 'VitalPulse: Remote Patient Care',
                'client_name' => 'HealthCare Innovations',
                'category' => 'ui-ux development',
                'tags' => ['Mobile App', 'HealthTech'],
                'role' => 'UX Lead / Flutter Dev',
                'tools' => 'Flutter, Firebase, Figma',
                'problem_text' => 'Tingkat penerimaan kembali yang tinggi bagi pasien lanjut usia karena pemantauan pasca operasi yang tidak konsisten.',
                'solution_text' => 'Antarmuka seluler yang disederhanakan dengan sinkronisasi biometrik waktu nyata dan obrolan perawat-ke-pasien langsung.',
                'situation_text' => 'High re-admission rates for elderly patients due to inconsistent post-surgery monitoring.',
                'task_text' => 'Create a mobile interface for real-time monitoring.',
                'action_text' => 'Simplified the UI and added biometric syncing.',
                'result_text' => 'Significant reduction in patient re-admission rate.',
                'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwXyAvUTt_bHQ_TTZiCe3SqkZLLuofiKlkgE6tPw4wsBrQQYsuxDkD2fYhUyqMOwBQWMxarklzzC7723eTdDa02m6h6CEmxwBsdPVDwYZ49SAbzZtairDREJVz9TsrwF9J4zhcXWtm56L4jh_xrW9t4UZ0AppzSGV1mvLdglESc1iArikYAyc-quAPFQDAqQKF63VEx9dWGrb-e3SEGWou7g-JjyrY2BqVC0u5BnWOMqLD3wZGAoiTrggpD5xSMl-vPdTgkXLwvdvd',
                'live_link' => '#',
                'sort_order' => 2,
                'is_featured' => true,
                'status' => 'completed',
                'year' => '2023'
            ],
            [
                'title' => 'StoreSync: Inventory OS',
                'client_name' => 'RetailPro Solutions',
                'category' => 'development saas',
                'tags' => ['Web App', 'E-commerce'],
                'role' => 'Full Stack Engineer',
                'tools' => 'Laravel, React, AWS',
                'problem_text' => 'Penjual multi-saluran kehilangan 15% pendapatan tahunan karena kehabisan stok di berbagai pasar.',
                'solution_text' => 'Mesin sinkronisasi inventaris omni-channel dengan AI prediktif untuk meramalkan kebutuhan stok.',
                'situation_text' => 'Multi-channel sellers losing 15% revenue annually due to stock-outs.',
                'task_text' => 'Develop an omni-channel inventory sync engine.',
                'action_text' => 'Implemented AI predictive forecasting and inventory sync.',
                'result_text' => '15% recovery in annual revenue for key sellers.',
                'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCYGmQeMWs2u8n4QejgWCNR7zywHwTqfXATNuFsGLGBVxSxD8PRZHp9z3jSCS4P0PtSzAJragAGXcx_u9Lt5F7Z23aftuO5QQM7hdyl_zC0071WUHMO0NzMoK1M_sMHD8kYNf-AR0-eRT56xwRt22MPc3lNVjS8iNTM_K3sRDGtJgOn39tdKJ-uAGsk5-lQ679FYRESbAj2UbEcFeDf_J9lOzPtJVetIw9vB4G-5WVSzWShYXs9MguUCZQ6irFY7YwzQjhaQjNgGeD2',
                'live_link' => '#',
                'sort_order' => 3,
                'is_featured' => true,
                'status' => 'completed',
                'year' => '2024'
            ]
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['title' => $project['title']], $project);
        }

        // 4. Skills
        $skills = [
            ['name' => 'Laravel', 'category' => 'Backend', 'proficiency' => 95, 'icon' => 'code', 'is_active' => true, 'description' => 'Core business logic and API orchestration.'],
            ['name' => 'React', 'category' => 'Frontend', 'proficiency' => 90, 'icon' => 'data_object', 'is_active' => true, 'description' => 'Iterative design & rapid prototyping.'],
            ['name' => 'Figma', 'category' => 'Design', 'proficiency' => 98, 'icon' => 'brush', 'is_active' => true, 'description' => 'User psychology & business goal alignment.'],
            ['name' => 'Flutter', 'category' => 'Mobile', 'proficiency' => 85, 'icon' => 'smartphone', 'is_active' => true, 'description' => 'Cross-platform mobile development.'],
            ['name' => 'Python', 'category' => 'Data', 'proficiency' => 80, 'icon' => 'terminal', 'is_active' => true, 'description' => 'Automation & data analysis.'],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'proficiency' => 96, 'icon' => 'css', 'is_active' => true, 'description' => 'Utility-first rapid styling.'],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }

        // 5. Site Settings
        $settings = [
            'site_name' => 'AndrewPrince.dev',
            'site_title' => 'AndrewPrince | Process-Driven Portfolio',
            'site_tagline' => 'Bridging the gap between complex problems and elegant digital solutions.',
            'contact_email' => 'admin@admin.com',
            'social_links' => json_encode([
                ['name' => 'LinkedIn', 'url' => 'https://linkedin.com/in/johndoe'],
                ['name' => 'GitHub', 'url' => 'https://github.com/johndoe'],
                ['name' => 'Dribbble', 'url' => 'https://dribbble.com/johndoe'],
            ]),
            'maintenance_mode' => '0',
            'footer_text' => 'Built with logic and precision.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }
}
