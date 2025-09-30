@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Edit Dues Payment</h2>
  <a href="{{ route('dues_payments.index') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('dues_payments.update', $duesPayment) }}" method="POST" id="dues-payment-form">
    @csrf
    @method('PUT')

    <!-- Show Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <!-- Academic Year -->
    <div class="mb-3">
      <label class="form-label">Academic Year</label>
      <select name="academic_year_id" id="academic_year_id" class="form-select" required>
        <option value="">Select Academic Year</option>
        @foreach($academicYears as $year)
        <option value="{{ $year->id }}" {{ $duesPayment->academic_year_id == $year->id ? 'selected' : '' }}>
          {{ $year->name }}
        </option>
        @endforeach
      </select>
      @error('academic_year_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <!-- Level -->
    <div class="mb-3">
      <label class="form-label">Level</label>
      <select name="level_id" id="level_id" class="form-select" required>
        <option value="">Select Level</option>
        @foreach($levels as $level)
        <option value="{{ $level->id }}" {{ $duesPayment->level_id == $level->id ? 'selected' : '' }}>
          Level {{ $level->number }} - {{ $level->name }}
        </option>
        @endforeach
      </select>
      @error('level_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <!-- Student -->
    <div class="mb-3">
      <label class="form-label">Student</label>
      <select name="student_id" id="student_id" class="form-select" required>
        <option value="">Select Student</option>
        @foreach($students as $student)
        <option value="{{ $student->id }}" {{ $duesPayment->student_id == $student->id ? 'selected' : '' }}>
          {{ $student->index_number }} - {{ $student->name }}
        </option>
        @endforeach
      </select>
      @error('student_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <!-- Auto-filled student info -->
    <div class="row">
      <div class="col-md-4 mb-3">
        <label class="form-label">Index Number</label>
        <input type="text" id="student_index_number" class="form-control"
          value="{{ $duesPayment->student->index_number ?? '' }}" disabled>
      </div>
      <div class="col-md-4 mb-3">
        <label class="form-label">Level</label>
        <input type="text" id="student_level" class="form-control"
          value="Level {{ $duesPayment->student->level->number ?? '' }} - {{ $duesPayment->student->level->name ?? '' }}"
          disabled>
      </div>
      <div class="col-md-4 mb-3">
        <label class="form-label">Academic Year</label>
        <input type="text" id="student_academic_year" class="form-control"
          value="{{ $duesPayment->student->academicYear->name ?? '' }}" disabled>
      </div>
    </div>

    <!-- Due -->
    <div class="mb-3">
      <label class="form-label">Due</label>
      <select name="due_id" id="due_id" class="form-select" required>
        <option value="">Select Due</option>
        @foreach($dues as $due)
        <option value="{{ $due->id }}" {{ $duesPayment->due_id == $due->id ? 'selected' : '' }}>
          {{ $due->academicYear->name }} - Level {{ $due->level->number }} (₵{{ $due->amount }})
        </option>
        @endforeach
      </select>
      @error('due_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <!-- Date & Amount -->
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Date Paid</label>
        <input type="date" name="date_paid" class="form-control"
          value="{{ old('date_paid', $duesPayment->date_paid instanceof \Carbon\Carbon ? $duesPayment->date_paid->format('Y-m-d') : $duesPayment->date_paid) }}"
          required>
        @error('date_paid') <small class="text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Amount Paid</label>
        <input type="number" name="amount_paid" class="form-control"
          value="{{ old('amount_paid', $duesPayment->amount_paid) }}" required>
        @error('amount_paid') <small class="text-danger">{{ $message }}</small> @enderror
      </div>
    </div>

    <!-- Souvenirs -->
    <div class="mb-3">
      <label class="form-label">Souvenirs Collected</label>
      <div id="souvenirs-container">
        @if($souvenirs->count())
        @foreach($souvenirs as $s)
        <div class="form-check">
          <input type="checkbox" name="souvenirs[]" value="{{ $s->id }}" class="form-check-input"
            id="souvenir-{{ $s->id }}" {{ $duesPayment->souvenirs->contains($s->id) ? 'checked' : '' }}>
          <label class="form-check-label" for="souvenir-{{ $s->id }}">{{ $s->name }}</label>
        </div>
        @endforeach
        @else
        <p class="text-muted">No souvenirs available for this level & year.</p>
        @endif
      </div>
    </div>

    <!-- Status -->
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="pending" {{ $duesPayment->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="confirmed" {{ $duesPayment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
        <option value="cancelled" {{ $duesPayment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
      </select>
      @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-gray-800">Update Payment</button>
  </form>
</div>

@endsection

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const academicYearSelect = document.getElementById("academic_year_id");
    const levelSelect = document.getElementById("level_id");
    const studentSelect = document.getElementById("student_id");

    function loadStudents() {
      const yearId = academicYearSelect.value;
      const levelId = levelSelect.value;

      if (yearId && levelId) {
        fetch(`{{ url('/dashboard/students/by-year-level') }}/${yearId}/${levelId}`)
          .then(res => res.json())
          .then(students => {
            studentSelect.innerHTML = '<option value="">Select Student</option>';
            students.forEach(s => {
              studentSelect.innerHTML += `<option value="${s.id}">${s.index_number} - ${s.name}</option>`;
            });
          });
      }
    }

    academicYearSelect.addEventListener("change", loadStudents);
    levelSelect.addEventListener("change", loadStudents);

    studentSelect.addEventListener("change", function () {
      const studentId = this.value;
      if (!studentId) return;

      fetch(`{{ url('/dashboard/students') }}/${studentId}/info`)
        .then(res => res.json())
        .then(data => {
          document.getElementById("student_index_number").value = data.index_number;
          document.getElementById("student_level").value = "Level " + data.level.number + " - " + data.level.name;
          document.getElementById("student_academic_year").value = data.academic_year.name;

          fetch(`{{ url('/dashboard/souvenirs') }}/${data.level.id}/${data.academic_year.id}`)
            .then(res => res.json())
            .then(souvenirs => {
              let html = "";
              if (souvenirs.length > 0) {
                souvenirs.forEach(s => {
                  html += `
                    <div class="form-check">
                      <input type="checkbox" name="souvenirs[]" value="${s.id}" class="form-check-input" id="souvenir-${s.id}">
                      <label class="form-check-label" for="souvenir-${s.id}">${s.name}</label>
                    </div>
                  `;
                });
              } else {
                html = "<p class='text-muted'>No souvenirs available for this level & year.</p>";
              }
              document.getElementById("souvenirs-container").innerHTML = html;
            });
        });
    });
  });
</script>
@endpush