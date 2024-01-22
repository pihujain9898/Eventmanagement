<form action="" method="POST" id="formId">
    
    <input type="text" name="fname" id="">
    <input type="text" name="lname" id="">
    <input type="email" name="email" id="">
    <input type="password" name="password" id="">
    <input type="submit" value="submit">
    
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    fetch('http://localhost/eventmanage/csrf-token')
        .then(function(response) {
        if (response.ok) {
            return response.json();
        }
        throw new Error('Network response was not ok.');
        })
        .then(function(data) {
        // Handle the retrieved data here
        var form = document.getElementById('formId'); // Replace 'your-form-id' with the actual ID of your form
        
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_csrfToken';
        csrfTokenInput.value = data.csrfToken;
        
        form.appendChild(csrfTokenInput);
        console.log(data.csrfToken);
        })
        .catch(function(error) {
        // Handle any errors that occurred during the request
        console.error('Error:', error);
        });
    });
</script>