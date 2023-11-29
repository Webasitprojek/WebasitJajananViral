function sendOTP() {
    const email = document.getElementById('email');
    const otpverify = document.getElementsByClassName('otpverify')[0];
    let otp_val = Math.floor(Math.random() * 10000);

    // Fetch email content from email.html
    fetch('emaill.html')
        .then(response => response.text())
        .then(emaill => {
            // Replace {otp_val} with the actual OTP value
            const emailbody = emaill.replace('{otp_val}', otp_val);

            // Send email using Email.js
            Email.send({
                SecureToken: "d34b7df6-7a9b-49e7-875c-d5018f2ce4ba",
                To: email.value,
                From: "daikoasikbetgilak56@gmail.com",
                Subject: "SICEDAS : Verifikasi Kode OTP Lupa Password",
                Body: emailbody
            }).then(
                message => {
                    if (message === "OK") {
                        alert("Kode OTP telah dikirim ke email anda " + email.value);
                        otpverify.style.display = "block";
                        const otp_inp = document.getElementById('otp_inp');
                        const otp_btn = document.getElementById('otp-btn');
                        otp_btn.addEventListener('click', () => {
                            if (otp_inp.value == otp_val) {
                                alert('Kode OTP yang anda masukkan benar');
                                window.location.href = 'passwordbaru.php?username=' + encodeURIComponent('<?php echo $_SESSION["usernameFromPHP"]; ?>');
                            } else {
                                alert("Invalid OTP");
                            }
                        });
                    } else {
                        alert("error");
                    }
                }
            );
        })
        .catch(error => console.error('Error fetching email content:', error));
}
