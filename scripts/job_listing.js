document.getElementById('jobForm').addEventListener('submit', function(event) {
    const radios = document.querySelectorAll('input[type="radio"]:checked');
    if (radios.length === 0) {
        alert("Please select at least one job.");
        event.preventDefault();
    }
});
