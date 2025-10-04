@extends('dashboard.layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Help & Support</h2>
</div>

<div class="row">
  <!-- Quick Start Guides -->
  <div class="col-lg-6 mb-4">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-light">
        <h5 class="mb-0">Quick Start Guides</h5>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li class="mb-2">
            <i class="bi bi-person-lines-fill text-primary me-2"></i>
            <a href="{{ route('students.index') }}">Managing Students</a>
          </li>
          <li class="mb-2">
            <i class="bi bi-cash-coin text-success me-2"></i>
            <a href="{{ route('dues_payments.index') }}">Handling Dues Payments</a>
          </li>
          <li class="mb-2">
            <i class="bi bi-gift text-warning me-2"></i>
            <a href="{{ route('souvenirs.index') }}">Souvenirs Management</a>
          </li>
          <li class="mb-2">
            <i class="bi bi-gear text-secondary me-2"></i>
            <a href="{{ route('dashboard') }}">System Settings</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- FAQs -->
  <div class="col-lg-6 mb-4">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-light">
        <h5 class="mb-0">Frequently Asked Questions</h5>
      </div>
      <div class="card-body">
        <div class="accordion" id="helpAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header" id="faqOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne">
                How do I reset my password?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
              <div class="accordion-body">
                Go to the login screen and click <strong>Forgot Password</strong>. Follow the instructions sent to your
                email.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faqTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo">
                Can I update a payment after saving it?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
              <div class="accordion-body">
                Yes. Go to <em>Dues Payments</em>, click <strong>Edit</strong> on the payment record, and update the
                details.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faqThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree">
                How do I export reports as PDF?
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
              <div class="accordion-body">
                In any management page (Students, Dues, Souvenirs, Payments), click the <strong>Export PDF</strong>
                button at the top-right.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Contact Support -->
  <div class="col-12">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-light">
        <h5 class="mb-0">Need More Help?</h5>
      </div>
      <div class="card-body">
        <p>If you have issues not covered in this help section, please reach out:</p>
        <ul class="list-unstyled">
          <li><i class="bi bi-envelope me-2 text-primary"></i>Email: <a
              href="mailto:support@example.com">raacquah7@gmail.com</a></li>
          <li><i class="bi bi-telephone me-2 text-success"></i>Phone: +233 548674916</li>
          <li><i class="bi bi-chat-dots me-2 text-info"></i>Live Chat: Available weekdays 9am - 5pm</li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection