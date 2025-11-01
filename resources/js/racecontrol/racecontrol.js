class raceControl {
    constructor() {
        this.messagesContainer = document.querySelector('.race-control-messages');
        this.length = this.messagesContainer.dataset.length;
        this.pollingInterval = 1000; // 10 seconds
    }

    init() {
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
            const htmlMessageParsed = new DOMParser().parseFromString(message, "text/html");
            let htmlMessage = htmlMessageParsed.body.children[0];
            htmlMessage.classList.add('transition-[height,opacity]');
            htmlMessage.classList.add('duration-[2s]');
        
            this.messagesContainer.prepend(htmlMessage);
            this.updateLength(parseInt(this.length) + 1);
            this.fadeIn(this.messagesContainer.firstChild);
        });
    }

    updateLength(newLength) {
        this.length = newLength;
        this.messagesContainer.dataset.length = newLength;
    }

    fadeIn(element) {
        let currentMinHeight = element.style.minHeight;

        element.style.opacity = 0;
        element.style.minHeight = '0px'
        element.style.maxHeight = '0px';
        
        const interval = setInterval(() => {
            if (element.style.opacity >= 1) {
                clearInterval(interval);
            }
            element.style.minHeight = currentMinHeight;
            element.style.maxHeight = '100%';
            element.style.opacity = 1;
        }, 50);
    }
}

const $raceControl = new raceControl();
$raceControl.init();