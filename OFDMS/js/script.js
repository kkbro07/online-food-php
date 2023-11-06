            var signupPopupOpen = false; // Variable to track the signup popup state

            // Add a scroll event listener to the window
            window.addEventListener('scroll', function () {
                // Check if either of the popups is open and close them
                if (signupPopupOpen) {
                    closePopupsignup();
                }
                closePopuplogin();
            });


            function openPopupsignup() {
                var popup = document.getElementById('signupPopup');
                popup.style.display = 'block';
                signupPopupOpen = true; // Set the variable to true when signup popup is open
            }

            function closePopupsignup() {
                var popup = document.getElementById('signupPopup');
                popup.style.display = 'none';
                signupPopupOpen = false; // Set the variable to false when signup popup is closed
            }

            function openPopuplogin() {
                var popup = document.getElementById('loginPopup');
                popup.style.display = 'block';
            }

            function closePopuplogin() {
                var popup = document.getElementById('loginPopup');
                popup.style.display = 'none';
            }

            function checkLogin() {
                // Check if the signup popup is open, and close it if it is
                if (signupPopupOpen) {
                    closePopupsignup();
                }
                openPopuplogin();
            }
            function openForgotPassword() {
                var popup = document.getElementById('forgotPasswordPopup');
                popup.style.display = 'block';
            }

            function closeForgotPassword() {
                var popup = document.getElementById('forgotPasswordPopup');
                popup.style.display = 'none';
            }
           