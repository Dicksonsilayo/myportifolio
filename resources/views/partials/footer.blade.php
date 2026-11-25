<footer class="footer">
    <div class="container footer-content">

        <a href="{{ route('home') }}" class="brand">
            DS<span>.</span>
        </a>

        <p>
            Building digital solutions with creativity and technology.
        </p>

        <div class="social-links">
            <a href="https://github.com/DicksonSilayo"
               target="_blank"
               rel="noopener noreferrer"
               aria-label="GitHub">
                <i class="fab fa-github"></i>
            </a>
        </div>

        <div class="footer-bottom">

            <p>
                &copy; {{ date('Y') }} Dickson Silayo.
                All rights reserved.
            </p>

            <div class="footer-bottom-links">

                <a href="#home">Back to top ↑</a>

                <a href="{{ route('admin.login') }}"
                   class="admin-login-link">
                    <i class="fas fa-lock"></i>
                    Admin Login
                </a>

            </div>

        </div>

    </div>
</footer>