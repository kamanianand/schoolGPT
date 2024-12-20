@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h3 class="text-center">Register</h3>
    <div id="register-alert" class="alert d-none"></div>
    <form id="registerForm">
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="required_sign">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="class" class="form-label">Class <span class="required_sign">*</span></label>
            <select name="class" id="class" class="form-control" required>
                <option value="">Select class</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number <span class="required_sign">*</span></label>
            <input type="number" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address <span class="required_sign">*</span></label>
            <input type="email" class="form-control" id="email" name="email" required >
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="required_sign">*</span></label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('#registerForm').on('submit', function (e) {
            e.preventDefault();
            const formData = {
                name: $('#name').val(),
                class: $('#class').val(),
                phone_number: $('#phone_number').val(),
                email: $('#email').val(),
                password: $('#password').val(),
            };

            $.ajax({
                url: "{{ url('api/signup') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response != '') {
                        $('#register-alert').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
                        setTimeout(() => {
                            window.location.href = "{{ route('login')}}";
                        }, 2000);
                    } else {
                        $('#register-alert').removeClass('d-none alert-success').addClass('alert-danger').text(xhr.responseJSON.message);
                    }
                },
                error: function (xhr) {
                    $('#register-alert').removeClass('d-none alert-success').addClass('alert-danger').text(xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection
