<?php
/**
 * About Us page template
 *
 * @package Panna_Wild_Tour
 */

get_header();
?>
<main id="content" class="site-main site-wrapper page-about">
    <section class="section">
        <div class="section-header">
            <h1>About Panna Wild Tour</h1>
            <p>We are nature lovers who organised Panna Wild Tour to help travellers experience the Panna jungles without the hassle of booking logistics. From tickets and transport to guided safaris and cultural visits — we arrange everything so you can focus on the wild.</p>
        </div>

        <div class="about-grid">
            <div class="about-content">
                <h2>Why we are here</h2>
                <p>We offer customised services and keep our promises. Pour your expectations on us — we will arrange everything possible, right from ticket booking to local cultural visits.</p>

                <h3>Our Mission</h3>
                <p>We help with ticket bookings, vehicle bookings, local sightseeing and provide on-the-ground support to ensure safe, memorable wildlife experiences around Panna.</p>

                <h3>What we target</h3>
                <p>To deliver authentic, responsible and well-organised tours that connect visitors to Panna's flora, fauna, culture and history.</p>
            </div>

            <aside class="team-card">
                <h2>Meet Our Team</h2>
                <div class="team-member">
                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/person-1.jpg' ) ); ?>" alt="Lakhan Lal" />
                    <div class="meta"><strong>Lakhan Lal</strong><span>Trip Advisor</span><p>Lakhan helps with local arrangements and has deep knowledge of the jungle routes.</p></div>
                </div>
                <div class="team-member">
                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/person-2.jpg' ) ); ?>" alt="Rajeshwari" />
                    <div class="meta"><strong>Rajeshwari</strong><span>Financial Advisor</span><p>Rajeshwari manages payments and packages to keep your trip smooth.</p></div>
                </div>
                <div class="team-member">
                    <img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/person-3.jpg' ) ); ?>" alt="Anshuman" />
                    <div class="meta"><strong>Anshuman</strong><span>Lodging & Boarding Advisor</span><p>Anshuman coordinates accommodation and local hospitality for every group.</p></div>
                </div>
            </aside>
        </div>

        <div class="contact-cta">
            <h3>Send Us a Message</h3>
            <p>Though we are always available on the contact numbers provided, you can submit a message and we will respond ASAP.</p>
            <a class="button" href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact-us' ) ) ?: home_url( '/contact-us/' ) ); ?>">Contact Us</a>
        </div>
    </section>
</main>
<?php get_footer();
