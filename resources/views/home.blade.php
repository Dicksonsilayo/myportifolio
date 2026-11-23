
@extends('layouts.app')

@section('title', 'Dickson Silayo | Software Developer')
@section('description', 'Explore the portfolio of Dickson Silayo, a software developer and IT professional based in Tanzania.')

@section('content')

{{-- HERO SECTION --}}
<section class="hero-section" id="home">
    <div class="hero-glow"></div>

    <div class="container hero-container">

        <div class="hero-content">

            <div class="availability">
                <span class="status-dot"></span>
                Open to opportunities
            </div>

            <p class="hero-greeting">HELLO, I'M</p>

            <h1>
                Dickson <span>Silayo.</span>
            </h1>

            <h2>
                I build <span class="gradient-text">digital solutions</span>
                that make a difference.
            </h2>

            <p class="hero-description">
                I'm a Computer Science professional passionate about
                software development, web technologies, system
                administration and building innovative solutions
                to real-world problems.
            </p>

            <div class="hero-buttons">
                <a href="#projects" class="btn">
                    Explore My Work
                    <i class="fas fa-arrow-right"></i>
                </a>

                <a href="#contact" class="btn btn-outline">
                    Get In Touch
                </a>
            </div>

            <div class="hero-socials">
                <span>CONNECT WITH ME</span>

                <a href="https://github.com/disebene"
                   target="_blank" rel="noopener noreferrer"
                   aria-label="GitHub">
                    <i class="fab fa-github"></i>
                </a>

                <a href="mailto:YOUR_EMAIL@example.com"
                   aria-label="Email">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>

        </div>

        <div class="hero-visual">

            <div class="profile-card">

                <div class="profile-card-top">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="profile-avatar">
                    DS<span>.</span>
                </div>

                <h3>Dickson Silayo</h3>

                <p>Software Developer</p>

                <div class="profile-divider"></div>

                <div class="profile-info">
                    <div>
                        <i class="fas fa-location-dot"></i>
                        <span>Dar es Salaam, Tanzania</span>
                    </div>

                    <div>
                        <i class="fas fa-code"></i>
                        <span>Software Development</span>
                    </div>

                    <div>
                        <i class="fas fa-graduation-cap"></i>
                        <span>Computer Science</span>
                    </div>
                </div>

                <div class="floating-code">
                    <span>&lt;/&gt;</span>
                    Building the future
                </div>

            </div>

        </div>

    </div>

    <div class="scroll-indicator">
        <span></span>
        Scroll to explore
    </div>

</section>

{{-- ABOUT SECTION --}}
<section class="section about-section" id="about">

    <div class="container">

        <div class="section-heading">
            <span class="section-label">01 / ABOUT ME</span>
            <h2>Turning ideas into <span>reality.</span></h2>
        </div>

        <div class="about-grid">

            <div class="about-text">
                <h3>
                    Passionate about technology,
                    innovation and problem-solving.
                </h3>

                <p>
                    I am a Computer Science professional with a strong
                    interest in software engineering and information
                    technology.
                </p>

                <p>
                    My development journey involves designing and
                    building web applications, database-driven systems,
                    and practical software solutions that address
                    everyday challenges.
                </p>

                <p>
                    I enjoy learning new technologies, exploring
                    system administration and continuously improving
                    my technical skills.
                </p>

                <a href="#contact" class="text-link">
                    Let's work together
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="about-highlights">

                <div class="highlight-card">
                    <i class="fas fa-laptop-code"></i>
                    <h4>Software Development</h4>
                    <p>Building functional and user-friendly applications.</p>
                </div>

                <div class="highlight-card">
                    <i class="fas fa-database"></i>
                    <h4>Database Management</h4>
                    <p>Designing and managing structured databases.</p>
                </div>

                <div class="highlight-card">
                    <i class="fas fa-server"></i>
                    <h4>IT & Systems</h4>
                    <p>Exploring Linux, infrastructure and IT solutions.</p>
                </div>

                <div class="highlight-card">
                    <i class="fas fa-lightbulb"></i>
                    <h4>Problem Solving</h4>
                    <p>Turning technical challenges into solutions.</p>
                </div>

            </div>

        </div>

    </div>
</section>

{{-- SKILLS SECTION --}}
<section class="section skills-section" id="skills">

    <div class="container">

        <div class="section-heading">
            <span class="section-label">02 / TECHNICAL EXPERTISE</span>
            <h2>My technical <span>toolkit.</span></h2>
            <p>Technologies and tools I work with and continue to explore.</p>
        </div>

        <div class="skills-grid">

            @forelse($skills as $skill)

                <div class="skill-card">
                    <div class="skill-card-header">
                        <div class="skill-icon">
                            <i class="{{ $skill->icon ?: 'fas fa-code' }}"></i>
                        </div>

                        <span>{{ $skill->category }}</span>
                    </div>

                    <h4>{{ $skill->name }}</h4>

                    <div class="skill-progress">
                        <div class="skill-progress-fill"
                             style="width: {{ min(100, max(0, $skill->proficiency)) }}%">
                        </div>
                    </div>

                </div>

            @empty

                <p class="empty-message">
                    Skills will be added soon.
                </p>

            @endforelse

        </div>

    </div>
</section>

