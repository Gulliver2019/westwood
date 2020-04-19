<?php /* Template Name: Contact */ ?>
<?php get_header();?>

    <div class="contact-main">
        <div class="container">
            <div class="row contact">
                    <div class="col-12 col-lg-4 offset-lg-1">
                        <div class="contact-holder">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name*</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address*</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telephone Number*</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile Number</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email Address*</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Your enquiry*</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="8"></textarea>
                                </div>
                                <p>*Required Fields</p>
                                <p>We'll only use this information to handle your enquiry and we won't share it with any third parties.</p>
                                <button type="submit" class="btn btn-primary">Send your message</button>
                            </form>            
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 offset-lg-1">
                        <div class="contact-holder">
                            <h3 class="contact-title">CONTACT</h3>
                            <ul class="contact-details">
                                <li><span class="fas fa-phone-alt"></span>07816 581559</li>
                                <li><span class="fab fa-facebook"></span>Facebook</li>
                                <li><span class="fab fa-instagram"></span>Instragram</li>
                            </ul>
                        </div>
                    </div>

                    
                    
                </div>
            </div>
        </div>
    </dvi>

    <div class="contact-secondary">
        <div class="container">
            <div class="row logo-sm">
                <div class="col-12">
                    <img src="<?php bloginfo('template_directory');?>/images/small-logo.png" class="img-fluid">
                </div>
            </div>
            <p>24 Knightbridge Road, Olton, Solihull, West Midlands B92 8RF</p>
            <p>Telephone: 0121 706 7616 Mobile: 07816 581559</p>
            <p>Email: info.rwrenovations@gmail.com</p>

            <ul class="social">
                <li><a href=""><img src="<?php bloginfo('template_directory');?>/images/instagram.png"></a></li>
                <li><a href=""><img src="<?php bloginfo('template_directory');?>/images/facebook.png"></a></li>
            </ul>
        </div>

    </div>

<?php get_footer();?>
    

    