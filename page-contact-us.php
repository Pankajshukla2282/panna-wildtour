<?php
/**
 * Contact Us page template
 *
 * @package Panna_Wild_Tour
 */

get_header();
?>
<main id="content" class="site-main site-wrapper page-contact">
    <section class="section">
        <div class="section-header">
            <h1>Contact Us</h1>
            <p>Have any query? We are here — reach out and we'll respond as soon as possible.</p>
        </div>

        <div class="contact-grid">
            <div class="contact-info">
                <h2>We're Here</h2>
                <p>Panna Wild Tour Pvt Ltd.<br>
                Panna-Khajuraho road, Near Madla safari gate, Madla, Panna, Madhya Pradesh, India</p>

                <p><strong>Phone:</strong> +91 9876543210<br>
                <strong>Email:</strong> <a href="mailto:Support@pannawildtour.com">Support@pannawildtour.com</a></p>

                <div class="social-links">
                    <a href="#">Facebook</a> · <a href="#">Twitter</a> · <a href="#">Instagram</a>
                </div>
            </div>

            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <input type="hidden" name="action" value="pwt_submit_contact" />
                    <p><label>Name<br><input type="text" name="name" required></label></p>
                    <p><label>Email<br><input type="email" name="email" required></label></p>
                    <p><label>Message<br><textarea name="message" rows="6" required></textarea></label></p>
                    <p><button class="button" type="submit">Submit Message</button></p>
                </form>
            </div>
        </div>
    </section>
</main>
<?php get_footer();
