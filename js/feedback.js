document.addEventListener('DOMContentLoaded', function () {
    fetch('https://votre-site.com/wp-json/nova-widgets/v1/feedbacks')
        .then(response => response.json())
        .then(data => {
            const feedbackContainer = document.getElementById('feedback-container');
            if (feedbackContainer) {
                data.forEach(feedback => {
                    const feedbackDiv = document.createElement('div');
                    feedbackDiv.classList.add('feedback');
                    feedbackDiv.innerHTML = `
                        <p>${feedback.feedback}</p>
                        <p><strong>Email:</strong> ${feedback.user_email}</p>
                    `;
                    feedbackContainer.appendChild(feedbackDiv);
                });
            }
        })
        .catch(error => console.error('Error fetching feedbacks:', error));
});
