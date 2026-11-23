
<nav class="navbar" id="navbar">
    <div class="container nav-container">

        <a href="{{ route('home') }}" class="brand">
            DS<span>.</span>
        </a>

        <button class="menu-toggle" id="menuToggle"
                aria-label="Toggle navigation"
                aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-links" id="navLinks">
            <a href="#home" class="nav-link active">Home</a>
            <a href="#about" class="nav-link">About</a>
            <a href="#skills" class="nav-link">Skills</a>
            <a href="#projects" class="nav-link">Projects</a>
            <a href="#experience" class="nav-link">Experience</a>
            <a href="#contact" class="nav-link">Contact</a>

            <a href="#contact" class="btn btn-small">
                Let's Talk <i class="fas fa-arrow-up-right-from-square"></i>
            </a>
        </div>

    </div>
</nav>