{{-- PROJECTS SECTION --}}
<section class="section projects-section" id="projects">

    <div class="container">

        <div class="section-heading">
            <span class="section-label">03 / SELECTED WORK</span>
            <h2>Projects I've <span>built.</span></h2>
            <p>Some of the applications and solutions I have worked on.</p>
        </div>

        <div class="projects-grid">

            @forelse($projects as $project)

                <article class="project-card">

                    <div class="project-image">

                        @if($project->image_path)
                            <img
                                src="{{ asset('storage/' . $project->image_path) }}"
                                alt="{{ $project->title }}"
                                loading="lazy">
                        @else
                            <div class="project-placeholder">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                        @endif

                        @if($project->is_featured)
                            <span class="featured-label">
                                Featured
                            </span>
                        @endif

                    </div>

                    <div class="project-content">

                        <span class="project-category">
                            {{ $project->category ?: 'Software Development' }}
                        </span>

                        <h3>{{ $project->title }}</h3>

                        <p>{{ $project->short_description }}</p>

                        <div class="project-links">

                            @if($project->github_url)
                                <a href="{{ $project->github_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    GitHub <i class="fab fa-github"></i>
                                </a>
                            @endif

                            @if($project->project_url)
                                <a href="{{ $project->project_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    Live Demo
                                    <i class="fas fa-arrow-up-right-from-square"></i>
                                </a>
                            @endif

                        </div>

                    </div>

                </article>

            @empty

                <div class="empty-message">
                    <i class="fas fa-folder-open"></i>
                    <h3>Projects coming soon</h3>
                    <p>My featured projects will appear here.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>

{{-- EXPERIENCE SECTION --}}
<section class="section experience-section" id="experience">

    <div class="container">

        <div class="section-heading">
            <span class="section-label">04 / MY JOURNEY</span>
            <h2>Professional <span>experience.</span></h2>
        </div>

        <div class="timeline">

            @forelse($experiences as $experience)

                <div class="timeline-item">

                    <div class="timeline-marker"></div>

                    <div class="timeline-content">

                        <span class="timeline-date">
                          {{ $experience->start_date?->format('Y') ?? 'Date to be confirmed' }}
                            -
                            {{ $experience->is_current
                                ? 'Present'
                                : ($experience->end_date?->format('Y') ?? 'Not specified') }}
                        </span>

                        <h3>{{ $experience->position }}</h3>

                        <h4>
                            {{ $experience->company }}
                            @if($experience->location)
                                · {{ $experience->location }}
                            @endif
                        </h4>

                        <p>{{ $experience->description }}</p>

                    </div>

                </div>

            @empty

                <p class="empty-message">
                    Professional experience will be displayed here.
                </p>

            @endforelse

        </div>

    </div>
</section>

{{-- EDUCATION SECTION --}}
<section class="section education-section" id="education">

    <div class="container">

        <div class="section-heading">
            <span class="section-label">05 / EDUCATION</span>
            <h2>Academic <span>background.</span></h2>
        </div>

        <div class="education-grid">

            @forelse($education as $item)

                <div class="education-card">

                    <i class="fas fa-graduation-cap"></i>

                    <h3>{{ $item->qualification }}</h3>

                    <h4>{{ $item->institution }}</h4>

                    <p>{{ $item->field_of_study }}</p>

                    @if($item->start_date || $item->end_date)
                        <span>
                            {{ $item->start_date?->format('Y') ?? '' }}
                            -
                            {{ $item->end_date?->format('Y') ?? 'Present' }}
                        </span>
                    @endif

                    <p>{{ $item->description }}</p>

                </div>

            @empty

                <p class="empty-message">
                    Education details will be displayed here.
                </p>

            @endforelse

        </div>

    </div>
</section>

{{-- CERTIFICATIONS SECTION --}}
<section class="section certifications-section" id="certifications">

    <div class="container">

        <div class="section-heading">
            <span class="section-label">06 / ACHIEVEMENTS</span>
            <h2>Certifications & <span>achievements.</span></h2>
        </div>

        <div class="certifications-grid">

            @forelse($certifications as $certification)

                <div class="certification-card">

                    <i class="fas fa-certificate"></i>

                    <h3>{{ $certification->name }}</h3>

                    <p>{{ $certification->issuing_organization }}</p>

                    @if($certification->issue_date)
                        <span>
                            {{ $certification->issue_date->format('M Y') }}
                        </span>
                    @endif

                    @if($certification->credential_url)
                        <a href="{{ $certification->credential_url }}"
                           target="_blank"
                           rel="noopener noreferrer">
                            View credential
                            <i class="fas fa-arrow-up-right-from-square"></i>
                        </a>
                    @endif

                </div>

            @empty

                <p class="empty-message">
                    Certifications will be displayed here.
                </p>

            @endforelse

        </div>

    </div>
</section>

{{-- CONTACT SECTION --}}
<section class="section contact-section" id="contact">

    <div class="container">

        <div class="contact-box">

            <span class="section-label">07 / GET IN TOUCH</span>

            <h2>
                Have a project in mind?
                <span>Let's talk.</span>
            </h2>

            <p>
                I'm interested in software development opportunities,
                collaborations and projects that create meaningful impact.
            </p>

            <a href="mailto:YOUR_EMAIL@example.com" class="btn">
                Send Me an Email
                <i class="fas fa-paper-plane"></i>
            </a>

            <div class="contact-socials">

                <a href="https://github.com/DicksonSilayo"
                   target="_blank"
                   rel="noopener noreferrer">
                    <i class="fab fa-github"></i>
                    GitHub
                </a>

                <a href="mailto:YOUR_EMAIL@example.com">
                    <i class="fas fa-envelope"></i>
                    Email
                </a>

            </div>

        </div>

    </div>
</section>

@endsection