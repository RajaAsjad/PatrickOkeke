@extends('layouts.website.master')
@section('title', $page_title)
@section('meta_description', $meta_description)

@section('content')
    <section class="page-hero">
        <div class="container-pns">
            <h1>Join our team</h1>
            <p>Work with a veteran-owned crew that values reliability and pride in the details.</p>
        </div>
    </section>

    <section class="section-pns">
        <div class="container-pns">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <p>Want to work with us? We are hiring cleaners. You must have <strong>two years of professional
                            cleaning experience</strong> and be able to pass a <strong>background check</strong>.</p>
                    <p class="text-muted small">Submit the form below — your message is routed the same as our contact
                        form so recruiting can follow up.</p>

                    <form id="hiring-form" class="booking-form mt-4" action="{{ route('contactus.store') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="full_name" class="form-control" placeholder="Full name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="venue_event" class="form-control"
                                    placeholder="City / area you work in">
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" required rows="6"
                                    placeholder="Briefly describe your 2+ years of professional cleaning experience and availability."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-pns-gold" id="hiring-submit">Submit application</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            $('#hiring-form').on('submit', function (e) {
                e.preventDefault();
                var $form = $(this);
                var $btn = $('#hiring-submit');
                var $ta = $form.find('textarea[name="message"]');
                var original = $ta.val();
                $ta.val('Job application: ' + original);
                var payload = $form.serialize();
                $ta.val(original);
                $btn.prop('disabled', true).text('Sending...');
                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: payload,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    success: function (res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Application received',
                                text: res.message || 'Thank you — we will be in touch.',
                                timer: 5000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            });
                            $form[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message || 'Something went wrong.'
                            });
                        }
                    },
                    error: function (xhr) {
                        var msg = 'Something went wrong. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                        else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            msg = Object.values(xhr.responseJSON.errors).flat().join(' ');
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: msg
                        });
                    },
                    complete: function () {
                        $btn.prop('disabled', false).text('Submit application');
                    }
                });
            });
        });
    </script>
@endpush
