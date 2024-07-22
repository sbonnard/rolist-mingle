document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('[data-favourite-minus]');
    
    deleteButtons.forEach(button => {
        button.addEventListener('change', function() {
            if (this.checked === false) { // Trigger only on unchecking
                const universeId = this.getAttribute('data-delete-rpg-id');
                
                fetch('api-CRUD.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'delete',
                        id: universeId
                    })
                })
                .then(response => {
                    console.log('Raw response:', response);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Parsed response:', data);
                    if (data.success) {
                        this.closest('.favourites').remove();
                    } else {
                        console.error('Failed to delete favourite:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});