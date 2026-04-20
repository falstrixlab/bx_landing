<?= $this->extend('landingen/landingbase'); ?>
<?= $this->section('content') ?>
<section class="sectionBanner">
    <div class="hero-wrap2">
      <div class="overlay-blue-bg-banner"></div>
      <div class="hero-image2">
        <img src="<?= base_url('assets/landing/');?>image/banner-contact.png" alt="">
      </div>
      <div class="container">
          <div class="row descBanner2">
             <div class="col-lg-12 box-premium">
                <div class="desc-premium">
                <h1><?= esc(bxsea_plain_text($contactheader[0]['masterdesc_title_en'] ?? 'Contact Us'));?></h1>
                <p><?= esc(bxsea_plain_text($contactheader[0]['masterdesc_desc_en'] ?? ''));?></p> 
                </div>
             </div>
          </div>  
      </div>
    </div>
  </section>


  <section class="Contactus">
    <img class="octopus" src="<?= base_url('assets/landing/');?>image/BXSea Asset plus-07 1.svg" alt="">
    <img class="octopus2" src="<?= base_url('assets/landing/');?>image/BXSea Asset plus-08 2.svg" alt="">
    <div class="container">
        <div class="title-Contactus">
          <h1><?= esc(bxsea_plain_text($contactdesc[0]['masterdesc_title_en'] ?? 'Contact Us'));?></h1>
          <p><?= esc(bxsea_plain_text($contactdesc[0]['masterdesc_desc_en'] ?? ''));?></p> 
        </div>
        <?php if(session()->getFlashdata('success')):?>
              <div class="alert alert-success alert-dismissible">
                  <strong>Success !</strong> Success send data.
              </div>
          <?php endif;?>
          <?php if(session()->getFlashdata('failed')):?>
              <div class="alert alert-danger alert-dismissible">
                  <strong>Failed !</strong> Failed send data.
              </div>
          <?php endif;?>
        <form action="<?= base_url('en/kunjungan/hubungi-kami-proses')?>" method="POST">
          <div class="row">
              <div class="col-lg-4 mb-200">
                  <div class="form-row">
                      <div class="form-row1">
                          <h5>Full Name</h5>
                          <input type="text" name="contact_fullname" id="contact_fullname" required="required">   
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 mb-200">
                  <div class="form-row">
                      <div class="form-row1">
                          <h5>Phone Number</h5>
                          <input type="text" name="contact_phone" id="contact_phone" required="required">   
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 mb-200">
                  <div class="form-row">
                      <div class="form-row1">
                          <h5>Email</h5>
                          <input type="text" name="contact_email" id="contact_email" required="required">   
                      </div>
                  </div>
              </div>
              <div class="col-lg-12 mb-200">
                  <div class="form-row">
                      <div class="form-row1">
                          <h5>Message</h5>
                          <textarea name="contact_desc" id="contact_desc" required="required"></textarea>
                      </div>
                  </div>
              </div>
              <div class="submit-message">
                  <input type="submit" name="submit" value="Send Message">
              </div>
          </div>
        </form>
    </div>
  </section>


  <section class="contactus2">
    <div class="container">
      <div class="title-contactus2">
        <h1>CONTACT US</h1>
      </div>
      <div class="row box-contact">
        <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus">
          <div class="card-contactus2">
            <a href="tel:<?= $setup[0]['setup_customer']?>">
              <div class="image-contactus2">
                <img class="img-fluid" src="<?= base_url('assets/landing/');?>image/sosmed.png" alt="">
              </div>
              <div class="desc-card-contactus2">
                <p>Customer Services</p>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus2">
          <div class="card-contactus2">
            <a href="https://wa.me/<?= $setup[0]['setup_phone']?>">
              <div class="image-contactus2">
                <img class="img-fluid" src="<?= base_url('assets/landing/');?>image/sosmed2.png" alt="">
              </div>
              <div class="desc-card-contactus2">
                <p>WhatsApp</p>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 box-card-contactus3">
          <div class="card-contactus2">
            <a href="mailto:<?= $setup[0]['setup_email']?>">
              <div class="image-contactus2">
                <img class="img-fluid" src="<?= base_url('assets/landing/');?>image/sosmed3.png" alt="">
              </div>
              <div class="desc-card-contactus2">
                <br>
                <p>Email</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <img class="grass17" src="<?= base_url('assets/landing/');?>image/bg-grass.png" alt="">
  </section>
  <?= $this->endSection() ?>