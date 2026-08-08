# Gutenberg Page Blueprints (Production-Ready)

Use these as copy-paste structure guides when building pages in WordPress block editor.

## 1) Homepage Blueprint

1. Cover/Hero Block
- Eyebrow text
- H1 headline
- Supporting paragraph
- Buttons block (Book Now, Explore Packages)

2. Trust Metrics Section (Columns)
- 3 to 4 short trust points

3. Why Choose Us Section (Columns)
- 4 feature cards

4. Featured Packages Section
- Heading + short intro
- Shortcode block: [pwt_packages]

5. Testimonials Section
- Heading
- Shortcode block: [pwt_testimonials]

6. FAQ Section
- Heading
- Shortcode block: [pwt_faq]

7. Contact CTA Band
- Heading + short paragraph
- Button: Talk To Travel Team

8. Contact Card Section
- Shortcode block: [pwt_contact_card]

---

## 2) About Us Blueprint

1. Hero section with title and intro
2. Mission and values (2-column)
3. What we do (icon list)
4. Why travelers trust us (bullet list)
5. CTA strip to Contact page

---

## 3) Contact Us Blueprint

1. Title + quick help intro
2. 3-column contact cards (Call, WhatsApp, Email)
3. Booking help checklist section
4. Contact shortcode/card block
5. Final CTA button block

---

## 4) Package Detail Page Blueprint (for pwt_package)

1. Featured image
2. Title + summary
3. Meta chips (duration, days/nights, pricing)
4. Inclusions/Exclusions (2-column)
5. Day-wise itinerary block
6. Booking form shortcode [pwt_booking_form]
7. Optional related packages block

---

## 5) Safari Detail Page Blueprint (for pwt_safari)

1. Featured image
2. Title + quick summary
3. Meta chips (duration, shift, meeting point, pricing)
4. Safari guidance section
5. Booking form shortcode [pwt_booking_form]
6. Related FAQ section shortcode [pwt_faq]

---

## 6) Archive Page Blueprint (Package/Safari)

1. Heading + short intro
2. Filter bar (taxonomy selects)
3. Card grid listing
4. Pagination
5. Sidebar widgets (travel-specific)

---

## 7) Design Rules For Stable Layout

- Avoid overriding global container width in child CSS.
- Keep custom styles scoped to PWT classes only.
- Do not replace global header/nav templates in child unless absolutely needed.
- Use parent theme spacing/layout tokens where possible.

---

## 8) Publishing QA Checklist

1. Desktop and mobile spacing
2. Navigation intact on all page types
3. Buttons and forms clickable
4. Filter + pagination works on archives
5. Schema/SEO title/meta set per page
6. CTA present above fold and at end of page
