    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-links">
                    <h5>Về chúng tôi</h5>
                    <p><?php echo $settings['site_description']; ?></p>
                </div>
                <div class="footer-links">
                    <h5>Liên hệ</h5>
                    <ul>
                        <li><i class="fas fa-envelope"></i> <?php echo $settings['contact_email']; ?></li>
                        <li><i class="fas fa-phone"></i> <?php echo $settings['contact_phone']; ?></li>
                        <li><i class="fas fa-map-marker-alt"></i> <?php echo $settings['contact_address']; ?></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h5>Theo dõi chúng tôi</h5>
                    <ul class="social-links">
                        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $settings['site_name']; ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html> 