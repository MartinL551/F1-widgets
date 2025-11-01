class raceControl {
    constructor() {
        this.messagesContainer = document.querySelector('.race-control-messages');
        this.length = this.messagesContainer.dataset.length;
        this.pollingInterval = 10000; // 10 seconds
    }

    init() {
        this.fetchMessages();
        setInterval(() => this.fetchMessages(), this.pollingInterval);
    }

    fetchMessages() {
        fetch('/api/race-control/latestMessages')
            .then(response => response.json())
            .then(data => {
                this.updateMessages(data);
            });
    }

    updateMessages(messages) {
        this.messagesContainer.innerHTML = '';
        messages.forEach((message, index) => {
            const messageElement = document.createElement('x-message');
            messageElement.setAttribute('message', JSON.stringify(message));
            messageElement.setAttribute('index', index);
            this.messagesContainer.appendChild(messageElement);
        });
    }
}

const $raceControl = new raceControl();
$raceControl.init();