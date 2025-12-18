@extends('template.template')

@section('pagecontent')

<style>
  .contact-wrapper {
    max-width: 1100px;
    margin: 60px auto;
    background: #faf6f2;
    padding: 60px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
  }

  .contact-info h1 {
    font-family: Georgia, serif;
    font-size: 36px;
    color: #320b3c;
    margin-bottom: 10px;
  }

  .contact-info p {
    color: #3b1919;
    line-height: 1.6;
    margin-bottom: 30px;
  }

  .email {
    margin-bottom: 20px;
    font-size: 14px;
  }

  .social-icons span {
    margin-right: 10px;
    cursor: pointer;
  }

  .row {
    display: flex;
    gap: 20px;
  }

  .inp {
    width: 100%;
    padding: 10px;
    border: 1px solid #2a2929;
    margin-bottom: 20px;
    font-size: 14px;
  }

  textarea {
    height: 120px;
    resize: none;
  }

  .btn {
    background: #221c1a;
    color: #fff;
    border: none;
    padding: 10px 25px;
    cursor: pointer;
    float: right;
  }

  @media (max-width: 768px) {
    .contact-wrapper {
      grid-template-columns: 1fr;
      padding: 30px;
    }
  }
</style>

<div class="contact-wrapper">

  <div class="contact-info">
    <h1>Get in Touch</h1>
    <p><strong>I'd like to hear from you!</strong></p>
    <p>If you have any inquiries or just want to say hi, please use the contact form!</p>

    <div class="email">✉ myshop@gmail.com</div>

    <div class="social-icons">
      <span>ⓕ</span>
      <span>🅾</span>
      <span>🌐</span>
      <span>🐦</span>
      <span>💼</span>
    </div>
  </div>

  <div class="contact-form">
   <form id="contactForm">
  @csrf

  <div class="row">
    <input class="inp" type="text" name="first_name" placeholder="First Name" required>
    <input class="inp" type="text" name="last_name" placeholder="Last Name" required>
  </div>

  <input class="inp" type="email" name="email" placeholder="Email *" required>

  <textarea class="inp" name="message" placeholder="Message" required></textarea>

  <button class="btn" type="submit">Send</button>
</form>

<p id="statusMsg" style="margin-top:10px;"></p>

  </div>

</div>
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let form = this;
    let status = document.getElementById('statusMsg');
    let button = form.querySelector('button');

    status.innerHTML = '📨 Sending email...';
    button.disabled = true;

    fetch("{{ route('contact.send') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: new FormData(form)
    })
    .then(async res => {
        const data = await res.json();
        if (!res.ok) throw data;
        return data;
    })
    .then(data => {
        status.innerHTML = '✅ Email sent successfully!';
        form.reset();
    })
    .catch(err => {
        if (err.errors) {
            // Laravel validation error
            let messages = Object.values(err.errors).flat().join('<br>');
            status.innerHTML = '❌ ' + messages;
        } else {
            status.innerHTML = '❌ Failed to send email';
        }
    })
    .finally(() => {
        button.disabled = false;
    });
});
</script>

@endsection
