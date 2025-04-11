<x-header />


  <!-- Title Starts -->
  <section class="section">
    <div class="w-layout-blockcontainer container w-container">
        <div class="space-page-top"></div>
        <div class="about-block">
            <div data-w-id="55686b65-573b-6b1e-27a8-356f0a4302e2" class="subheading-flex">
                
                <h1>Get in touch</h1>
            </div>
            <h1 data-w-id="2b428689-5a35-99ff-f397-e68c91393ae6" style="opacity:0">Contact</h1>
            <h5 data-w-id="2b428689-5a35-99ff-f397-e68c91393ae8" style="opacity:0" class="max-width-2rem">Get in touch with us! Fill out the form below, and we’ll get back to you soon.</h5>
        </div>
        <div class="space-4rem"></div>
    </div>
</section>
<!-- Title Ends -->
    <section class="section">
        <div class="w-layout-blockcontainer container w-container">
            <div class="form-wrapper w-form">
            

                @if(session('success'))
    <div class="alert alert-success" style="font-size: 25
    px; font-weight: bold; color: green;">
        {{ session('success') }}
    </div>
@endif
                <form id="contact-form" action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="field-wrapper">
                        <label for="name">Name</label>
                        <input class="text-field w-input" name="name" placeholder="" type="text" required>
                    </div>
                    <div class="field-wrapper">
                        <label for="email">Email Address</label>
                        <input class="text-field w-input" name="email" placeholder="" type="email" required>
                    </div>
                    <div class="field-wrapper">
                        <label for="phone">Phone Number</label>
                        <input class="text-field w-input" name="phone" placeholder="" type="tel">
                    </div>
                    <div class="field-wrapper">
                        <label for="message">Your Message</label>
                        <textarea class="message-area w-input" name="message" placeholder="" required></textarea>
                    </div>
                    <div class="field-wrapper">
                        <label for="image">Upload an Image (Optional)</label>
                        <input class="text-field w-input" type="file" name="image" accept="image/*">
                    </div>
                    <input type="submit" class="button w-button" value="Send Message">
                </form>
            </div>
        </div>
    </section>

    <!-- Questions Starts -->
    <section class="section">
        <div class="w-layout-blockcontainer container w-container">
            <div class="faqs-block">
                <div data-w-id="55686b65-573b-6b1e-27a8-356f0a4302e2" class="subheading-flex">
                    
                    <h5>FAQs</h5>
                </div>
                <h2 data-w-id="bcae8680-5e02-f900-6795-af73bd37b2f2">Have Questions?</h2>
                <p data-w-id="bcae8680-5e02-f900-6795-af73bd37b2f4" class="max-width-30rem">We’re committed to making
                    your experience as smooth and straightforward as possible.</p>
            </div>
            <div class="space-4rem"></div>
            <div class="faq-wrapper slide-up-animation">
                <div class="faq-dropdown">
                    <div data-w-id="bcae8680-5e02-f900-6795-af73bd37b2f9" class="dropdown-toggle">
                        <div class="space-1rem"></div>
                        <div class="faq-flex">
                            <h4 class="faq-question"> How do I book an event on your website?</h4>
                            <div data-is-ix2-target="1" class="faq-icon"
                                data-w-id="bcae8680-5e02-f900-6795-af73bd37b2fe" data-animation-type="lottie"
                                data-src="https://cdn.prod.website-files.com/66e57311172b9a6012d4d709/66e57311172b9a6012d4d789_FAQ%20icon.json"
                                data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg"
                                data-default-duration="0.5" data-duration="0" data-ix2-initial-state="0"></div>
                        </div>
                        <div class="space-1rem"></div>
                        <div class="dropdown-answer">
                            <p> Booking an event is simple! Browse our event categories, select your preferred package, 
                                fill in the required details, and proceed with payment. 
                                You’ll receive a confirmation email once your booking is successful.</p>
                        </div>
                        <div class="space-1rem"></div>
                    </div>
                </div>
                <div class="faq-dropdown">
                    <div data-w-id="bcae8680-5e02-f900-6795-af73bd37b305" class="dropdown-toggle">
                        <div class="space-1rem"></div>
                        <div class="faq-flex">
                            <h4 class="faq-question">Can I customize my event package?</h4>
                            <div data-is-ix2-target="1" class="faq-icon"
                                data-w-id="bcae8680-5e02-f900-6795-af73bd37b30a" data-animation-type="lottie"
                                data-src="https://cdn.prod.website-files.com/66e57311172b9a6012d4d709/66e57311172b9a6012d4d789_FAQ%20icon.json"
                                data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg"
                                data-default-duration="0.5" data-duration="0" data-ix2-initial-state="0"></div>
                        </div>
                        <div class="space-1rem"></div>
                        <div class="dropdown-answer">
                            <p>Yes! We offer customizable event packages to suit your needs. You can choose from venue options, 
                                catering, décor, entertainment, 
                                and more. Contact our support team for assistance with customization.</p>
                        </div>
                        <div class="space-1rem"></div>
                    </div>
                </div>
                <div class="faq-dropdown">
                    <div data-w-id="bcae8680-5e02-f900-6795-af73bd37b311" class="dropdown-toggle">
                        <div class="space-1rem"></div>
                        <div class="faq-flex">
                            <h4 class="faq-question">What payment methods do you accept?</h4>
                            <div data-is-ix2-target="1" class="faq-icon"
                                data-w-id="bcae8680-5e02-f900-6795-af73bd37b316" data-animation-type="lottie"
                                data-src="https://cdn.prod.website-files.com/66e57311172b9a6012d4d709/66e57311172b9a6012d4d789_FAQ%20icon.json"
                                data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg"
                                data-default-duration="0.5" data-duration="0" data-ix2-initial-state="0"></div>
                        </div>
                        <div class="space-1rem"></div>
                        <div class="dropdown-answer">
                            <p> We accept all major credit and debit cards, PayPal, and bank transfers. 
                                If you need alternative payment options, please reach out to our support team.</p>
                        </div>
                        <div class="space-1rem"></div>
                    </div>
                </div>
                <div class="faq-dropdown">
                    <div data-w-id="bcae8680-5e02-f900-6795-af73bd37b31d" class="dropdown-toggle">
                        <div class="space-1rem"></div>
                        <div class="faq-flex">
                            <h4 class="faq-question">Can I cancel or reschedule my event after booking?</h4>
                            <div data-is-ix2-target="1" class="faq-icon"
                                data-w-id="bcae8680-5e02-f900-6795-af73bd37b322" data-animation-type="lottie"
                                data-src="https://cdn.prod.website-files.com/66e57311172b9a6012d4d709/66e57311172b9a6012d4d789_FAQ%20icon.json"
                                data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg"
                                data-default-duration="0.5" data-duration="0" data-ix2-initial-state="0"></div>
                        </div>
                        <div class="space-1rem"></div>
                        <div class="dropdown-answer">
                            <p>Yes, you can cancel or reschedule your event, but cancellation policies vary based
                                 on the package and service providers. 
                                Please check our terms and conditions or contact us for more details.</p>
                        </div>
                        <div class="space-1rem"></div>
                    </div>
                </div>
                <div class="faq-dropdown">
                    <div data-w-id="bcae8680-5e02-f900-6795-af73bd37b329" class="dropdown-toggle">
                        <div class="space-1rem"></div>
                        <div class="faq-flex">
                            <h4 class="faq-question"> Do you offer on-site event management?</h4>
                            <div data-is-ix2-target="1" class="faq-icon"
                                data-w-id="bcae8680-5e02-f900-6795-af73bd37b32e" data-animation-type="lottie"
                                data-src="https://cdn.prod.website-files.com/66e57311172b9a6012d4d709/66e57311172b9a6012d4d789_FAQ%20icon.json"
                                data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg"
                                data-default-duration="0.5" data-duration="0" data-ix2-initial-state="0"></div>
                        </div>
                        <div class="space-1rem"></div>
                        <div class="dropdown-answer">
                            <p></p> Absolutely! We provide professional event managers to ensure your occasion runs smoothly.
                             You can add this service during your booking or request it later.
                        </div>
                        <div class="space-1rem"></div>
                    </div>
                </div>
            </div>
            <div class="space-2rem"></div>
        </div>
    </section>
    <!-- Questions Ends -->

    <div class="space-7rem"></div>

    <x-footer />

    <script src="js/jquery-3.5.1.min.dc5e7f18c8.js?site=6706104d4f29e916e4cae2ad" type="text/javascript"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="assets/js/mainScript.js" type="text/javascript"></script>
</body>

</html>