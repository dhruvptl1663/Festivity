<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    main {
        flex: 1;
        padding: 20px;
    }
    footer {
        background-color:grey;
        color: #fff;
        padding: 40px 20px;
        position: relative;

        animation: fadeIn 2s ease-in-out;
    }
    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

        margin: 0 auto;
    }
    .footer-section {
        flex: 1;
        min-width: 250px;
        margin: 10px;
        animation: slideIn 1s ease-in-out;
    }
    .footer-section h3 {
        border-bottom: 2px solid #fff;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    .social-media a {
        margin: 0 10px;
        color: #fff;
        text-decoration: none;
        font-size: 1.5em;
        transition: color 0.3s;
    }
    .social-media a:hover {
        color: #1da1f2;
    }
    .map-container {
    
        height: 200px;
        margin-top: 20px;
    }
    .newsletter input[type="email"] {
        padding: 10px;
        width: calc(100% - 22px);
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
    }
    .newsletter button {
        padding: 10px 20px;
        background-color: #555;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .newsletter button:hover {
        background-color: #777;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<main>
    <!-- Main content of the page -->
    <h1></h1>
    <p></p>
</main>

<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3>About Us</h3>
            <p>We are a leading company in our industry, committed to providing top-notch services and products to our clients worldwide.</p>
        </div>
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p>Email: info@yourcompany.com</p>
            <p>Phone: +1 (555) 123-4567</p>
            <div class="social-media">
                <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="footer-section">
            <h3>Visit Us</h3>
            <div class="map-container">
                <iframe
                    width="100%"
                    height="100%"
                    frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3169.019984282839!2d-122.0842496846923!3d37.42206597982571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb24c2f2b9e3b%3A0x2b0b7e1b2b0b7e1b!2sGoogleplex!5e0!3m2!1sen!2sus!4v1600000000000!5m2!1sen!2sus" allowfullscreen>
                </iframe>
            </div>
        </div>
        <div class="footer-section newsletter">
            <img width="Auto" height="Auto" alt="Logo"
            src="assets/Images/Brand/main_logo_small.png" loading="eager" class="logo"></a>
            <p>Subscribe to our newsletter to stay updated on our latest news and offers.</p>
            <input type="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
        </div>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <p>&copy; <span id="year"></span> Your Company Name. All rights reserved.</p>
    </div>
</footer>