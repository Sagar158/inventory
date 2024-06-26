<div class="col-tact-stye-one col-lg-7 mb-md-50">
    <div class="contact-form-style-one mb-md-50">
        <h5 class="sub-title">{{ trans('general.have_questions') }}</h5>
        <h2 class="heading">{{ trans('general.send_us_a_message') }}</h2>
        <form action="{{ route('contactStore') }}" method="POST" class="contact-form contact-form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <input class="form-control" id="name" name="name" placeholder="Name" type="text">
                        <span class="alert-error"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input class="form-control" id="email" name="email" placeholder="Email*" type="email">
                        <span class="alert-error"></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <input class="form-control" id="phone" name="phone" placeholder="Phone" type="text">
                        <span class="alert-error"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group comments">
                        <textarea class="form-control" id="comments" name="comments" placeholder="Message *"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" name="submit" id="submit">
                        <i class="fa fa-paper-plane"></i> {{ trans('general.get_in_touch') }}
                    </button>
                </div>
            </div>
            <!-- Alert Message -->
            <div class="col-lg-12 alert-notification">
                <div id="message" class="alert-msg"></div>
            </div>
        </form>
    </div>
</div>
<div class="col-tact-stye-one col-lg-5 pl-60 pl-md-15 pl-xs-15">
    <div class="contact-style-one-info">
        <h2>
            {{ trans('general.contact') }}
            <span>
                {{ trans('general.information') }}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M14.4,111.6c0,0,202.9-33.7,471.2,0c0,0-194-8.9-397.3,24.7c0,0,141.9-5.9,309.2,0" style="animation-play-state: running;"></path></svg>
            </span>
        </h2>
        <p>
            {{ trans('general.feel_free') }}
        </p>
        <ul>
            <li class="wow fadeInUp">
                <div class="icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="content">
                    <h5 class="title">{{ trans('general.mobile') }}</h5>
                    <a href="">{{ isset(\App\Helpers\Helper::information()->phone) ? \App\Helpers\Helper::information()->phone : '' }}</a>
                </div>
            </li>
            <li class="wow fadeInUp" data-wow-delay="300ms">
                <div class="icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="info">
                    <h5 class="title">{{ trans('general.our_location') }}</h5>
                    <p>
                        {{ isset(\App\Helpers\Helper::information()->location) ? \App\Helpers\Helper::information()->location : '' }}
                    </p>
                </div>
            </li>
            <li class="wow fadeInUp" data-wow-delay="500ms">
                <div class="icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="info">
                    <h5 class="title">{{ trans('general.email') }}</h5>
                    @if(isset(\App\Helpers\Helper::information()->email))
                       <a href="mailto:{{ \App\Helpers\Helper::information()->email }}">{{ \App\Helpers\Helper::information()->email }}</a>
                    @endif
                </div>
            </li>
        </ul>
    </div>
</div>
