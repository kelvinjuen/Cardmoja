@extends('layouts.app')

@section('content')
  <div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
                <h2 class="font-weight-light text-primary">Contacts Us</h2>
            </div>
        </div>
      <div class="row">
        <div class="col-md-7 mb-5"  data-aos="fade">



          <form action="#" class="p-5 bg-white">


            <div class="row form-group">
            <label class="text-black col-md-3" for="fname">Name</label>
                <div class="col-md-9 mb-3 mb-md-0">
                    <input type="text" id="fname" class="form-control">
                </div>
            </div>

            <div class="row form-group">
                <label class="text-black col-md-3" for="email">Email</label>
                <div class="col-md-9">
                    <input type="email" id="email" class="form-control">
                </div>
            </div>

            <div class="row form-group">
                <label class="text-black col-md-3" for="subject">Subject</label>
                <div class="col-md-9">
                    <input type="subject" id="subject" class="form-control">
                </div>
            </div>

            <div class="row form-group">
                <label class="text-black col-md-3" for="message">Message</label>
                <div class="col-md-9">
                    <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
            </div>

            <div class="row form-group">
              <div class="offset-md-3 col-md-9">
                <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
              </div>
            </div>


          </form>
        </div>
        <div class="col-md-5"  data-aos="fade" data-aos-delay="100">

          <div class="p-4 mb-3 bg-white">
            <h2 class="footer-heading mb-2">Social Media</h2>
            <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>

            <h2 class="footer-heading mt-4 mb-2">Email Address</h2>
            <p class="mb-0"><a href="#">info@cardmoja.com</a></p>

          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

