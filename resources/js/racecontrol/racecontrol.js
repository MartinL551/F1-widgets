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
        fetch('/api/race-control/latestMessages?length=' + this.length)
            .then(response => response.json())
            .then(data => {
                this.updateMessages(data);
            });
    }

    updateMessages(messages) {
        messages.forEach((message, index) => {
            const htmlMessage = new DOMParser().parseFromString(message, "text/xml");
            this.messagesContainer.prepend(htmlMessage.firstChild);
            this.updateLength(this.length + 1);
        });
    }

    updateLength(newLength) {
        this.length = newLength;
        this.messagesContainer.dataset.length = newLength;
    }
}

const $raceControl = new raceControl();
$raceControl.init();