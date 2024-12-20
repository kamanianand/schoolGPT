@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Chat with School GPT</h3>
    <textarea id="question" rows="4" class="form-control" placeholder="Ask a question..."></textarea>
    <button id="send" class="btn btn-primary mt-3">Send</button>
    <div id="response" class="mt-3"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$(document).ready(function () {
    const token = localStorage.getItem('auth_token');
    if (token == '' || token == null || token == 'null') {
        window.location.href = "{{ route('login')}}";
    }
});

document.getElementById('send').addEventListener('click', () => {
    const question = document.getElementById('question').value;
    const token = localStorage.getItem('auth_token');
    fetch('/api/chat', {
        method: 'POST',
        headers: {
            'Authorization': 'Bearer '+token,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ question }),
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('response').innerHTML = `<strong>Answer:</strong> ${data.answer}`;
    });
});

       
</script>
@endsection
