@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h3 class="text-center">Login</h3>
    <div id="login-alert" class="alert d-none"></div>
    <form id="loginForm">
        <div class="mb-3">
            <label for="email" class="form-label">Email address <span class="required_sign">*</span></label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="required_sign">*</span></label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();
            const formData = {
                email: $('#email').val(),
                password: $('#password').val(),
            };
            $.ajax({
                url: "{{ url('api/login') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                
                    if (response.token != '') {
                        localStorage.setItem('auth_token', response.token);

                        $('#login-alert').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
                        setTimeout(() => {
                            window.location.href = "{{ route('chat')}}";
                        }, 2000);
                    } else {
                        $('#login-alert').removeClass('d-none alert-success').addClass('alert-danger').text(xhr.responseJSON.message);
                    }
                },
                error: function (xhr) {
                    $('#login-alert').removeClass('d-none alert-success').addClass('alert-danger').text(xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection
